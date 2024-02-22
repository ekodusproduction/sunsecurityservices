@extends('web.common.main')

@section('title', 'Blog | Sun Security Services')

@section('customHeader')
    <style>
        .blog-title {
            font-size: 2rem;
        }

    </style>
@endsection

@section('main')
    <div class="container mt-100" id="blog">
        <p class="blog-title">{{ $blog->title }}</p>

        <img class="w-100" src="{{ asset($blog->image) }}" alt="{{ $blog->image }}">
        <small>Admin | {{ date('d-m-Y', strtotime($blog->created_at)) }}</small>

        <div>
            {!! $blog->description !!}
        </div>
    </div>
@endsection

@section('customJS')
@endsection
