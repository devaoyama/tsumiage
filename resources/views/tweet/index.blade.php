@extends('layout')

@section('content')
    <div class="container mt-3">
        <div class="text-center">
            <h3 class="mb-3">
                {{ $today->isoFormat('YYYY年MM月DD日 (ddd)') }}
            </h3>
            @if(session('message'))
                <div class="alert alert-danger">
                    {{ session('message') }}
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
                                    <span class="badge badge-info">完了</span>
                                @else
                                    <span class="badge badge-warning">未完了</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
                <form action="{{ route('tweet.tweet') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="text">ひとこと</label>
                        <textarea class="form-control" name="text" id="text" rows="5">{{ old('text') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-around">
                        <button type="button" onclick="history.back()" class="btn btn-primary" value="true">戻る</button>
                        <button type="submit" class="btn btn-primary">ツイート</button>
                    </div>
                </form>
            @else
                <h4>タスクはありません</h4>
            @endif
        </div>
    </div>
@endsection
