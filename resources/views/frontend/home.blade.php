@extends('layouts.frontend.frontendLayouts')
@section('title', 'Home')
@include('layouts.frontend.carouselLayout')
@section('content')

    <div class="content-container ">


        <section class="content content-home">
            {{-- <div class="container"> --}}
            <div class="container-fluid mt-5" style="margin-top: 2rem;">
                <div class="jumbotrons-brand-logo text-center">
                    <img src="/storage/frontend_assets/brand-logo/jobolos-logo-black.png" alt="" width="150"
                        class="img-fluid">
                </div>

                <div class="jumbotrons text-center mt-2 ">
                    <h5>Thank You</h5>

                    <hr class="jumbotrons-hr border-3 w-25 m-auto my-4">

                    <p class="col-lg-4 m-auto mb-4">For your interest in <b style="font-weight: 500;">Jobolos
                            Photography</b>!</p>
                    <p class="col-lg-5 m-auto">We're so happy to receive news about your wedding. Jobolos Photography is
                        here to assist
                        you in capturing your wonderful moments. We truly believe that there's no such thing as coincidence.
                        The universe brought us together for a reason.</p>
                </div>
            </div>
            <div class=" latest-stories">
                <div class="img-container">
                    <img src="/storage/frontend_assets/background/jumbotrons-bg-4.jpg" class="img-fluid card-img"
                        alt="">
                    <div class="overlay"></div>
                    <div class="img-caption">
                        <h5>Our Latest</h5>
                        <h2>STORIES</h2>
                    </div>
                </div>
            </div>

            <div class="container mt-3">
                <div class="row gy-4 p-2">
                    @foreach ($albums as $album)
                        <div class="col-lg-4 latest-stories-img">
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

                <div class="text-center mt-5 ">
                    <a href="/jobolos/stories" class="btn btn-outline-secondary shadow d-inline-block">View All</a>
                </div>
            </div>

            {{-- <div class="row mt-0"> --}}
            <div class="wave-container wave-container-1">
                <img src="/storage/frontend_assets/svg/wave(down).svg" alt="" class="wave-svg">

            </div>
            <div class="wave-container wave-container-2">
                <img src="/storage/frontend_assets/svg/wave(up).svg" alt="" style="transform: scaleX(-1); "
                    class="wave-svg">
            </div>
            {{-- </div> --}}
            <div class="container-fluid justify-content-lg-between mt-3 why-us">
                <div class="container">
                    {{-- <div class="row gy-4 p-5">
                        <h2 class="text-center fw-bold">WHY US?</h2>
                        <div class="col-lg-3 text-center">
                            <div class=" jumbotrons-card ">
                                <div class="card-body px-2">
                                    <div class="row">
                                        <img src="/storage/frontend_assets/brand-logo/camera-ic.png" alt=""
                                            class="img-fluid">
                                    </div>
                                    <div class="row">
                                        <h5 class="fw-bold">Complete Photography Services</h5>
                                    </div>
                                    <div class="row">
                                        <p>Get your preferred photo session for every occasion or rent a camera</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 text-center">
                            <div class=" jumbotrons-card ">
                                <div class="card-body px-2">
                                    <div class="row">
                                        <img src="/storage/frontend_assets/brand-logo/price-ic.png" alt=""
                                            class="img-fluid">
                                    </div>
                                    <div class="row">
                                        <h5 class="fw-bold">Fixed Rate</h5>
                                    </div>
                                    <div class="row">
                                        <p>Easily booking photoshoot or rent camera with fixed price</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 text-center">
                            <div class=" jumbotrons-card ">
                                <div class="card-body px-2">
                                    <div class="row">
                                        <img src="/storage/frontend_assets/brand-logo/editing-ic.png" alt=""
                                            class="">
                                    </div>
                                    <div class="row">
                                        <h5 class="fw-bold">Unlimited Edit</h5>
                                    </div>
                                    <div class="row">
                                        <p>Get access unlimited edit photos</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 text-center">
                            <div class=" jumbotrons-card ">
                                <div class="card-body px-2">
                                    <div class="row">
                                        <img src="/storage/frontend_assets/brand-logo/payment-ic.png" alt=""
                                            class="img-fluid">
                                    </div>
                                    <div class="row">
                                        <h5 class="fw-bold">Easily Payment</h5>
                                    </div>
                                    <div class="row">
                                        <p>Book and transfer your payment with your mobile bank account</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            {{-- <div class=" latest-camera">
                <div class="img-container-camera">
                    <img src="/storage/frontend_assets/svg/bg-home-camera.svg" alt="" class="">
                    <div class="overlay-camera"></div>
                    <div class="img-caption-camera">
                        <h5>Our</h5>
                        <h2>RENTAL CAMERA UNITS</h2>
                    </div>
                </div>
            </div>
            <div class="container-fluid p-5" style="background: linear-gradient(to bottom, #002902, #001407); ">
                <div class="row  g-4">
                    @foreach ($homeCameraInfo as $camera)
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
    <section class="signup-section" id="signup">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-10 col-lg-8 mx-auto text-center">
                    <img width="100" style="filter: invert(1);" src="/storage/frontend_assets/brand-logo/connect-us.svg"
                        alt="">
                    <h2 class="text-white mb-5">Let's Connect With Us!</h2>
                    <div class="col-auto"><a href="/jobolos/contact" class="btn btn-success fw-bolder btn-flat p-3 w-50"
                            id="submitButton" type="submit">BOOKING NOW!</a></div>
                </div>
            </div>
        </div>
    </section>

    <section class="contact-section bg-black">
        <div class="container px-4 px-lg-5">
            <div class="row gx-4 gx-lg-5">
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fas fa-map-marked-alt text-success mb-2"></i>
                            <h4 class="text-uppercase m-0">Address</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">Desa Palan, Kecamatan Pamotan, Kabupaten Rembang, Jawa Tengah
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fa-brands fa-facebook text-success mb-2"></i>
                            <h4 class="text-uppercase m-0">Facebook</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a class="text-success"
                                    href="https://www.instagram.com/ochim_jobolos/">@ochim_jobolos</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fa-brands fa-instagram text-success mb-2"></i>
                            <h4 class="text-uppercase m-0">Instagram</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50"><a class="text-success"
                                    href="https://www.instagram.com/ochim_jobolos/">@ochim_jobolos</a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 mb-3 mb-md-0">
                    <div class="card py-4 h-100">
                        <div class="card-body text-center">
                            <i class="fa-brands fa-whatsapp text-success mb-2"></i>
                            <h4 class="text-uppercase m-0">WhatsApp</h4>
                            <hr class="my-4 mx-auto" />
                            <div class="small text-black-50">(+62) 852-9358-7548</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 my-3 mb-md-0 mx-auto">
                    <!-- Google Maps Iframe -->
                    <div class="card ">
                        <div class="card-body text-center p-0">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1980.992772350094!2d111.49088254871351!3d-6.771612860789885!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7717efad4b0e47%3A0x4dd562e33920f835!2sPalan%2C%20Pamotan%2C%20Rembang%20Regency%2C%20Central%20Java!5e0!3m2!1sen!2sid!4v1719688238351!5m2!1sen!2sid"
                                width="100%" height="300" style="border:0; margin:0px;" allowfullscreen=""
                                loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>


            <div class="social social-btn d-flex justify-content-center ">
                <a class="m-3 fs-4" href="#!"><i class="fa-brands fa-twitter  text-success"></i></a>
                <a class="m-3 fs-4" href="https://www.instagram.com/ochim_jobolos/"><i
                        class="fa-brands fa-facebook-f text-success"></i></a>
                <a class="m-3 fs-4" href="https://www.instagram.com/ochim_jobolos/"><i
                        class="fa-brands fa-instagram text-success"></i></a>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            // Simulate an API request or any async operation
            setTimeout(() => {
                hideLoader();
                showContent();
            }, 3000); // Replace with your actual data loading logic and time

            function hideLoader() {
                const loader = document.getElementById("loader");
                loader.style.display = "none";
            }

            function showContent() {
                const content = document.getElementById("content");
                content.style.display = "block";
            }
        });
    </script>
@endsection
