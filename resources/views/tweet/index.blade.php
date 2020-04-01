@extends('layout')

@section('content')
    <div class="container mt-3 pt-4">
        <div class="text-center">
            <h3 class="mb-3">
                {{ $today->isoFormat('YYYY年MM月DD日 (ddd)') }}
            </h3>
            @if(session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
                </div>
            @endif
            @if($errors->any())
                <div class="alert alert-danger">
                    @foreach($errors->all() as $message)
                        {{ $message }}
                    @endforeach
                </div>
            @endif
            @if($tasks)
                <table class="table mb-4">
                    <tr>
                        <th>タスク名</th>
                        <th>ステータス</th>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td>{{ $task->title }}</td>
                            <td>
                                @if($task->status)
                                    <i class="far fa-check-circle text-primary" style="font-size: 25px"></i>
                                @else
                                    <i class="far fa-times-circle text-secondary" style="font-size: 25px"></i>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <form action="{{ route('tweet.confirm') }}" method="POST">
                    @csrf
                    @if(!Auth::user()->config->one_tweet)
                        <div class="form-group">
                            <p class="control-label"><b>ツイートの種類</b></p>
                            <div class="d-flex justify-content-center">
                                <div class="radio-inline mr-1">
                                    <input type="radio" value="0" name="status" id="false" {{ old('status') == '0' ? 'checked' : '' }} required>
                                    <label for="false">宣言ツイート</label>
                                </div>
                                <div class="radio-inline ml-1">
                                    <input type="radio" value="1" name="status" id="true" {{ old('status') == '1' ? 'checked' : '' }} required>
                                    <label for="true">報告ツイート</label>
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="comment">ひとこと</label>
                        <textarea class="form-control" name="comment" id="comment" rows="5">{{ old('comment') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-around">
                        <a class="btn btn-primary" href="{{ route('mypage') }}"><i class="fas fa-backward"></i> 戻る</a>
                        <button type="submit" class="btn btn-primary">確認画面へ <i class="fas fa-forward"></i></button>
                    </div>
                </form>
            @else
                <h4>タスクはありません</h4>
            @endif
        </div>
    </div>
@endsection
