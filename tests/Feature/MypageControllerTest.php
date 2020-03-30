<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;

class MypageControllerTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $user = User::inRandomOrder()->first();

        $response = $this->actingAs($user)->get(route('mypage'));

        $response->assertStatus(200);
    }
}
