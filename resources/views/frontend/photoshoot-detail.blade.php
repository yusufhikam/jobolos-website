@extends('layouts.frontend.frontendLayouts')
@section('title', 'Detail ' . $package->name . ' Package')
@section('content')
    <div class="content-container mb-5" style="margin-top:7rem; ">
        <div class="text-center" style="margin-bottom: 2rem;">
            <h3>Our</h3>
            <h1>{{ $package->name }} Package</h1>
            <hr class="w-25 border-2 m-auto mt-3">
        </div>

        <section class="content mb-4 mt-5">
            <div class="container my-5">
                <div class="card card-photoshoot-detail">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-12 col-sm-6 thumb-detail text-center">
                                <div class="img-photoshoot-detail-container">
                                    <img src="{{ asset('storage/admin_assets/package/' . $package->image) }}" alt=""
                                        class="img-fluid w-100">
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <div class="row">
                                    <div class="container-fluid">
                                        <div class="card-title">
                                            <h4>Detail Package :</h4>
                                        </div>
                                        <div class="card-text mb-5">
                                            <p>{!! htmlspecialchars_decode($package->deskripsi) !!}</p>
                                        </div>
                                        <div class="d-flex mx-3">
                                            <div class="col-sm-12  col-lg-6 bg-warning rounded">
                                                <h5>Package Price</h5>
                                                <h4 class=""><i class="fa-solid fa-tag"></i> IDR
                                                    {{ number_format($package->harga, 0, ',', '.') }}</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mx-auto mt-3">
                                    <div class="col-sm-12 col-lg-12">
                                        <a href="/jobolos/contact/photoshoot-booking"
                                            class="btn btn-success btn-lg btn-flat d-block p-3 ">
                                            <i class="fas fa-feather fa-lg mr-2 "></i>
                                            Book Now!
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <hr class="text-center m-auto text-success w-75 border-3 my-5">
            </div>
        </section>

        <div class="wave-container">
            <img src="/storage/frontend_assets/svg/wave(down).svg" alt="" class="wave-svg">

        </div>
        <div class="wave-container " style="height: 180px;">
            <img src="/storage/frontend_assets/svg/wave(up).svg" alt="" style="transform: scaleX(-1); "
                class="wave-svg">
        </div>

        <div class="container">
            <h3 class="text-center">Maybe You Might want to see Our Latest</h3>
            <h2 class="text-center">Stories</h2>
            <div class="row gy-4 p-2">
                <div class="scrollable-container">

                    @foreach ($infoAlbum as $album)
                        <div class="col-lg-3 latest-stories-img-photoshoot-detail">
                            <a href="/jobolos/album/{{ $album->id }}/{{ $album->title }}" class="img-container-latest"
                                aria-hidden="true">
                                {{-- <div class="loader"></div> --}}
                                <img src="/storage/admin_assets/gallery/00-thumbnails/{{ $album->title }}/{{ $album->thumbnail }}"
                                    alt="" class="img-fluid" />
                                <div class="overlay-latest-img"></div>
                                <div class="caption-overlay">
                                    <h4 aria-hidden="true" class="placeholder-glow">
                                        {{ $album->title }}</h4>
                                    <p aria-hidden="true" class="placeholder-glow">

                                        {{ $album->category->name }}</p>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
