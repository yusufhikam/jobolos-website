@extends('layouts.frontend.frontendLayouts')
@section('title', 'Camera Detail')
@section('content')
    <div class="content-container mb-5" style="margin-top:7rem; ">
        <div class="text-center" style="margin-bottom: 2rem;">
            <h3>Detail Camera Rental</h3>
            <h1>{{ $cameras->camera_types->brands->name }} {{ $cameras->name }}</h1>

            {{-- <p class="m-auto text-center my-3 col-lg-4">"  "</p> --}}
            <hr class="w-25 border-2 m-auto mt-5">
        </div>
        <section class="content mb-4 mt-5">
            <div class="container">
                <div class="card card-solid">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <h3 class="d-block d-sm-none text-center">Hello There!</h3>

                                <div id="carouselExampleIndicators" class="col-12 carousel slide" style="height:500px;">
                                    <div class="carousel-indicators">
                                        @foreach (json_decode($cameras->image) as $index => $image)
                                            <button type="button" data-bs-target="#carouselExampleIndicators"
                                                data-bs-slide-to="{{ $index }}"
                                                @if ($index == 0) class="active" @endif
                                                aria-label="Slide {{ $index + 1 }}"></button>
                                        @endforeach
                                    </div>
                                    <div id="carouselInner" class="carousel-inner detail-camera-img">
                                        @foreach (json_decode($cameras->image) as $index => $image)
                                            @if ($index == 0)
                                                <div class="carousel-item  active">
                                                    <img src="{{ asset('/storage/admin_assets/rental-kamera/camera/' . $cameras->camera_types->brands->name . '/' . $cameras->name . '/' . $image) }}"
                                                        class="d-block w-100" alt="...">
                                                </div>
                                            @else
                                                <div class="carousel-item">
                                                    <img src="{{ asset('/storage/admin_assets/rental-kamera/camera/' . $cameras->camera_types->brands->name . '/' . $cameras->name . '/' . $image) }}"
                                                        class="d-block w-100" alt="...">
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                    <button class="carousel-control-prev" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                        data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6">
                                <h3 class="my-3">{{ $cameras->camera_types->brands->name }} {{ $cameras->name }}</h3>
                                <p>{!! htmlspecialchars_decode($cameras->deskripsi) !!}</p>

                                <div class="bg-warning py-2 px-3 mt-4 rounded">
                                    <h4 class="mt-0">
                                        <small><i class="fa fa-solid fa-tag"></i> Rental Rate per Day </small>
                                    </h4>
                                    <h2 class="mb-0">
                                        IDR {{ number_format($cameras->harga_per_hari, 0, ',', '.') }}
                                    </h2>
                                    <p>Include : Lens Kit 18-55mm</p>
                                </div>

                                <div class="mt-4 float-end">
                                    <a href="/jobolos/rental-camera-booking/{{ $cameras->id }}/{{ $cameras->name }}"
                                        class="btn btn-success btn-lg btn-flat">
                                        <i class="fas fa-feather fa-lg mr-2"></i>
                                        Book Now!
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <hr class="text-center m-auto text-success w-75 border-3 my-5">

        </section>
    </div>
@endsection
<script>
    $('#carouselExampleIndicators').on('slide.bs.carousel', function(e) {
        var $indicator = $(e.relatedTarget).index();
        $('.image-indicators img').removeClass('active');
        $('.image-indicators img:eq(' + $indicator + ')').addClass('active');
    });
</script>
