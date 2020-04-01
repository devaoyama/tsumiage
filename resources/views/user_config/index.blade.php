@extends('layout')

@section('content')
    <div class="container pt-4">
        <h2 class="mb-3">設定</h2>
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                    {{ $message }}
                @endforeach
            </div>
        @endif
        <form action="{{ route('config.save') }}" method="post">
            @csrf
            <table class="table">
                <tr>
                    <th>
                        <label for="before_comment">コメント設定</label>
                    </th>
                    <td>
                        <label for="before_comment">宣言ツイート:</label>
                        <textarea id="before_comment" class="form-control" name="before_comment" rows="3">{{ $config->before_comment }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                    </th>
                    <td>
                        <label for="after_comment">報告ツイート:</label>
                        <textarea id="after_comment" class="form-control" name="after_comment" rows="3">{{ $config->after_comment }}</textarea>
                    </td>
                </tr>
                <tr>
                    <th>
                        積み上げを公開
                    </th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" value="true" type="checkbox" id="public" name="public" @if($config->public) checked @endif>
                            <label class="form-check-label" for="public">公開</label>
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>
                        1日1ツイート
                    </th>
                    <td>
                        <div class="form-check">
                            <input class="form-check-input" value="true" type="checkbox" id="one_tweet" name="one_tweet" @if($config->one_tweet) checked @endif>
                            <label class="form-check-label" for="one_tweet">1ツイート</label>
                        </div>
                    </td>
                </tr>
            </table>
            <div class="d-flex justify-content-around">
                <a href="{{ route('mypage') }}" class="btn btn-secondary">マイページへ</a>
                <button type="submit" class="btn btn-primary">保存</button>
            </div>
        </form>
        <div class="card mt-5 bg-light">
            <div class="card-body">
                <h4 class="card-title"><i class="fas fa-angle-right mr-2"></i>設定について</h4>
                <ul class="card-text">
                    <li>
                        <h5>コメント設定</h5>
                        <p>
                            各ツイートの出だしのコメントを予め設定することができます。<br>
                            1日1ツイートしかしない方は報告ツイートの方にコメントを設定してください。
                        </p>
                    </li>
                    <li>
                        <h5>公開</h5>
                        <p>
                            このアプリでは、今日の積み上げをしている仲間と高め合っていくために、みなさんの積み上げを表示できるスペースがあります。
                            そちらに公開したくない方は公開設定をオフにしてください。
                        </p>
                    </li>
                    <li>
                        <h5>1日1ツイート</h5>
                        <p>宣言または報告のどちらか1ツイートしかしない方はオンにしてください。</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
