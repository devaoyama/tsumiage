@extends('layout')

@section('content')
    <div class="container mt-5">
        @if($errors->any())
            <div class="alert alert-danger">
                @foreach($errors->all() as $message)
                    <p>{{ $message }}</p>
                @endforeach
            </div>
        @endif
        <form action="{{ route('tasks.create') }}" method="POST">
            @csrf
            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right">タイトル</label>
                <div class="col">
                    <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" />
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">追加</button>
            </div>
        </form>
    </div>
@endsection
