@extends('layouts.frontend.frontendLayouts')
@section('title', 'Album ' . $albums->title)
@section('content')

    <div class="content-container mb-4" style="margin-top:7rem;">

        <div class="text-center " style="margin-bottom: 5rem;">
            <h5>Stories {{ $albums->category->name }} of</h5>
            <h1>{{ strtoupper($albums->title) }}</h1>
            <hr class="w-25 border-2 m-auto mt-3">
        </div>

        <section class="content">
            <div class="container d-flex " id="album-container">
                <div class="row gy-5 album-img-container justify-content-center mx-auto">

                    @foreach ($albums->photos as $index => $photo)
                        <div class="gallery-item text-center">
                            <img src="{{ asset('/storage/admin_assets/gallery/' . $albums->title . '/' . $photo->name) }}"
                                onclick="openModal();currentSlide({{ $index + 1 }})" class="hover-shadow img-fluid">
                        </div>
                    @endforeach
                </div>

                <!-- The Modal/Lightbox -->
                <div id="myModal" class="modal modal-stories">
                    <span class="close cursor" onclick="closeModal()"><i class="fa-solid fa-xmark"></i></span>
                    <div class="modal-content modal-content-stories" style="position: relative;">
                        @foreach ($albums->photos as $index => $photo)
                            <div class="mySlides">
                                <div class="numbertext">{{ $index + 1 }} / {{ $albums->photos->count() }}</div>
                                <img src="{{ asset('/storage/admin_assets/gallery/' . $albums->title . '/' . $photo->name) }}"
                                    style="width:100%;">
                            </div>
                        @endforeach

                        <!-- Next/previous controls -->
                        <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                        <a class="next" onclick="plusSlides(1)">&#10095;</a>

                        <!-- Caption text -->
                        <div class="caption-container" style="padding: 10px; text-align: center;">
                            <p id="caption"></p>
                        </div>

                        <!-- Thumbnail indicator image controls -->
                        <div class="thumbnail-container">
                            <div class="row justify-content-center">
                                @foreach ($albums->photos as $index => $photo)
                                    <div class="thumbnail col ">
                                        <img class="demo"
                                            src="{{ asset('/storage/admin_assets/gallery/' . $albums->title . '/' . $photo->name) }}"
                                            onclick="currentSlide({{ $index + 1 }})" alt=""
                                            style="width: 150px; height: auto;">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </section>
        <hr class="w-25 border-2 m-auto my-5">

    </div>
@endsection

@section('scripts')
    <script>
        // Open the Modal
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Close the Modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        var slideIndex = 1;
        showSlides(slideIndex);

        // Next/previous controls
        function plusSlides(n) {
            showSlides(slideIndex += n);
        }

        // Thumbnail image controls
        function currentSlide(n) {
            showSlides(slideIndex = n);
        }

        function showSlides(n) {
            var i;
            var slides = document.getElementsByClassName("mySlides");
            var dots = document.getElementsByClassName("demo");
            var captionText = document.getElementById("caption");
            if (n > slides.length) {
                slideIndex = 1
            }
            if (n < 1) {
                slideIndex = slides.length
            }
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            captionText.innerHTML = dots[slideIndex - 1].alt;
        }
        // document.getElementById('load-more').addEventListener('click', function() {
        //     var button = this;
        //     var nextPageUrl = button.getAttribute('data-next-page-url');

        //     if (!nextPageUrl) return;

        //     fetch(nextPageUrl, {
        //             headers: {
        //                 'X-Requested-With': 'XMLHttpRequest'
        //             }
        //         }).then(response => response.json())
        //         .then(data => {
        //             if (data.albums) {
        //                 document.querySelector('#album-container .row').insertAdjacentHTML('beforeend', data
        //                     .albums);

        //                 if (data.next_page_url) {
        //                     button.setAttribute('data-next-page-url', data.next_page_url);
        //                 } else {
        //                     document.getElementById('load-more-container').remove();
        //                 }
        //             }
        //         }).catch(error => console.error('Error Loading More Albums : ', error));
        // });
    </script>

@endsection
