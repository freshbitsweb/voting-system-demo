<?php

namespace Tests\Feature;

use App\Topic;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var \App\User
     */
    public $user;

    /**
     * Login the user for every test
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = $this->apiLogin();
    }

    /**
     * @test
     */
    public function topics_can_be_fetched()
    {
        $topic = factory(Topic::class)->create();

        $response = $this->json('GET', 'api/get-topics');
        $response->assertOk()
            ->assertJson([
                'success' => true,
                'data' => [
                    'topics' => [[
                        'id' => $topic->id,
                        'title' => $topic->title,
                        'voters' => [],
                        'user' => NULL,
                    ]],
                ],
            ])
        ;
    }

    /**
     * @test
     */
    public function user_can_vote_for_the_topic()
    {
        $topic = factory(Topic::class)->create();

        $response = $this->json('POST', 'api/vote-for-topic', [
            'topic_id' => $topic->id,
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'data' => [
                    'topic' => [
                        'id' => $topic->id,
                        'title' => $topic->title,
                        'voters' => [$this->user->id],
                        'user' => NULL,
                    ],
                ],
            ])
        ;

        $this->assertDatabaseHas('votes', [
            'topic_id' => $topic->id,
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * @test
     */
    public function user_can_add_a_new_topic()
    {
        $topic = factory(Topic::class)->make();

        $response = $this->json('POST', 'api/add-new-topic', [
            'title' => $topic->title,
        ]);

        $response->assertOk()
            ->assertJson([
                'success' => true,
                'data' => [
                    'topic' => [
                        'id' => 1,
                        'title' => $topic->title,
                        'voters' => [$this->user->id],
                        'user' => [
                            'id' => $this->user->id,
                            'name' => $this->user->name,
                        ],
                    ],
                ],
            ])
        ;

        $this->assertDatabaseHas('topics', [
            'id' => 1,
            'title' => $topic->title,
        ]);

        $this->assertDatabaseHas('votes', [
            'topic_id' => 1,
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * @test
     */
    public function user_cannot_add_a_topic_that_already_exists()
    {
        $topic = factory(Topic::class)->create();

        $response = $this->json('POST', 'api/add-new-topic', [
            'title' => $topic->title,
        ]);

        $response->assertStatus(422)
            ->assertJson([
                'success' => false,
                'data' => [],
            ])
        ;
    }
}
