@extends('layouts.frontend.frontendLayouts')
@section('title', 'About Us')
{{-- @include('layouts.frontend.carouselLayout') --}}
@section('content')

    <div class="content-container about-us-header text-light">

        <section class="content">
            <div class="about-us-container text-center col-lg-5 mx-auto " style="">
                <img src="/storage/frontend_assets/brand-logo/jobolos-logo-white.png" alt=""
                    class="img-fluid mt-5 pt-5" width="300" height="300">
                <h1 class="about-us-title">Hi!</h1>
                <h5 class="about-us-subtitle">WE'RE JOBOLOS PHOTOGRAPHY</h5>
                <hr>
                <p>Muhammad Abdul Rokhim as the owner and creator of Jobolos Photography. We are a photography vendor that
                    has been established since 2018. We offer photography services for wedding, pre-wedding, engagement,
                    graduation or family photos. We are located in Palan village, Pamotan sub-district, Rembang district,
                    Central Java. </p>
            </div>

            <hr class="border-2  m-auto mt-5">
        </section>
    </div>

    <div class="container-fluid p-5 text-light about-us-middle">
        <h1 class="about-us-title text-center">Our Teams</h1>
        <hr class="w-25 mx-auto border-2">

        <div class="p-4">
            @foreach ($crews as $index => $crew)
                @if ($index % 2 == 0)
                    <div class="row my-5  " id="crew-info">
                        <div class="col-lg-4 card-about">
                            <div class="about-img-container">
                                <img src="/storage/admin_assets/dataCrew/{{ $crew->image }}" alt="{{ $crew->name }}"
                                    class="card-img-top card-img-package">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row p-3">
                                <h3>{{ $crew->name }}</h3>
                                <p>{!! htmlspecialchars_decode($crew->deskripsi) !!}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                @else
                    <div class="row my-5  flex-row-reverse" id="crew-info">
                        <div class="col-lg-4 card-about">
                            <div class="about-img-container">
                                <img src="/storage/admin_assets/dataCrew/{{ $crew->image }}" alt="{{ $crew->name }}"
                                    class="card-img-top card-img-package">
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="row p-3">
                                <h3>{{ $crew->name }}</h3>
                                <p>{!! htmlspecialchars_decode($crew->deskripsi) !!}</p>
                            </div>
                        </div>
                        <hr>
                    </div>
                @endif
            @endforeach
        </div>
        <hr class="text-center m-auto  w-75 border-3">
    </div>



    <div class="container-fluid" style="background: #010101;">
        <div class="row g-0 justify-content-center about-footer-content">
            <div class="col-lg-6" id="about-img-footer-container">
                <img src="/storage/frontend_assets/background/bg-about-us-footer.jpeg" alt="" class="img-fluid">
            </div>
            <div class="bg-dark col-lg-6">
                <div class="container text-footer">
                    <h2>Glad to look for the incredible things and make it a meaningful story.</h2>
                    <p>You like things that others have never thought of. You might think when someone
                        laughs,
                        cries, or lost in a personal intimate unrepeatable moment and no one can capture uniquely.</p>
                    <p>Jobolos Photography is a team that can make every details of that moments stored well wherever
                        you are.
                        Our shots will take you to memories that is almost forgotten and bring you back to the
                        meaningful story in that day with laughter, crying, or your little smile.</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{-- <script>
        // Mengatur latar belakang body
        document.body.style.backgroundImage = "url('/storage/frontend_assets/background/bg-about-us.jpg')";
        // document.body.style.backgroundSize = "cover";
        document.body.style.height = "100vh";
        document.body.style.backgroundRepeat = "no-repeat";
    </script> --}}
@endsection
