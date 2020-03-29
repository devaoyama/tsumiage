@extends('layout')

@section('styles')
    <style>
        .cover {
            background-image: url("images/main.jpeg");
            background-size: cover;
            background-position: center;
            min-height: 400px;
            max-height: 640px;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            position: relative;
        }

        .header-title {
            position: absolute;
            top: 30%;
        }

        .footer-cover {
            background-image: url("images/footer.jpeg");
            background-size: cover;
            background-position: center;
            min-height: 300px;
            max-height: 400px;
            max-width: 1600px;
            width: 100%;
            margin: 0 auto;
            position: relative;
        }

        .footer-cover-top {
            position: absolute;
            top: 30%;
        }

        ul {
            list-style: none;
        }

        .list-title {
            font-size: 35px;
        }
    </style>
@endsection

@section('content')
    <div class="cover">
        <div class="d-block">
            <div class="header-title container pl-5">
                <h1 class="text-dark font-weight-bold">積み上げくんで<br>積み上げよう</h1>
                @if (Auth::check())
                    <a href="{{ route('mypage') }}" class="btn btn-primary font-weight-bold" style="padding: 12px;"><i class="fab fa-twitter"></i> マイページへ移動</a>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary font-weight-bold" style="padding: 12px;"><i class="fab fa-twitter"></i> ツイッターでログイン</a>
                @endif
            </div>
        </div>
    </div>

    <div class="top-wrapper mt-lg-5 mt-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 pr-4 mb-3">
                    <h3 class="mb-3"><i class="fas fa-circle"></i> 「#今日の積み上げ」とは</h3>
                    <p>
                        有名インフルエンサーであるマナブさんが作り出したTwitterのハッシュタグのことです。<br>
                        このハッシュタグは、新しいことに挑戦しようとしている人や日々積み上げている人などを後押しできるように
                        作り出したみたいです。
                    </p>
                    <p>
                        マナブさんのツイッターはこちらから→
                        <a href="https://twitter.com/manabubannai" class="btn btn-primary" target="_blank"><i class="fab fa-twitter"></i></a>
                    </p>
                </div>
                <div class="col-lg-6">
                    <h3 class="mb-3"><i class="fas fa-circle"></i> このアプリを使うメリット</h3>
                    <p>
                        ツイッターによる連携ログインで、今までツイッターのアプリに打ち込んでいたタスクがWeb上で管理できるようになります。<br>
                        ツイッターアプリからツイートするのではなく、このアプリからツイートすることができます。<br>
                        ツイート内容は、勝手にアプリが生成してくれ、ご利用者はコメントを考えるだけで良くなります。
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="3step-wrapper">
        <div class="container mt-5 mb-5">
            <h3 class="text-center list-title mb-5"><i class="fas fa-angle-right mr-2"></i>使い方</h3>

            <div class="card-deck mb-4">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">ツイッターに連携</h5>
                        <p class="card-text">ツイッターアカウントに連携することでこのアプリが使用できるようになります。</p>
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">タスクを追加</h5>
                        <p class="card-text">その日のタスクを追加しましょう。タスクの追加しすぎには注意しましょう。</p>
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">宣言ツイート</h5>
                        <p class="card-text">タスクを追加したら、その内容をアプリからツイートしてみましょう。</p>
                    </div>
                </div>
            </div>
            <div class="card-deck">
                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">ステータスの変更</h5>
                        <p class="card-text">タスクが完了したらタスク名の左側の○を押して、ステータスを完了にしましょう。</p>
                    </div>
                </div>

                <div class="card bg-light">
                    <div class="card-body">
                        <h5 class="card-title">報告ツイート</h5>
                        <p class="card-text">その日が終わったら、アプリから報告ツイートをしましょう。</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="mind-wrapper mb-5">
        <div class="py-5">
            <div class="container">
                <h2 class="font-weight-bold pb-2 text-center list-title">積み上げくんの機能</h2>
                <div class="mt-5">
                    <div class="px-5  mt-5 d-flex justify-content-center">
                        <ul>
                            <li class="mb-3"><i class="fas fa-check text-info mr-3"></i>タスクの追加・削除</li>
                            <li class="mb-3"><i class="fas fa-check text-info mr-3"></i>タスクのステータス管理</li>
                            <li class="mb-3"><i class="fas fa-check text-info mr-3"></i>タスクの内容をコメント付きでツイート</li>
                            <li class="mb-3"><i class="fas fa-check text-info mr-3"></i>ツイートの際は「#今日の積み上げ」をつける</li>
                            <li class="mb-3"><i class="fas fa-check text-info mr-3"></i>報告ツイートをして、日付が変わるとタスクが更新される</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="footer-wrapper">
        <div class="footer-cover">
            <div class="container text-white">
                <div class="footer-cover-top">
                    <h1 class="font-weight-bold footer-title">積み上げてみますか？</h1>
                    @if (Auth::check())
                        <a href="{{ route('mypage') }}" class="btn btn-primary font-weight-bold" style="padding: 12px;"><i class="fab fa-twitter"></i> マイページへ移動</a>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary font-weight-bold" style="padding: 12px;"><i class="fab fa-twitter"></i> ツイッターでログイン</a>
                    @endif
            </div>
        </div>
    </section>
@endsection
