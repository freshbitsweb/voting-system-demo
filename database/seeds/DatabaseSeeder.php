<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->getStaticTopics() as $topic) {
            factory(App\Topic::class)->create([
                'title' => $topic
            ]);
        }

        factory(App\User::class, 10)->create();
    }

    /**
     * Returns the list of topics
     *
     * @return array
     **/
    public function getStaticTopics()
    {
        return [
            'Package Development',
            'Performant Laravel',
            'In-depth Authentication',
            'Headache-free Deployments',
            'API development',
            'Queues & Jobs',
            'Testing in Laravel',
            'Advanced Eloquent',
            'Vue.JS',
        ];
    }
}
