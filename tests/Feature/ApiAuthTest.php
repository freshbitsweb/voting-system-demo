<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiAuthTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function endpoint_cannot_be_accessed_without_a_token()
    {
        $response = $this->json('GET', 'api/get-topics');
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function endpoint_cannot_be_accessed_with_an_invalid_token()
    {
        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . str_random(1072),
        ])->json('GET', 'api/get-topics');

        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function endpoint_can_be_accessed_with_a_valid_token()
    {
        Artisan::call('passport:client', [
            '--personal' => 1, '--name' => 'Voting System'
        ]);

        $user = factory(User::class)->create();
        $token = $user->createToken('Test')->accessToken;

        $response = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('GET', 'api/get-topics');

        $response->assertOk();
    }
}
