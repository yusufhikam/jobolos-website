@extends('layouts.frontend.frontendLayouts')
@section('title', 'Contact Us')
@section('content')
    <div class="content-container " style="margin-top:7rem; ">
        <h1 class="text-center mt-5 mb-3">Let's Connect With Us!</h1>
        <p class="m-auto text-center mb-3 col-lg-6">"You ready to capture your wonderful moments? Do you require the best
            camera equipment for your project? <b>Book now!</b> Fill out the form below to book a photoshoot or
            rent a camera.
            Jobolos Photography is ready to assist you and provide the best service"</p>
        <hr class="text-center m-auto text-success w-75 border-3">
        <section class="content mb-4">
            <div class="container mb-5">
                <h3 class="my-5 text-center">Which one will you book ?</h3>

                <div class="d-flex ">
                    <div class="row gy-3 justify-content-center">
                        <div class="col-lg-5">
                            <div class="card card-package">
                                <div class="card-img-container">
                                    <img src="/storage/frontend_assets/background/bg-booking-photoshoot.jpeg"
                                        alt="Book a Photoshoot" class="card-img-top card-img-package">
                                </div>
                                <div class="card-body">
                                    <h5 class="fw-bolder text-center bg-success p-2">Book a Photoshoot</h5>
                                    <p class="card-text">If you need documentation for your special moments with good
                                        quality media and a professional crew, <b>book a photoshoot session with us</b>.
                                        Click the button below to start your booking.</p>
                                </div>
                                <div class="my-2 mx-1 text-center">
                                    <a href="/jobolos/contact/photoshoot-booking" class="col-lg-6 btn btn-package">BOOK NOW
                                        !</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card card-package">
                                <div class="card-img-container">
                                    <img src="/storage/frontend_assets/background/bg-booking-camera.jpg"
                                        alt="Book a Photoshoot" class="card-img-top card-img-package">

                                </div>
                                <div class="card-body">
                                    <h5 class="fw-bolder text-center bg-success p-2">Rent a Camera</h5>
                                    <p class="card-text"> Need the best camera gear for your next project? Rent our
                                        high-quality cameras at affordable prices. Click the button below to
                                        start your booking.</p>
                                </div>
                                <div class="my-2 mx-1 text-center">
                                    <a href="/jobolos/package-info/camera-info" class="col-lg-6 btn btn-package">BOOK NOW
                                        !</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
