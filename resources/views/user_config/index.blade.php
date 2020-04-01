@extends('layout')

@section('content')
    <div class="container pt-4">
        <h2 class="mb-3">設定</h2>
        <form action="{{ route('config.save') }}" method="post">
            @csrf
            <table class="table">
                <tr>
                    <th>
                        <label for="before_comment">宣言ツイート:</label>
                    </th>
                    <td>
                        <textarea id="before_comment" class="form-control" name="before_comment">{{ $config->before_comment }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        <label for="after_comment">報告ツイート:</label>
                    </th>
                    <td>
                        <textarea id="after_comment" class="form-control" name="after_comment">{{ $config->after_comment }}</textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="public" name="public" @if($config->public) checked @endif>
                            <label class="form-check-label" for="public">公開</label>
                        </div>
                    </td>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="one_tweet" name="one_tweet" @if($config->one_tweet) checked @endif>
                            <label class="form-check-label" for="one_tweet">1ツイート</label>
                        </div>
                    </td>
                </tr>
            </table>
            <button type="submit" class="btn btn-primary">保存</button>
        </form>
    </div>
@endsection
