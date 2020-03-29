@extends('layout')

@section('content')
    <div class="container pt-4">
        <div class="card bg-light mx-auto" style="max-width: 50rem">
            <div class="card-header">
                <h3 class="card-title mb-0">
                    @if($status === '1')
                        報告ツイート
                    @else
                        宣言ツイート
                    @endif
                </h3>
            </div>
            <div class="card-body">
                <pre class="card-text">{{ $text }}</pre>
            </div>
            <div class="card-footer">
                <form action="{{ route('tweet.tweet') }}" method="post">
                    @csrf
                    <input type="hidden" name="text" value="{{ $text }}">
                    <input type="hidden" name="comment" value="{{ $comment }}">
                    <input type="hidden" name="status" value="{{ $status }}">
                    <div class="d-flex justify-content-around">
                        <button type="button" onclick="history.back()" class="btn btn-primary"><i class="fas fa-backward"></i> 戻る</button>
                        <button type="submit" class="btn btn-primary"><i class="fab fa-twitter"></i> ツイート</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $("form").submit(function() {
            $(":submit", this).prop("disabled", true);
        });
    </script>
@endsection
