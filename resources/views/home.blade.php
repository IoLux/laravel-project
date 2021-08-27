@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session()->has('success'))
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>{{session('success')}}</strong>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>

            @endif

            <div class="text-center">
                <form action="" method="get">
                    @if (request('category'))
                        <input type="hidden" name="category" value="{{ request('category') }}">
                        <div hidden>
                            {{$title = "Category of " . request('category')}}
                        </div>            
                    @endif
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Search.." name="search" value="{{request('search')}}">
                        <button class="btn btn-danger" type="submit">Search</button>
                    </div>
                </form>
            </div>
            <div class="card">
                <div class="card-header">
                    <div class="text-center">
                        {{ __($title) }}
                    </div>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($articles->count())
                    @foreach ($articles as $article)
                        <div class="row mb-3 justify-content-center">
                            <div class="card text-center" style="width: 18rem;">
                                <img src="https://source.unsplash.com/1600x900/?{{$article->category->title}}" class="card-img-top" alt="img">
                                <h5 class="card-title position-absolute bg-dark px-2 py-2" style="backgroud-color: rgba(0,0,0,0.7);" data-toggle="tooltip" data-placement="bottom" title="{{$article->category->title}}"><a href="/home?category={{$article->category->slug}}">{{$article->category->title}}</a></h5>
                                <a href="/home/view/{{$article->slug}}" data-toggle="tooltip" data-placement="bottom" title="{{$article->title}}">
                                    <div class="card-body">
                                    <p class="card-text">{{$article->title}}</p>
                                </a>
                                </div>
                                @if ($article->user->id == Auth::id())
                                <div class="card-footer">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-primary" onclick="document.location='/home/edit/{{$article->slug}}/{{$article->user->username}}'" data-toggle="tooltip" data-placement="bottom" title="Edit Your Article">Edit</button>
                                        <button type="button" class="btn btn-primary" onclick="document.location='/'">Middle</button>
                                        <button type="button" class="btn btn-primary" onclick="document.location='/home/delete/{{$article->id}}'" data-toggle="tooltip" data-placement="bottom" title="Delete Your Article">Delete</button>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                    @endforeach
                    @else
                        <p class="text-center fs-4">no Post found</p>
                    @endif
                </div>
                 <div class="card-footer text-muted">
                    {{$articles->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
