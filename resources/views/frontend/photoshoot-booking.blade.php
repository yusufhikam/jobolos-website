@extends('layouts.frontend.frontendLayouts')
@section('title', 'Photoshoot Booking')
@section('content')
    <div class="content-container " style="margin-top:7rem;">
        @if (Auth::check())
            <h1 class="text-center mt-5 mb-3">Hello, {{ Auth::user()->name }}!</h1>
        @else
            <h1 class="text-center mt-5 mb-3">Hello, There!</h1>
        @endif
        <p class="m-auto text-center mb-3 col-lg-6">"Thank you for choosing us to capture your precious moments.<br>Please
            fill out the booking form below to use our services."</p>
        <hr class="text-center m-auto text-success w-75 border-3">
        <section class="content mb-4">
            <div class="container-fluid">
                <h3 class="my-5 text-center">Let's start creating precious moments to remember forever</h3>


                <div class="row g-4 d-flex justify-content-center p-4">
                    <div class="col-lg-5 col-sm-12">
                        <div class="card bg-calendar">
                            <div class="card-body" style="text-decoration: none;">
                                <h3 class="p-2 text-center text-light border border-2  rounded">Booked
                                    Photoshoot
                                    Date</h3>
                                <div class=" col-lg-12 mt-3 p-2">
                                    <div id='calendar'></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card col-lg-7 ">
                        <div class="card-body">
                            @if (Auth::check())
                                <form action="" method="POST">
                                    @csrf
                                    <div class="col mb-3">
                                        <label for="tanggal" class="form-label text-secondary">Estimated Date</label>
                                        <input class="form-control" type="date" name="tanggal" id="tanggal">
                                        @if ($errors->has('tanggal'))
                                            <p class="text-danger mt-1 error-input">{{ $errors->first('tanggal') }}</p>
                                        @endif
                                    </div>
                                    <div class="col mb-3">
                                        <label for="packages" class="form-label text-secondary">Packages</label>
                                        <select class="form-select" name="package_id" id="packages">
                                            <option value="">-- Select Packages --</option>
                                            @foreach ($paket as $pcg)
                                                <option value="{{ $pcg->id }}">{{ $pcg->name }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('package_id'))
                                            <p class="text-danger mt-1 error-input">{{ $errors->first('package_id') }}</p>
                                        @endif
                                    </div>
                                    <div class="col mb-3">
                                        <label for="location_type" class="form-label text-secondary">Event Location</label>
                                        <select class="form-select" name="location_type" id="location_type">
                                            <option value="">-- Select Location --</option>
                                            <option value="rembang">Kabupaten Rembang</option>
                                            <option value="other">Luar Kota</option>
                                        </select>
                                        @if ($errors->has('location_type'))
                                            <p class="text-danger mt-1 error-input">{{ $errors->first('location_type') }}
                                            </p>
                                        @endif
                                        <p id="additional_message" class="text-danger mt-1" style="display: none;">* Untuk
                                            Lokasi diluar Kota Rembang akan dikenakan biaya
                                            tambahan.</p>
                                    </div>

                                    <div class="col mb-3">
                                        <label for="location" class="form-label text-secondary">Detail Event
                                            Location</label>
                                        <textarea name="location" id="location" cols="30" rows="10" class="form-control"
                                            placeholder="Describe your detail location">{{ old('location') }}</textarea>
                                        @if ($errors->has('location'))
                                            <p class="text-danger mt-1 error-input">{{ $errors->first('location') }}
                                            </p>
                                        @endif
                                    </div>
                                    <div class="col mb-3">
                                        <label for="concept" class="form-label text-secondary">Concept for
                                            Photoshoot</label>
                                        <textarea name="concept" id="concept" cols="30" rows="10" class="form-control"
                                            placeholder="Tell us what concept will you use? Your idea">{{ old('concept') }}</textarea>

                                    </div>
                                    <div class="col mb-3">
                                        <label for="payment_type" class="form-label text-secondary">Payment
                                            Scheme</label>
                                        <select class="form-select" id="payment_type" name="payment_type"
                                            aria-label="Default select example">
                                            <option selected>-- Select Your Payment Scheme --</option>
                                            <option value="full">Full Payment</option>
                                            <option value="dp">DP</option>
                                        </select>
                                        @if ($errors->has('payment_type'))
                                            <p class="text-danger mt-1 error-input">{{ $errors->first('payment_type') }}
                                            </p>
                                        @endif
                                        <p id="additional_message2" class="text-danger mt-1" style="display: none;">* Untuk
                                            Pembayaran DP sebesar 10% dari harga package.</p>
                                    </div>
                                    <div class="text-center">
                                        <button style="height: 3rem;" type="submit"
                                            class="btn btn-success col-lg-6 btn-package">SUBMIT</button>
                                    </div>
                                </form>
                            @else
                                <div class="border border-danger rounded mb-5 text-center">
                                    <h3 class="my-2 "><b class="text-danger">Oops!</b><br><br>We're sorry you have
                                        to
                                        login first
                                        to
                                        make a photo session booking.</h3>
                                    <a href="/login" class="d-inline-block d-grid m-3 "><button
                                            class="btn btn-success">LOGIN</button></a>
                                </div>
                                <form action="" method="POST">
                                    @csrf
                                    <div class="col mb-3">
                                        <label for="tanggal" class="form-label text-secondary">Estimated Date</label>
                                        <input class="form-control is-invalid" type="date" name="tanggal"
                                            id="tanggal" disabled>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="packages" class="form-label text-secondary">Packages</label>
                                        <select class="form-select is-invalid" name="package_id" id="packages" disabled>
                                            <option selected>-- Select Packages --</option>
                                            @foreach ($packages as $pcg)
                                                <option value="{{ $pcg->id }}">{{ $pcg->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="location_type" class="form-label text-secondary">Event
                                            Location</label>
                                        <select class="form-select is-invalid" name="location_type" id="location_type"
                                            disabled>
                                            <option selected>-- Select Location --</option>
                                            <option value="rembang">Kabupaten Rembang</option>
                                            <option value="other">Luar Kota</option>
                                        </select>
                                        <p id="additional_message" class="text-danger mt-1" style="display: none;">*
                                            Untuk
                                            Lokasi diluar Kota Rembang akan dikenakan biaya
                                            tambahan.</p>
                                    </div>

                                    <div class="col mb-3">
                                        <label for="location" class="form-label text-secondary">Detail Event
                                            Location</label>
                                        <textarea name="location" id="location" cols="30" rows="10" class="form-control is-invalid" disabled></textarea>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="concept" class="form-label text-secondary">Concept for
                                            Photoshoot</label>
                                        <textarea name="concept" id="concept" cols="30" rows="10" class="form-control is-invalid"
                                            placeholder="Tell us what concept will you use? Your idea" disabled></textarea>
                                    </div>
                                    <div class="col mb-3">
                                        <label for="payment_type" class="form-label text-secondary">Payment
                                            Scheme</label>
                                        <select class="form-select is-invalid" name="payment_type" id="payment_type"
                                            disabled>
                                            <option value="">-- Select Payment Scheme --</option>
                                            <option value="dp">DP</option>
                                            <option value="full">Full Payment</option>
                                        </select>
                                        <p id="additional_message2" class="text-danger mt-1 " style="display: none;">*
                                            Untuk
                                            Pembayaran DP sebesar 10% dari harga package.</p>
                                    </div>
                                    <div class="text-center">
                                        <button style="height: 3rem;" type="submit"
                                            class="btn btn-success col-lg-6 btn-package" disabled>SUBMIT</button>
                                    </div>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var locationTypeSelect = document.getElementById('location_type');
            var paymentSchemeSelect = document.getElementById('payment_type');
            var additionalCostMessage = document.getElementById('additional_message');
            var additionalPaymentMessage2 = document.getElementById('additional_message2');

            locationTypeSelect.addEventListener('change', function() {
                if (locationTypeSelect.value === 'other') {
                    additionalCostMessage.style.display = 'block';

                } else {
                    additionalCostMessage.style.display = 'none';

                }
            });
            paymentSchemeSelect.addEventListener('change', function() {
                if (paymentSchemeSelect.value === 'dp') {
                    additionalPaymentMessage2.style.display = 'block';
                } else {
                    additionalPaymentMessage2.style.display = 'none';
                }
            });
        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var bookedDates = @json($bookedDates);
            var dateInput = document.getElementById('tanggal');
            var today = new Date().toISOString().split('T')[0];

            // Set the min date to today
            dateInput.setAttribute('min', today);

            // Function to check if a date is booked
            function isDateBooked(date) {
                return bookedDates.includes(date);
            }

            // Function to disable booked dates
            function disableBookedDates() {
                var datepicker = dateInput.cloneNode(true);
                dateInput.parentNode.replaceChild(datepicker, dateInput);
                dateInput = datepicker;

                // Disable booked dates
                var dates = dateInput.querySelectorAll('input[type="date"]');
                dates.forEach(function(input) {
                    if (isDateBooked(input.value)) {
                        input.disabled = true;
                    }
                });

                // Re-enable today's date
                dateInput.value = ''; // Set initial value to empty
                // dateInput.value = today;
                dateInput.disabled = false;
                dateInput.setAttribute('min', today);
            }

            // Initially disable booked dates
            disableBookedDates();

            // Event listener for date change
            dateInput.addEventListener('input', function() {
                var selectedDate = dateInput.value;
                if (isDateBooked(selectedDate)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'This date is already booked. Please choose another date.'
                    });
                    dateInput.value = ''; // Reset date input
                }
            });
        });
    </script>
@endsection
