@php
    use Carbon\Carbon;
@endphp

@extends('layouts.frontend.frontendLayouts')
@section('title', 'Rental Camera Booking')
@section('content')


    <div class="content-container " style="margin-block:7rem;">
        <h1 class="text-center mt-5 mb-3">Hello, {{ ucwords(Auth::user()->name) }}!</h1>
        @if ($transaction->isEmpty())
            <section class="content mb-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card col-lg-7 ">
                            <div class="d-flex justify-content-between">
                                <h5 class="my-4 ms-3">Here is Your Bookings</h5>

                            </div>
                            <h2 class="m-auto text-center mb-3 text-danger col-lg-6">We're Sorry :(</h2>
                            <h4 class="m-auto text-center mb-3 col-lg-7">Your transactions are empty.<br>You have not booked
                                yet,
                                please book
                                first.</h4>

                            <a href="/jobolos/contact" class="btn btn-success my-4 fw-bolder col-lg-4 mx-auto">BOOK
                                NOW!</a>
                        </div>
                    </div>
                </div>
            </section>
        @else
            <h4 class="m-auto text-center mb-3 col-lg-6">Thank you for booking a photo session. <br>Please make payment by
                <b class="text-danger">Bank
                    Transfer</b> with the account number below.
            </h4>
            <hr class="text-center m-auto text-success w-75 border-3">
            <section class="content mb-4">
                <div class="container-fluid">
                    @foreach ($bankRentalAccounts as $bank)
                        <div class="d-flex row">
                            <h3 class="mt-5 mx-auto text-center bg-success rounded-pill p-3 col-auto">
                                ({{ $bank->bank_name }})
                                {{ $bank->no_rek }}</h3>
                            <h4 class="mb-5 text-center">A.N / {{ $bank->name }}</h4>
                        </div>
                    @endForeach
                    <div class="d-flex justify-content-center">
                        <div class="card col-lg-7">
                            <div class="d-flex justify-content-between">
                                <h5 class="my-4 ms-3">Your Bookings</h5>

                                <a href="/jobolos/transactions/history-rental-booking"
                                    class="my-4 me-3 btn btn-historybook">Booking History</a>

                            </div>
                            <div class="timeline booking-timeline">
                                <!-- timeline time label -->
                                @foreach ($transaction as $bookList)
                                    <div class="d-flex justify-content-between">

                                    </div>
                                    <div class="time-label">
                                        <span
                                            class="bg-red">{{ Carbon::parse($bookList->created_at)->format('l, d M. Y') }}</span>
                                    </div>
                                    <!-- timeline item -->
                                    <div>
                                        <i class="fas fa-bell bg-blue"></i>
                                        <div class="timeline-item">

                                            <h3 class="timeline-header">Detail Booking
                                            </h3>

                                            <div class="timeline-body">
                                                <div class="d-flex justify-content-between ">
                                                    <p>BOOKING CODE :
                                                        RC-{{ str_pad($bookList->id, 4, '0', STR_PAD_LEFT) }}-{{ $codeBooking }}
                                                    </p>

                                                    @if ($bookList->status == 'pending')
                                                        <p>Status Pembayaran : <span
                                                                class="bg-warning rounded p-1 d-inline-block"><i
                                                                    class="fa-solid fa-hand-holding-dollar"></i> Waiting for
                                                                payment...</span></p>
                                                        {{-- @foreach ($bookList->rentalPayments as $payments) --}}
                                                    @elseif ($bookList->status == 'waiting')
                                                        <p>Status Pembayaran : <span class=" rounded p-1 d-inline-block"
                                                                style="background-color: #00a5cf; color:aliceblue;"><i
                                                                    class="fa fa-regular fa-clock"></i> Waiting for
                                                                Confirmation</span></p>
                                                    @elseif($bookList->status == 'active')
                                                        <p>Status Pembayaran : <span
                                                                class="bg-primary rounded p-1 d-inline-block">
                                                                <i class="fa-regular fa-circle-check"></i>
                                                                ACTIVE RENT</span>
                                                        </p>
                                                    @else
                                                        @foreach ($bookList->rentalPayments as $payments)
                                                            @if ($payments->status_pembayaran == 'rejected')
                                                                <p>Status Pembayaran : <span
                                                                        class="bg-danger rounded p-1 d-inline-block"><i
                                                                            class="fa-solid fa-circle-exclamation"></i>
                                                                        Rejected</span></p>
                                                            @endif
                                                        @endforeach
                                                    @endif
                                                </div>

                                                {{-- @if ($bookList->payments->status == 'rejected')
                                                    <p class="text-danger text-center">The receipt of your payment is
                                                        invalid, please
                                                        re-upload
                                                        it. </p>
                                                @endif --}}

                                                <div class="d-flex my-2">
                                                    <div class="m-2 col-lg-12">
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="fw-bold">Name :
                                                                    </label>
                                                                    <p> {{ ucwords(Auth::user()->name) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="fw-bold">Camera Type :
                                                                    </label>
                                                                    <p>{{ $bookList->cameras->camera_types->brands->name }}
                                                                        {{ $bookList->cameras->name }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="fw-bold">Lens Type :
                                                                    </label>
                                                                    <p>Focal Length <b>{{ $bookList->lenses->name }}</b>
                                                                        (Lensa
                                                                        {{ $bookList->cameras->camera_types->name }})
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="fw-bold">Rent Date :
                                                                    </label><br>
                                                                    <p class="bg-success rounded d-inline-flex p-2">
                                                                        {{ Carbon::parse($bookList->tgl_sewa)->format('j F Y') }}
                                                                    </p>
                                                                </div>
                                                                <div class="col">
                                                                    <label class="fw-bold">Return Date :
                                                                    </label><br>
                                                                    <p class="bg-success rounded d-inline-flex p-2">
                                                                        {{ Carbon::parse($bookList->tgl_kembali)->format('j F Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="fw-bold">Guarantee :
                                                                    </label>
                                                                    <br>
                                                                    <p class="bg-primary rounded d-inline-block p-2">
                                                                        {{ $bookList->jaminan }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($bookList->rentalPayments as $payments)
                                                            @if ($payments->status_pembayaran == 'pending' || $payments->status_pembayaran == 'rejected')
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                    <i class="fa-solid fa-receipt"></i> View Your Receipt
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <img src="/storage/admin_assets/buktiPembayaran/bukti_pembayaran_rental_camera/{{ $payments->bukti_pembayaran }}"
                                                                                alt="receipt photo" class="img-fluid">

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach
                                                        <div
                                                            class="col-lg-5 bg-payment float-end  my-3 border border-2  rounded">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="fw-bold">Payment :
                                                                    </label>

                                                                    <div class="d-flex justify-content-between ">
                                                                        <p>Payment Scheme</p>
                                                                        <p class="bg-warning rounded p-1 d-inline-block">
                                                                            Bank Transfer</p>

                                                                    </div>
                                                                    <hr class="border-3 m-0 p-0">

                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Camera Rate per Day</p>

                                                                        <p>Rp
                                                                            {{ number_format($bookList->cameras->harga_per_hari, 0, ',', '.') }}
                                                                        </p>
                                                                    </div>
                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Lens Rate per Day</p>

                                                                        <p>Rp
                                                                            {{ number_format($bookList->lenses->harga_per_hari, 0, ',', '.') }}
                                                                        </p>
                                                                    </div>

                                                                    <hr class="border-3 m-0 p-0">
                                                                    <hr class="border-3 m-0 p-0">

                                                                    <div class="d-flex mt-1 justify-content-between">
                                                                        <p class="fw-bold">Total Payment
                                                                        </p>
                                                                        <p class="bg-danger p-1 rounded">Rp
                                                                            {{ number_format($bookList->total_harga, 0, ',', '.') }}
                                                                        </p>

                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="p-3">
                                                <div class="row g-2 justify-content-center">
                                                    <div class="col-lg-3">

                                                        @php
                                                            $modalTarget = '#staticBackdrop' . $bookList->id;
                                                            $hasPendingPayment = $bookList->rentalPayments->contains(
                                                                'status_pembayaran',
                                                                'pending',
                                                            );
                                                            $hasApprovedPayment = $bookList->rentalPayments->contains(
                                                                'status_pembayaran',
                                                                'approved',
                                                            );
                                                        @endphp

                                                        {{-- @foreach ($bookList->payments as $payments) --}}
                                                        @if ($bookList->rentalPayments->isNotEmpty() && $bookList->rentalPayments->first()->status == 'rejected')
                                                            <a type="button" class="btn btn-primary d-block"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop{{ $bookList->id }}"
                                                                style="font-size: 10pt;"><i
                                                                    class="fa-solid fa-receipt"></i> Update
                                                                Bukti Pembayaran</a>
                                                        @elseif ($bookList->rentalPayments->isEmpty() || (!$hasPendingPayment && !$hasApprovedPayment))
                                                            <a type="button" class="btn btn-primary d-block"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="{{ $modalTarget }}"
                                                                style="font-size: 10pt;">
                                                                <i class="fa-solid fa-receipt"></i> Upload Receipt
                                                            </a>
                                                        @else
                                                            <a type="button" class="btn btn-primary d-block disabled"
                                                                style="font-size: 10pt;">
                                                                <i class="fa-solid fa-receipt"></i> Upload Receipt
                                                            </a>
                                                        @endif
                                                        {{-- @endforeach --}}
                                                    </div>
                                                    @if ($hasPendingPayment || $bookList->$hasApprovedPayment)
                                                        <div class="col-lg-3">
                                                            <a href="" class="btn btn-danger d-block disabled"
                                                                style="font-size: 10pt;">Cancel</a>
                                                        </div>
                                                    @else
                                                        <div class="col-lg-3">
                                                            <a href="" class="btn btn-danger d-block"
                                                                style="font-size: 10pt;">Cancel</a>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>

                                            <!-- Modal Upload Bukti Pembayaran-->
                                            <div class="modal fade" id="staticBackdrop{{ $bookList->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Upload
                                                                your payment
                                                                receipt here
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">

                                                                <form
                                                                    action="{{ route('frontend.rental-transactions.payment', $bookList->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @foreach ($bookList->rentalPayments as $payments)
                                                                        @if ($payments->status == 'rejected')
                                                                            @method('PUT')
                                                                        @endif
                                                                    @endforeach

                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="inputGroupFile01">Upload
                                                                            File</label>
                                                                        <input type="file" name="bukti_pembayaran"
                                                                            class="form-control" id="inputGroupFile01"
                                                                            required>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-success">Upload</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- modal Re Schedule tanggal --}}
                                            <div class="modal fade" id="staticBackdrop2{{ $bookList->id }}"
                                                data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Update
                                                                your event
                                                                date here
                                                            </h1>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <form
                                                                    action="{{ route('frontend.transactions.updateDate', $bookList->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="mb-3">
                                                                        <label class="form-label"
                                                                            for="inputGroupFile01">Estimated
                                                                            Date</label>
                                                                        <input type="date" name="tanggal"
                                                                            class="form-control" id="inputGroupFile01"
                                                                            value="{{ $bookList->tanggal }}" required>

                                                                    </div>

                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-success">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </div>
@endsection
