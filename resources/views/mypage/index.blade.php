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
                                <form name="task_change_status" method="post" action="{{ route('tasks.changeStatus', ['task' => $task]) }}">
                                    @csrf
                                    @if($task->status)
                                        <a href="javascript:task_change_status.submit()"><i class="far fa-check-circle text-primary" style="font-size: 25px"></i></a>
                                    @else
                                        <a href="javascript:task_change_status.submit()"><i class="far fa-circle text-secondary" style="font-size: 25px"></i></a>
                                    @endif
                                </form>
                            </td>
                            <td @if($task->status) class="done" @endif>{{ $task->title }}</td>
                            <td>
                                <form name="task_delete" method="post" action="{{ route('tasks.delete', ['task' => $task]) }}">
                                    @csrf
                                    <a href="javascript:task_delete.submit()"><i class="fas fa-minus-circle text-danger" style="font-size: 25px"></i></a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                <div class="d-flex justify-content-between">
                    @if($dateStatus)
                        <button type="button" class="delete-confirm btn btn-warning" data-toggle="modal" data-target="#confirm-delete"><i class="fas fa-exclamation-triangle"></i> 積み上げ削除</button>
                    @endif
                    <a href="{{ route('tweet.index') }}" class="btn btn-primary ml-auto"><i class="fab fa-twitter-square"></i> ツイートする</a>
                </div>
            @else
                <h4>
                    タスクはありません。<br>
                    タスクを追加してみましょう！
                </h4>
            @endif
        </div>
        <div class="card mt-5 bg-light">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-angle-right mr-2"></i>手順</h4>
                <ol class="card-text">
                    <li>タスクを追加する</li>
                    <li>「ツイートする」ボタンを押す</li>
                    <li>「宣言ツイート」を選択して、コメントを入力する</li>
                    <li>ツイートする</li>
                    <li>積み上げる</li>
                    <li>積み上げが完了したらタスク名の左の○を押す</li>
                    <li>「ツイートする」ボタンを押す</li>
                    <li>「報告ツイート」を選択して、コメントを入力する</li>
                    <li>ツイートする</li>
                </ol>
                <h4 class="card-title"><i class="fas fa-exclamation-triangle mr-2"></i>注意</h4>
                <ul class="card-text">
                    <li>報告ツイートをすると、日付が変わり次第自動でタスクが削除されます。</li>
                </ul>
            </div>
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
