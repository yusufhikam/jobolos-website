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
                {{-- FILTERING INFO CAMERA --}}
                <div class="col-lg-3 col-sm-6 d-inline-flex mb-3 border bg-secondary bg-opacity-25  text-light rounded ">
                    <div class="btn-group dropend ">
                        <button type="button" class="btn dropdown-toggle btn-filtering" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-filter" style="color: #ffd500;"></i> Filtering By
                        </button>
                        <ul class="dropdown-menu dropdown-menu-filtering">
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Brands</a>
                                <ul class="dropdown-menu">
                                    @foreach ($brands as $brand)
                                        <li><a class="dropdown-item"
                                                href="{{ route('frontend.camera-info', ['brand' => $brand->id]) }}">{{ $brand->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Camera Types</a>
                                <ul class="dropdown-menu">
                                    @foreach ($cameraTypes as $cameraType)
                                        <li><a class="dropdown-item"
                                                href="{{ route('frontend.camera-info', ['camera_type' => $cameraType->id]) }}">{{ $cameraType->name }}
                                                - {{ $cameraType->brands->name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                            <li class="dropdown-submenu">
                                <a class="dropdown-item dropdown-toggle" href="#">Status</a>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item"
                                            href="{{ route('frontend.camera-info', ['status' => '!active']) }}">Available</a>
                                    </li>
                                    <li><a class="dropdown-item"
                                            href="{{ route('frontend.camera-info', ['status' => 'active']) }}">Currently
                                            Rented</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="btn-group">
                        <a href="{{ route('frontend.camera-info') }}" class="btn btn-filtering"><i class="fa-solid fa-ban"
                                style="color: #ff0000;"></i> No Filtering</a>
                    </div>
                </div>

                {{-- MENAMPILKAN DATA KAMERA --}}
                @if ($cameras->isEmpty())
                    <div class=" alert alert-danger text-center " role="alert">
                        <h2>Oops!</h2>
                        <h4>We're sorry</h4>
                        <p>data is currently unavailable, please wait for some time.
                        </p>
                    </div>
                @else
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
                @endif
                {{-- PAGINATION --}}

                <div class="mt-2">
                    {{ $cameras->withQueryString()->links() }}
                </div>
            </div>
            <hr class="text-center m-auto text-success w-75 border-3 my-5">

        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Menangani submenu pada dropdown filtering
            document.querySelectorAll('.dropdown-submenu a.dropdown-toggle').forEach(function(element) {
                element.addEventListener('click', function(e) {
                    e.stopPropagation();
                    e.preventDefault();

                    var submenu = element.nextElementSibling;

                    if (submenu.classList.contains('show')) {
                        submenu.classList.remove('show');
                    } else {
                        // Tutup semua submenu yang sedang terbuka
                        document.querySelectorAll('.dropdown-submenu .dropdown-menu-filtering.show')
                            .forEach(function(sub) {
                                sub.classList.remove('show');
                            });

                        submenu.classList.add('show');
                    }
                });
            });

            // Tutup submenu saat dropdown utama tertutup
            document.querySelectorAll('.btn-filtering').forEach(function(button) {
                button.addEventListener('click', function() {
                    document.querySelectorAll('.dropdown-submenu .dropdown-menu-filtering.show')
                        .forEach(function(sub) {
                            sub.classList.remove('show');
                        });
                });
            });
        });
    </script>
@endsection
