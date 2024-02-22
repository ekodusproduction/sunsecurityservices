@extends('web.common.main')

@section('title', 'Career | Sun Security Services')

@section('customHeader')
    <style>
        .single {
            display: flex;
            justify-content: space-between;
            padding: 10px 20px;
        }

        .single a {
            color: rgb(160, 39, 2);
        }

    </style>
@endsection

@section('main')
    <div class="container" id="career">
        <h2>Open Positions</h2>
        <div class="card py-4 px-4">
            @forelse ($jobs as $index => $item)
                <div class="single">
                    <h6>{{ $index + 1 }}. <a
                            href="{{ route('site.career', ['id' => Crypt::encrypt($item->id)]) }}">{{ $item->title }}</a>
                    </h6>
                    <h6><i class="fas fa-map-marker-alt"></i> {{ $item->location }}</h6>
                </div>
            @empty
                <p>**Currently no openings.</p>
            @endforelse
        </div>
    </div>
@endsection

@section('customJS')
@endsection
