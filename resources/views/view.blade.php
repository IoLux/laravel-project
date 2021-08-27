@extends('layouts.basic')

@section('title')
    {{$article->title}} - Blog
@endsection

@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <h1 class="text-center mb-3">{{$article->title}}</h1>
                <small>The article created at {{$article->created_at->diffForHumans()}}</small>
                <img src="https://source.unsplash.com/1200x800/?{{$article->category->title}}" class="card-img-top mb-2" alt="img">
                <p>{{$article->body}}</p>
                <small><a href="/home">Go Back</a></small>
            </div>
        </div>
    </div>
@endsection