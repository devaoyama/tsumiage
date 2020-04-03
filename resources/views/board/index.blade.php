@extends('layout')

@section('styles')
    <style>
        div.card a {
            text-decoration: none!important;
            color: black;
        }
    </style>
@endsection

@section('content')
    <div class="container pt-4">
        <h2 class="mb-3"><i class="fas fa-angle-right mr-2"></i>積み上げ掲示板</h2>
        <h3>{{ \Carbon\Carbon::today()->isoFormat('YYYY年MM月DD日 (ddd)') }}</h3>

        <div class="row">
            @foreach($dates as $date)
                <div class="col-lg-6">
                    <div class="card bg-light mb-4">
                        <div class="card-header">
                            <a href="https://twitter.com/{{ $date->user->nickname }}" target="_blank">
                                <img src="{{ $date->user->avatar }}" class="rounded-circle" height="30" width="30">
                                {{ $date->user->name }}
                            </a>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title">
                                @if($date->user->config->one_tweet)
                                    ツイート
                                @elseif($date->status)
                                    報告ツイート
                                @else
                                    宣言ツイート
                                @endif
                            </h5>
                            <p class="card-text p-2 border border-white rounded">{!! nl2br($date->content) !!}</p>
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $dates->links() }}
        </div>
    </div>
@endsection
