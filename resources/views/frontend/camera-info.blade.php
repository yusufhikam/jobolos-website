@extends('layouts.frontend.frontendLayouts')
@section('title', 'Camera Info')
@section('content')
    <div class="content-container mb-5" style="margin-top:7rem; ">
        <div class="text-center" style="margin-bottom: 2rem;">
            <h3>Our</h3>
            <h1>Rental Camera Package</h1>

            <p class="m-auto text-center my-3 col-lg-4">" Please select the camera you are looking to rent. The camera's
                specifications and availability are listed below. Kindly book as soon as possible and Let's Connect "</p>
            <hr class="w-25 border-2 m-auto mt-5">
        </div>
        <section class="content mb-4 mt-5">
            <div class="container">
                <div class="row  g-4">
                    @foreach ($cameras as $camera)
                        <div class="col-lg-3">
                            <div class="card card-rental">
                                <div class="rental-img-container ">
                                    <img src="{{ asset('/storage/admin_assets/rental-kamera/camera/' . $camera->camera_types->brands->name . '/' . $camera->name . '/thumbnail/' . $camera->thumbnail) }}"
                                        class="card-img-top img-fluid" alt="...">
                                    @if ($camera->rentals->isNotEmpty() && $camera->rentals->first()->status == 'active')
                                        <div class="ribbon-wrapper ribbon-xl">
                                            <div class="ribbon bg-warning text-md">
                                                Currently Rented
                                            </div>
                                        </div>
                                    @else
                                        <div class="ribbon-wrapper ribbon-xl">
                                            <div class="ribbon bg-primary text-md">
                                                Available
                                            </div>
                                        </div>
                                    @endif
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
            </div>
            <hr class="text-center m-auto text-success w-75 border-3 my-5">

        </section>
    </div>
@endsection
