<?php

namespace Tests\Feature;

use App\Config;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserConfigControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $this->seed();

        $config = Config::inRandomOrder()->first();

        $user = $config->user;

        $response = $this->actingAs($user)->get(route('config.index'));

        $response->assertStatus(200);

        $response->assertSee($config->before_comment);

        $response->assertSee($config->after_comment);
    }

    public function testSave()
    {
        $this->seed();

        $config = Config::inRandomOrder()->first();

        $user = $config->user;

        $response = $this->actingAs($user)->post(route('config.save'), [
            'before_comment' => 'おはよう',
            'after_comment' => 'お疲れ様でした',
        ]);

        $response->assertRedirect(route('config.index'));

        $this->assertDatabaseHas('configs', [
            'before_comment' => 'おはよう',
            'after_comment' => 'お疲れ様でした',
        ]);
    }
}
