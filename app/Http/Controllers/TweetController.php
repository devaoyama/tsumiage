<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class TweetController extends Controller
{
    public function index()
    {
        Carbon::setLocale('ja_JP');
        $today = Carbon::today();
        $tasks = null;
        if ($dates = Auth::user()->dates()->where('date', $today)->first()) {
            if ($dates->tasks()->get()->count()) {
                $tasks = $dates->tasks()->get();
            }
        }

        return view('tweet.index', [
            'today' => $today,
            'tasks' => $tasks,
        ]);
    }

    public function tweet(Request $request)
    {
        $user = Auth::user();
        $connection = new TwitterOAuth(
            config('app.twitter_consumer_key'),
            config('app.twitter_secret_key'),
            $user->twitter_token,
            $user->twitter_token_secret
        );

        $connection->setTimeouts(10, 15);

        Carbon::setLocale('ja_JP');
        $today = Carbon::today();
        $tasks = null;
        if ($dates = Auth::user()->dates()->where('date', $today)->first()) {
            if ($dates->tasks()->get()->count()) {
                $tasks = $dates->tasks()->get();
            }
        }

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
