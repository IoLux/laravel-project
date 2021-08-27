@extends('layouts.basic')

@section('title')
    Create Blog
@endsection


@section('container')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                @include('partials.createBlog')
            </div>
        </div>
    </div>
@endsection