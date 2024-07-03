@php
    use Carbon\Carbon;
@endphp

@extends('layouts.frontend.frontendLayouts')
@section('title', 'Rental Camera Booking')
@section('content')


    <div class="content-container " style="margin-top:6rem; border: 2px solid red;">
        <h1 class="text-center mt-5 mb-3">Hello, {{ ucwords(Auth::user()->name) }}!</h1>

        <h4 class="m-auto text-center mb-3 col-lg-6">Thank you for using our services. See you at the photo shoot.
        </h4>
        <hr class="text-center m-auto text-success w-75 border-3">
        <section class="content mb-4">
            <div class="container-fluid mt-5">
                <div class="d-flex justify-content-center">
                    <div class="card col-lg-7">
                        <div class="d-flex justify-content-between">
                            <a href="/jobolos/rental-transactions" class="my-4 me-3 btn btn-warning"><i
                                    class="fa fa-solid fa-circle-arrow-left"></i> Back</a>
                            <h5 class="my-4 ms-3">Your History Bookings</h5>
                        </div>
                        {{-- @foreach ($transaction as $bookList)
                            @if ($transaction->payments->status !== 'approved')
                                <h2 class="m-auto text-center mb-3 text-danger col-lg-6">We're Sorry :(</h2>
                                <h4 class="m-auto text-center mb-3 col-lg-7">Your transactions are empty.<br>You have
                                    not
                                    booked
                                    yet,
                                    please book
                                    first.</h4>
                            @endforeach --}}
                        <div class="timeline booking-timeline">

                            <!-- timeline time label -->
                            @foreach ($transaction as $bookList)
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
                                                    PC-{{ str_pad($bookList->id, 4, '0', STR_PAD_LEFT) }}-{{ $codeBooking }}
                                                </p>
                                                @if ($bookList->status == 'pending')
                                                    <p>Status Pembayaran : <span
                                                            class="bg-warning rounded p-1 d-inline-block"><i
                                                                class="fa-solid fa-hand-holding-dollar"></i> Waiting for
                                                            payment...</span></p>
                                                @else
                                                    @php
                                                        $payment = $bookList->rentalPayments->last();
                                                    @endphp
                                                    @if ($payment)
                                                        @if ($payment->status_pembayaran == 'pending')
                                                            <p>Status Pembayaran : <span class=" rounded p-1 d-inline-block"
                                                                    style="background-color: #00a5cf; color:aliceblue;"><i
                                                                        class="fa fa-regular fa-clock"></i> Waiting for
                                                                    Confirmation</span></p>
                                                        @elseif($payment->status_pembayaran == 'approved')
                                                            <p>Status Pembayaran : <span
                                                                    class="bg-primary rounded p-1 d-inline-block">
                                                                    <i class="fa-regular fa-circle-check"></i> PAID
                                                                </span>
                                                            </p>
                                                        @elseif ($payment->status == 'rejected')
                                                            <p>Status Pembayaran : <span
                                                                    class="bg-danger rounded p-1 d-inline-block">
                                                                    <i class="fa-solid fa-circle-exclamation"></i>
                                                                    Rejected</span></p>
                                                        @endif
                                                    @endif
                                                @endif
                                            </div>

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

                                                    <div class="col">
                                                        <div class="row">
                                                            <label class="fw-bold">Event Location :
                                                            </label>
                                                            <div class="col mx-3 mb-3 bg-body-tertiary border rounded p-3">
                                                                <div class="row">
                                                                    {{-- @if ($bookList->location_type == 'other')
                                                                        <p>Location : Luar Kota</p>
                                                                    @else
                                                                        <p>Location :
                                                                            {{ ucwords($bookList->location_type) }}
                                                                        </p>
                                                                    @endif --}}
                                                                    <hr class="w-25 ms-2 float-start border-2">
                                                                </div>
                                                                <div class="row">
                                                                    <p>Detail Location :</p>
                                                                    {{-- <p>{{ ucwords($bookList->location) }}</p> --}}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-5 float-end  my-3 border border-2  rounded">
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

                                                                <div class="d-flex justify-content-between">
                                                                    <p>Additional Costs</p>
                                                                    {{-- @if ($bookList->location_type == 'other')
                                                                        <p>Rp 250.000</p>
                                                                    @else
                                                                        <p>-</p>
                                                                    @endif --}}

                                                                </div>


                                                                <hr class="border-3 m-0 p-0">

                                                                <div class="d-flex mt-1 justify-content-between">
                                                                    {{-- @if ($bookList->payment_type == 'dp')
                                                                        <p class="fw-bold text-primary">Total Price
                                                                            DP
                                                                        </p>
                                                                    @else
                                                                        <p class="fw-bold">Total Price
                                                                        </p>
                                                                    @endif --}}
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
                                                    <a href="" class="btn btn-primary d-block disabled"
                                                        style="font-size: 10pt;"><i class="fa-solid fa-file-invoice"></i>
                                                        DOWNLOAD INVOICE</a>
                                                </div>
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
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="container-fluid">
                                                            <form
                                                                action="{{ route('frontend.transactions.payment', $bookList->id) }}"
                                                                method="POST" enctype="multipart/form-data">
                                                                @csrf
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
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
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
    </div>
@endsection
