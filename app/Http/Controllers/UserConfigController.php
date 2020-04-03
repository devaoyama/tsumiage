<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConfigForm;
use Illuminate\Support\Facades\Auth;

class UserConfigController extends Controller
{
    public function index()
    {
        $config = Auth::user()->config;

        return view('user_config.index', [
            'config' => $config
        ]);
    }

    public function save(ConfigForm $request)
    {
        $config = Auth::user()->config;

        $config->public = $request->public == true;
        $config->one_tweet = $request->one_tweet == true;
        $config->before_comment = $request->before_comment;
        $config->after_comment = $request->after_comment;
        $config->save();

        return redirect()->route('mypage')->with('success', '設定を保存しました');
    }
}
