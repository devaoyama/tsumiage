<?php

namespace Tests\Feature;

use App\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MypageControllerTest extends TestCase
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

        $userCount = User::count();

        for ($i = 1; $i < $userCount; $i++) {

            $user = User::find($i);

            $response = $this->actingAs($user)->get(route('mypage'));

            $response->assertStatus(200);

            if ($date = $user->date) {
                if ($task = $date->tasks()->first()) {
                    $response->assertSee($task->title);
                    $response->assertSee('<i class="fab fa-twitter-square"></i> ツイートする');
                } else {
                    $response->assertSee('タスクはありません。');
                }

                if (Carbon::parse($date->date) != Carbon::today() && $task && !$date->status) {
                    $response->assertSee('<i class="fas fa-exclamation-triangle"></i> 積み上げ削除');
                    $response->assertSee(Carbon::parse($date->date)->isoFormat('YYYY年MM月DD日 (ddd)'));
                } else {
                    $response->assertSee(Carbon::today()->isoFormat('YYYY年MM月DD日 (ddd)'));
                }
            } else {
                $response->assertSee('タスクはありません。');
                $response->assertSee(Carbon::today()->isoFormat('YYYY年MM月DD日 (ddd)'));
                $this->assertDatabaseHas('dates', [
                    'user_id' => $user->id,
                    'date' => Carbon::today()->format('yy-m-d 00:00:00'),
                ]);
            }
        }
    }
}
