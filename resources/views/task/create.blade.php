@extends('layout')

@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    @endif
    <form action="{{ route('tasks.create') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">タイトル</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
        </div>
        <div class="text-right">
            <button type="submit" class="btn btn-primary">送信</button>
        </div>
    </form>
@endsection
