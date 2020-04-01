<?php

namespace Tests\Feature;

use App\Date;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DateControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testCreate()
    {
        $this->seed();

        $date = Date::inRandomOrder()->first();

        $user = $date->user;

        $date->delete();

        $this->assertDatabaseMissing('dates', [
            'id' => $date->id,
        ]);

        $response = $this->actingAs($user)->get(route('dates.create'));

        $newDate = User::find($user->id)->date;

        $this->assertDatabaseHas('dates', [
            'id' => $newDate->id,
        ]);

        $response->assertRedirect(route('mypage'));
    }
}
