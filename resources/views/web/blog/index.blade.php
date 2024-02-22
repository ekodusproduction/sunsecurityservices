@extends('web.common.main')

@section('title', 'Blog | Sun Security Services')

@section('customHeader')
    <style>
        .title {
            font-size: 1.3rem;
        }

        .card-img-top{
            height: 200px;
            object-fit: cover;
        }

    </style>
@endsection

@section('main')
    <div class="container mt-100">
        <h3>Blogs</h3>

        <div class="row">
            @forelse ($blogs as $item)
                <div class="col-md-4">
                    <div class="card">
                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="{{ $item->image }}">
                        <div class="card-body">
                            <a class="text-decoration-none" href="{{route('site.blog', ['id'=>Crypt::encrypt($item->id)])}}"><h5 class="text-capitalize text-dark">{{ $item->title }}</h5></a>
                            <small>Admin | {{ date('d-m-Y', strtotime($item->created_at)) }}</small>
                        </div>
                    </div>
                </div>
            @empty
                <p>**No blogs found</p>
            @endforelse
        </div>
    </div>
@endsection

@section('customJS')
@endsection
