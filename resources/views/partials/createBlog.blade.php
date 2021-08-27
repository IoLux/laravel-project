<form action="{{$url}}" method="{{$methode}}">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Title" value="{{old("title")}}" required autofocus>
        @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="col-sm-3">
        <label for="category" class="form-label">Category</label>
        <select id="category" class="form-select" name="category" required>
            <option selected>Choose...</option>
            <option value="1">Web Programming</option>
            <option value="2">Web Design</option>
            <option value="3">Personal</option>
        </select>
  </div>
    <div class="mb-3">
        <label for="body" class="form-label">Write Your Blog Here!!</label>
        <textarea class="form-control @error('body') is-invalid @enderror" name="body" id="body" rows="3" required>{{old('body')}}</textarea>
        @error('body')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
    <span>
        <small><a href="/home">Go Back</a></small>
    </span>


</form>