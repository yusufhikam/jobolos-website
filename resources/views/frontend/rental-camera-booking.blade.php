@php
    use Carbon\Carbon;

@endphp

@extends('layouts.frontend.frontendLayouts')
@section('title', 'Rental Camera Booking')
@section('content')
    <div class="content-container mb-5" style="margin-top:7rem;">
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
                                <h3 class="d-block d-sm-none text-center">Hello @if (Auth::check())
                                        {{ Auth::user()->name }}
                                    @else
                                        There!
                                    @endif
                                </h3>

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
                                @if ($cameraRented)
                                    <div class="border border-danger rounded mb-5 text-center p-4 d-flex align-items-center justify-content-center"
                                        style="height: 500px;">
                                        <div class="row">
                                            <div class="col bg-danger-subtle rounded py-2">
                                                <h3 class="mb-4"><b class="text-danger">Oops!</b><br>We're sorry <br><br>
                                                    This camera is currently rented and cannot be booked at this time.
                                                </h3>
                                                @foreach ($cameras->rentals as $rental)
                                                    <div class="bg-danger d-inline-block p-2 rounded mb-3">
                                                        <h5 class="text-light  my-auto">This camera will be
                                                            available again
                                                            around
                                                            {{ Carbon::parse($rental->tgl_kembali)->format('j F Y') }}
                                                        </h5>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @if (Auth::check())
                                        <form action="{{ route('frontend.rental-booking') }}" method="POST">
                                            @csrf
                                            {{-- Camera_id --}}
                                            <input type="hidden" name="camera_id" value="{{ $cameras->id }}">

                                            <div class="col mb-3">
                                                <label for="lens_id" class="form-label text-secondary">Lens Type</label>
                                                <select class="form-select" name="lens_id" id="lens_id" required>
                                                    @foreach ($cameras->camera_types->lenses as $lens)
                                                        <option value="{{ $lens->id }}">{{ $lens->name }} [
                                                            {{ $cameras->camera_types->name }} ] // Rp
                                                            {{ number_format($lens->harga_per_hari, 0, ',', '.') }}</option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('lens_id'))
                                                    <p class="text-danger mt-1 error-input">{{ $errors->first('lens_id') }}
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="col mb-3">
                                                <label for="tgl_sewa" class="form-label text-secondary">Rental Date</label>
                                                <input class="form-control" type="date" name="tgl_sewa" id="tgl_sewa"
                                                    value="{{ old('tgl_sewa') }}" required>
                                                @if ($errors->has('tgl_sewa'))
                                                    <p class="text-danger mt-1 error-input">
                                                        {{ $errors->first('tgl_sewa') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="col mb-3">
                                                <label for="tgl_kembali" class="form-label text-secondary">Return
                                                    Date</label>
                                                <input class="form-control" type="date" name="tgl_kembali"
                                                    id="tgl_kembali" value="{{ old('tgl_kembali') }}" required>
                                                @if ($errors->has('tgl_kembali'))
                                                    <p class="text-danger mt-1 error-input">
                                                        {{ $errors->first('tgl_kembali') }}
                                                    </p>
                                                @endif
                                            </div>

                                            <div class="col mb-3">
                                                <label for="jaminan" class="form-label text-secondary">Guarantee</label>
                                                <input class="form-control" type="text" value="KTP"
                                                    aria-label="Disabled input example" disabled readonly>
                                                <input type="hidden" name="jaminan" value="KTP">
                                                @if ($errors->has('jaminan'))
                                                    <p class="text-danger mt-1 error-input">{{ $errors->first('jaminan') }}
                                                    </p>
                                                @endif
                                            </div>
                                            <div class="text-center">
                                                <button style="height: 3rem;" type="submit"
                                                    class="btn btn-success col-lg-6 btn-package">SUBMIT</button>
                                            </div>
                                        </form>
                                    @else
                                        <div class="border border-danger rounded mb-5 text-center p-4 d-flex align-items-center justify-content-center"
                                            style="height: 500px;">
                                            <div class="row">
                                                <div class="col">
                                                    <h3 class="mb-4"><b class="text-danger">Oops!</b><br><br>We're sorry
                                                        you
                                                        have to login first to make a rent camera booking.</h3>
                                                    <a href="/login" class="btn btn-success col-lg-6">LOGIN</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endif
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
