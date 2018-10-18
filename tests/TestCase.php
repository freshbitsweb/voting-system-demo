<?php

namespace Tests;

use App\User;
use Laravel\Passport\Passport;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    /**
     * Creates an enpert record and logs in as that expert for passport.
     *
     * @return \App\Expert
     */
    public function apiLogin()
    {
        $user = factory(User::class)->create();
        Passport::actingAs($user);

        return $user;
    }
}
