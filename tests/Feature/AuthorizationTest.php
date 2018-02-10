<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    public function testExample()
    {
        $prefix = "api/v1/";

        $user = factory(User::class)->create();
        $user = User::find(3);

        $this
            ->actingAs($user, "api")
            ->post($prefix . "aa")->assertStatus(200);
//            ->assertSee("uck");
    }
}
