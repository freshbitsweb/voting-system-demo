<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;

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

        Artisan::call('passport:client', [
            '--password' => 1, '--name' => 'Voting System'
        ]);
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
            'API development',
            'Testing in Laravel',
            'Laravel Design patterns',
            'Solid principles of programming',
        ];
    }
}
