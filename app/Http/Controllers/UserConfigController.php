<?php

namespace App\Http\Controllers;

use App\Config;
use Illuminate\Http\Request;
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

    public function save(Request $request)
    {
        $config = Auth::user()->config;

        $config->public = $request->public === 'on';
        $config->one_tweet = $request->one_tweet === 'on';
        $config->before_comment = $request->before_comment;
        $config->after_comment = $request->after_comment;
        $config->save();

        return redirect()->route('config.index');
    }
}
