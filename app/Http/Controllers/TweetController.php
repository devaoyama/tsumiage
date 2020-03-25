<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;
use App\DataProvider\TaskRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function index(TaskRepository $repository)
    {
        Carbon::setLocale('ja_JP');
        $today = Carbon::today();
        $tasks = $repository->getTodayTasks($today);

        return view('tweet.index', [
            'today' => $today,
            'tasks' => $tasks,
        ]);
    }

    public function tweet(Request $request, TaskRepository $repository)
    {
        $user = Auth::user();
        $connection = new TwitterOAuth(
            config('app.twitter_consumer_key'),
            config('app.twitter_secret_key'),
            $user->twitter_token,
            $user->twitter_token_secret
        );
        $connection->setTimeouts(10, 15);

        $today = Carbon::today();
        $tasks = $repository->getTodayTasks($today);

        $text = "#今日の積み上げ\n";
        foreach ($tasks as $task) {
            if ($task->status) {
                $text = $text."✅".$task->title."\n";
            }
            if (!$task->status) {
                $text = $text."・".$task->title."\n";
            }
        }

        if ($value = $request->text) {
            $text = $text."\n".$value;
        }

        try {
            $connection->post("statuses/update", ["status" => $text]);
        } catch (TwitterOAuthException $exception) {
            dd($connection->getLastHttpCode(), $exception->getMessage());
        }

        return redirect()->route('mypage');
    }
}
