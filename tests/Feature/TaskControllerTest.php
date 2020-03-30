<?php

namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskControllerTest extends TestCase
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

        $user = User::inRandomOrder()->first();

        $response = $this->actingAs($user)->post(route('tasks.create'), ['title' => '開発']);

        $response->assertRedirect(route('mypage'));

        $this->assertDatabaseHas('tasks', ['title' => '開発']);
    }

    public function testChangeStatus()
    {
        $this->seed();

        $task = Task::first();

        $user = $task->date->user;

        $response = $this->actingAs($user)->get(route('tasks.changeStatus', ['task' => $task]));

        $response->assertRedirect(route('mypage'));

        $this->assertDatabaseHas('tasks', [
            'id' => $task->id,
            'status' => !$task->status
        ]);
    }

    public function testDelete()
    {
        $this->seed();

        $task = Task::first();

        $user = $task->date->user;

        $response = $this->actingAs($user)->get(route('tasks.delete', ['task' => $task]));

        $response->assertRedirect(route('mypage'));

        $this->assertDatabaseMissing('tasks', [
            'id' => $task->id,
        ]);
    }
}
