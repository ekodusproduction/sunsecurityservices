@extends('web.common.main')

@section('title', 'Gallery | Sun Security Services')

@section('customHeader')
    <!-- LightBox -->
    <link rel="stylesheet" href="{{ asset('website_assets/plugins/lightbox/css/lightbox.min.css') }}">
@endsection

@section('main')
    <div class="container" id="gallery">
        <h2>Gallery</h2>
        <div class="row">
            <div class="col-md-12 col-sm-12 gallery-section">
                @forelse ($images as $item)
                    <a href="{{ asset($item->image) }}" data-lightbox="ourGallery">
                        <img src="{{ asset($item->image) }}" alt="Gallery images">
                    </a>
                @empty
                    <div class="card p-5">
                        <p class="mb-0">**No images found</p>
                    </div>
                @endforelse

                <div class="mt-3 d-flex justify-content-center">
                    {{ $images->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('customJS')
    <!-- LightBox JS-->
    <script src="{{ asset('website_assets/plugins/lightbox/js/lightbox-plus-jquery.min.js') }}"></script>
@endsection
