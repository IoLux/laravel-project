<form action="{{$url}}" method="{{$methode}}">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" placeholder="Title" value="{{$article->title}}">
    </div>
    <div class="col-sm-3">
        <label for="category" class="form-label">Category</label>
        <select id="category" class="form-select" name="category">
            <option selected>Choose...</option>
            <option value="1">Web Programming</option>
            <option value="2">Web Design</option>
            <option value="3">Personal</option>
        </select>
  </div>
    <div class="mb-3">
        <label for="body" class="form-label">Write Your Blog Here!!</label>
        <textarea class="form-control" name="body" id="body" rows="3">{{$article->body}}</textarea>
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
        <input class="btn btn-primary" type="submit" value="Submit">
    </div>
</form>