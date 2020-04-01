<?php

namespace App\Http\Controllers;

use Abraham\TwitterOAuth\TwitterOAuth;
use Abraham\TwitterOAuth\TwitterOAuthException;
use App\DataProvider\DateRepository;
use App\DataProvider\TaskRepository;
use App\Http\Requests\TweetForm;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TweetController extends Controller
{
    public function index(TaskRepository $repository)
    {
        Carbon::setLocale('ja_JP');
        $today = Carbon::today();
        $tasks = $repository->getTasks();

        if (!$tasks || $tasks->isEmpty()) {
            return redirect()->route('mypage');
        }

        return view('tweet.index', [
            'today' => $today,
            'tasks' => $tasks,
        ]);
    }

    public function tweetConfirm(TweetForm $request, TaskRepository $repository)
    {
        $user = Auth::user();

        $tasks = $repository->getTasks();

        $text = null;
        if ($request->status || $user->config->one_tweet) {
            if ($text = $user->config->after_comment) {
                $text = $text."\n\n";
            }
        } elseif ($request->status === '0' && $text = $user->config->before_comment) {
            $text = $text."\n\n";
        }

        $text = $text."#今日の積み上げ\n";
        foreach ($tasks as $task) {
            if ($task->status) {
                $text = $text."✅".$task->title."\n";
            }
            if (!$task->status) {
                $text = $text."・".$task->title."\n";
            }
        }

        if ($comment = $request->comment) {
            $text = $text."\n".$comment;
        }

        return view('tweet.confirm', [
            'text' => $text,
            'comment' => $comment,
            'status' => $request->status,
        ]);
    }

    public function tweet(TweetForm $request, DateRepository $repository)
    {
        $user = Auth::user();
        $connection = new TwitterOAuth(
            config('app.twitter_consumer_key'),
            config('app.twitter_secret_key'),
            $user->twitter_token,
            $user->twitter_token_secret
        );
        $connection->setTimeouts(10, 15);

        $text = $request->text;

        $errorMsg = null;
        try {
            $connection->post("statuses/update", ["status" => $text]);
            $request->session()->regenerateToken();
        } catch (TwitterOAuthException $exception) {
            $errorMsg = $exception->getMessage();
        }

        $code = $connection->getLastHttpCode();

        if ($code === 200) {
            if ($request->status === '1' || $user->config->one_tweet) {
                $repository->changeStatusTrue();
            }
            return redirect()->route('mypage')->with('success', '投稿が完了しました');
        }

        if ($code === 403) {
            return redirect()->route('tweet.index')->with('message', 'ツイート内容が長すぎます')->withInput();
        }

        if (!$errorMsg) {
            $errorMsg = 'トークンの有効期限が切れています。再度ログインしてみてください';
        }

        $request->session()->regenerateToken();

        return redirect()->route('mypage')->with('error', $errorMsg);
    }
}
