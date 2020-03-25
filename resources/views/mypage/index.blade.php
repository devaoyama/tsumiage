@extends('layout')

@section('content')
    <div class="container mt-3">
        <div class="text-center">
            <h3>
                {{ $today->isoFormat('YYYY年MM月DD日 (ddd)') }}
            </h3>
            @if($tasks && $tasks->count())
                <table class="table">
                    <tr>
                        <th>タスク名</th>
                        <th>ステータス</th>
                        <th>削除</th>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td @if($task->status) class="done" @endif>{{ $task->title }}</td>
                            <td>
                                @if($task->status)
                                    <a href="{{ route('tasks.changeStatus', ['task' => $task]) }}" class="btn btn-info">完了</a>
                                @else
                                    <a href="{{ route('tasks.changeStatus', ['task' => $task]) }}" class="btn btn-warning">未完了</a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('tasks.delete', ['task' => $task]) }}" class="btn bnt-sm btn-danger">削除</a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h4>タスクはありません</h4>
            @endif
            <div>
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">タスク作成</a>
                <a href="{{ route('tweet.index') }}" class="btn btn-primary">ツイート</a>
            </div>
        </div>
    </div>
@endsection
