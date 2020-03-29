@extends('layout')

@section('content')
    <div class="container pt-4">
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
                <div class="d-flex justify-content-between">
                    <button type="button" class="delete-confirm btn btn-warning" data-toggle="modal" data-target="#confirm-delete">積み上げ削除</button>
                    <a href="{{ route('tweet.index') }}" class="btn btn-primary"><i class="fab fa-twitter-square"></i> ツイートする</a>
                </div>
            @else
                <h4>タスクはありません</h4>
            @endif
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">確認</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    この積み上げを削除しますか？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">いいえ</button>
                    <a href="{{ route('dates.create') }}" class="btn btn-danger">はい</a>
                </div>
            </div>
        </div>
    </div>
@endsection
