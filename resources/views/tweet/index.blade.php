@extends('layout')

@section('content')
    <div class="container mt-3">
        <div class="text-center">
            <h3>
                {{ $today->isoFormat('YYYY年MM月DD日 (ddd)') }}
            </h3>
            @if($tasks)
                <table class="table">
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
                        <textarea class="form-control" name="text" id="text">{{ old('text') }}</textarea>
                    </div>
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">ツイート</button>
                    </div>
                </form>
            @else
                <h4>タスクはありません</h4>
            @endif
        </div>
    </div>
@endsection
