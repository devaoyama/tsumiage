<?php

namespace App\Http\Controllers;

use App\Config;
use App\Http\Requests\ConfigForm;
use Illuminate\Support\Facades\Auth;

class UserConfigController extends Controller
{
    public function index()
    {
        if (!$config = Auth::user()->config) {
            $config = new Config();
        }

        return view('user_config.index', [
            'config' => $config
        ]);
    }

    public function save(ConfigForm $request)
    {
        $user = Auth::user();
        if (!$config = $user->config) {
            $config = new Config();
            $config->user_id = $user->id;
        }

        $config->public = $request->public == true;
        $config->one_tweet = $request->one_tweet == true;
        $config->before_comment = $request->before_comment;
        $config->after_comment = $request->after_comment;
        $config->save();

        return redirect()->route('mypage')->with('success', '設定を保存しました');
    }
}
