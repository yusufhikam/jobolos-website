<div id="carouselExampleAutoplaying" class="carousel slide carousel-fade" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($sliders as $index => $slider)
            <button type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide-to="{{ $index }}"
                class="{{ $index == 0 ? 'active' : '' }}" aria-current="{{ $index == 0 ? 'true' : '' }}"
                aria-label="Slide {{ $index + 1 }}"></button>
        @endforeach
    </div>
    <div class="carousel-inner">
        @foreach ($sliders as $index => $slider)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}" data-bs-interval="2000">
                <img src="{{ asset('storage/admin_assets/sliders/' . $slider->image) }}" class="d-block w-100"
                    alt="...">
                {{-- @if ($index == 0)
                    <div class="carousel-caption d-flex align-items-center justify-content-center h-100">
                        <div class="text-center brand-carousel">
                            <h1>JOBOLOS PHOTOGRAPHY</h1>
                            <div class="col-lg-4 m-auto">
                                <p>Each wedding has its own life. Every couple is unique and has their own love story.
                                    Don't
                                    let
                                    the happiest day of your life pass without documenting it</p>
                            </div>
                            <div class="row d-flex justify-content-center">
                                <a href="/jobolos/contact"
                                    class="btn btn-success p-3 col-lg-2 m-2 btn-flat fw-semibold">GET
                                    STARTED</a>
                                <a href="/jobolos/package-info"
                                    class="btn btn-dark p-3 col-lg-2 m-2 btn-flat fw-semibold">PACKAGES</a>
                            </div>
                        </div>
                    </div>
                @endif --}}
            </div>
        @endforeach
    </div>
    <button class="carousel-control-prev carousel-btn-arrow" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next carousel-btn-arrow" type="button" data-bs-target="#carouselExampleAutoplaying"
        data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
