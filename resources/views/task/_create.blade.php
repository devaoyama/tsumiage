 <div>
    @if($errors->any())
        <div class="alert alert-danger">
            @foreach($errors->all() as $message)
                {{ $message }}
            @endforeach
        </div>
    @endif
    <form action="{{ route('tasks.create') }}" method="POST">
        @csrf
        <div class="form-group row">
            <div class="col">
                <input type="text" class="form-control" name="title" id="title" value="{{ old('title') }}" placeholder="タスクを入力してください">
            </div>
            <div class="mr-2">
                <button type="submit" class="btn btn-dark rounded-circle"><i class="fas fa-plus"></i></button>
            </div>
        </div>
    </form>
</div>
