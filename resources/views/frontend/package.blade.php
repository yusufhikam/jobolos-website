@extends('layouts.frontend.frontendLayouts')
@section('title', 'Package')
@section('content')
    <div class="content-container mb-5" style="margin-top:7rem; ">
        <h1 class="text-center mt-5 mb-1">Hello There!</h1>
        <h3 class="text-center mb-5">Looking for a photographer or Camera gear?</h3>
        <p class="m-auto text-center mb-3 col-lg-4">" Please look at the <b>Packages</b> listed below. We will
            always be there for you do our best to record every wonderful moment you share with us."</p>
        <hr class="text-center m-auto text-success w-75 border-3">
        <section class="content mb-4">
            <div class="container">
                <h3 class="my-5 text-center">What do you need ?</h3>

                <div class="d-flex ">
                    <div class="row gy-3 justify-content-center">
                        <div class="col-lg-5">
                            <div class="card card-package">
                                <div class="card-img-container">
                                    <img src="/storage/frontend_assets/background/photoshoot_packages.jpeg"
                                        alt="Package Photoshoot" class="card-img-top card-img-package">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bolder">Photoshoot Packages</h5>
                                    <p class="card-text">If you need documentation for your special moments with good
                                        quality media and professional crew, we have several photo session packages that you
                                        can use. Take a look and contact us. </p>
                                    <a href="/jobolos/package-info/photoshoot-packages" class="btn btn-package">See
                                        More...</a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="card card-package">
                                <div class="card-img-container">
                                    <img src="/storage/frontend_assets/background/camera_rental.jpg"
                                        alt="Package Photoshoot" class="card-img-top card-img-package">
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title fw-bolder">Camera Rental</h5>
                                    <p class="card-text"> Looking for the best camera gear for your next project? We rent
                                        out high-quality cameras and accessories at affordable prices. Ideal for either
                                        professionals or enthusiasts. Improve your photos today!</p>
                                    <a href="/jobolos/package-info/camera-info" class="btn btn-package">See More...</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="text-center m-auto text-success w-75 border-3 my-5">

        </section>
    </div>
@endsection
