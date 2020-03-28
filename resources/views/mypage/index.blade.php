@extends('layout')

@section('content')
    <div class="container mt-3">
        <div class="text-center">
            <h3 class="mb-3">
                {{ $today->isoFormat('YYYY年MM月DD日 (ddd)') }}
            </h3>
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @include('task._create')
            @if($tasks && $tasks->isNotEmpty())
                <table class="table mb-4">
                    <tr>
                        <th></th>
                        <th>タスク名</th>
                        <th>削除</th>
                    </tr>
                    @foreach($tasks as $task)
                        <tr>
                            <td>
                                @if($task->status)
                                    <a href="{{ route('tasks.changeStatus', ['task' => $task]) }}"><i class="far fa-check-circle text-primary" style="font-size: 25px"></i></a>
                                @else
                                    <a href="{{ route('tasks.changeStatus', ['task' => $task]) }}"><i class="far fa-circle text-secondary" style="font-size: 25px"></i></a>
                                @endif
                            </td>
                            <td @if($task->status) class="done" @endif>{{ $task->title }}</td>
                            <td>
                                <a href="{{ route('tasks.delete', ['task' => $task]) }}"><i class="fas fa-minus-circle text-danger" style="font-size: 25px"></i></a>
                            </td>
                        </tr>
                    @endforeach

                </table>
                <div class="text-right">
                    <a href="{{ route('tweet.index') }}" class="btn btn-primary"><i class="fab fa-twitter-square"></i> ツイートする</a>
                </div>
            @else
                <h4>タスクはありません</h4>
            @endif
        </div>
    </div>
@endsection
