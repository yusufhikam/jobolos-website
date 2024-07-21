@extends('layouts.frontend.frontendLayouts')
@section('title', 'Photoshoot Packages')
@section('content')
    <div class="content-container mb-5" style="margin-top:7rem; ">
        <div class="text-center" style="margin-bottom: 2rem;">
            <h3>Our</h3>
            <h1>Photoshoot Packages</h1>
            <hr class="w-25 border-2 m-auto mt-3">
        </div>
        <p class="m-auto text-center mb-3 col-lg-4">" Please take a look at the our <b>Packages</b> below. We will
            always be there for you,
            whatever you need we will give our best to capture your every precious moment with us. "</p>
        <section class="content ">
            <div class="container my-5">
                <div class="d-flex ">
                    <div class="row g-4 justify-content-center">
                        @foreach ($photoPackages as $pcg)
                            <div class="col-lg-4">
                                <div class="card card-photoshoot-package">
                                    <div class="card-img-container-photoshoot">
                                        <img src="{{ asset('storage/admin_assets/package/' . $pcg->image) }}"
                                            alt="Package Photoshoot" class="card-img-top card-img-package">
                                    </div>
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-between " style="margin-top: 4rem;">
                                            <div class="col-9 position-absolute bottom-0 start-0 mb-3">
                                                <h3 class="  fw-semibold">{{ $pcg->name }}</h1>
                                                    <div class=" d-inline-block p-1">
                                                        <h5 class="card-text"><i class="fa fa-solid fa-tag"></i> IDR
                                                            {{ number_format($pcg->harga, 0, ',', '.') }}</h5>
                                                    </div>
                                            </div>
                                            <div class="col-3 position-absolute bottom-0 end-0 mb-3">
                                                <a href="/jobolos/package-info/photoshoot-detail-{{ $pcg->id }}/{{ urlencode($pcg->name) }}"
                                                    class="btn float-end btn-detail-package"><i
                                                        class="fa-solid fa-circle-arrow-right fa-3x"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <hr class="text-center m-auto  w-75 border-3 my-5">

            <div class="wave-container">
                <img src="/storage/frontend_assets/svg/wave(down).svg" alt="" class="wave-svg">

            </div>
            <div class="wave-container">
                <img src="/storage/frontend_assets/svg/wave(up).svg" alt="" style="transform: scaleX(-1); "
                    class="wave-svg">
            </div>

            {{-- <div class="container">
                <h3 class="text-center mb-5">You might also be interested in our rental camera packages</h3>
                <div class="row  g-4">
                    @foreach ($cameraPackages as $camera)
                        <div class="col-lg-3">
                            <div class="card card-rental">
                                <div class="rental-img-container ">
                                    <img src="{{ asset('/storage/admin_assets/rental-kamera/camera/' . $camera->camera_types->brands->name . '/' . $camera->name . '/thumbnail/' . $camera->thumbnail) }}"
                                        class="card-img-top img-fluid" alt="...">

                                </div>
                                <div class="card-body">
                                    <h4>{{ $camera->camera_types->brands->name }} {{ $camera->name }}</h4>
                                    <hr class="w-50">
                                    <h6 class="card-text">Rental Rate per Day</h6>
                                    <div class="bg-warning rounded d-inline-block p-1">
                                        <h4 class="card-text"><i class="fa fa-solid fa-tag"></i> IDR
                                            {{ number_format($camera->harga_per_hari, 0, ',', '.') }}</h4>
                                    </div>
                                    <br>
                                    <small>Include :</small>
                                    <p>[Lens Kit 18-55mm]</p>
                                    <hr>
                                    <div class="float-end mt-2">
                                        <a href="/jobolos/camera-detail-{{ $camera->id }}/{{ $camera->name }}"
                                            class="btn btn-success ">View Detail</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div> --}}
        </section>
    </div>
@endsection
