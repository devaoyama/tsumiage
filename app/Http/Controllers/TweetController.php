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

        if (!$tasks || $tasks->isEmpty()) {
            return redirect()->route('mypage');
        }

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

        $errorMsg = null;
        try {
            $connection->post("statuses/update", ["status" => $text]);
        } catch (TwitterOAuthException $exception) {
            $errorMsg = $exception->getMessage();
        }

        $code = $connection->getLastHttpCode();

        if ($code === 200) {
            return redirect()->route('mypage')->with('success', '投稿が完了しました');
        }

        if ($code === 403) {
            return redirect()->route('tweet.index')->with('message', '文字数が長すぎます')->withInput();
        }

        if (!$errorMsg) {
            $errorMsg = 'ツイートに失敗しました。再度ログインしてみてください';
        }

        return redirect()->route('mypage')->with('error', $errorMsg);
    }
}
