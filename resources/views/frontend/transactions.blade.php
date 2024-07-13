@php
    use Carbon\Carbon;
@endphp

@extends('layouts.frontend.frontendLayouts')
@section('title', 'Photoshoot Booking')
@section('content')


    <div class="content-container " style="margin-top:17rem; ">
        <h1 class="text-center mt-5 mb-3">Hello, {{ ucwords(Auth::user()->name) }}!</h1>
        @if ($transaction->isEmpty())
            <section class="content mb-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-center">
                        <div class="card col-lg-7 ">
                            <div class="d-flex justify-content-between">
                                <h5 class="my-4 ms-3">Here is Your Bookings</h5>
                                @if (Auth::user()->bookings->count() > 0)
                                    <a href="/jobolos/transactions/history-booking"
                                        class="my-4 me-3 btn btn-historybook">Booking History</a>
                                @endif
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
            <section class="content">
                <div class="container-fluid">
                    @foreach ($bankAccounts as $bank)
                        <div class="d-flex row">
                            <h3 class="mt-5 mx-auto text-center bg-success rounded-pill p-3 col-auto">
                                ({{ $bank->bank_name }})
                                {{ $bank->no_rek }}</h3>
                            <h4 class="mb-5 text-center">A.N / {{ $bank->name }}</h4>
                        </div>
                    @endforeach
                    <div class="d-flex justify-content-center">
                        <div class="card col-lg-7">
                            <div class="d-flex justify-content-between">
                                <h5 class="my-4 ms-3">Your Bookings</h5>

                                <a href="/jobolos/transactions/history-booking"
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
                                                        PS-{{ str_pad($bookList->id, 4, '0', STR_PAD_LEFT) }}-{{ $codeBooking }}
                                                    </p>

                                                    @if ($bookList->status_pembayaran == 'pending')
                                                        <p>Status Pembayaran : <span
                                                                class="bg-warning rounded p-1 d-inline-block"><i
                                                                    class="fa-solid fa-hand-holding-dollar"></i> Waiting for
                                                                payment...</span></p>
                                                    @else
                                                        @foreach ($bookList->payments as $payments)
                                                            @if ($payments->status == 'pending')
                                                                <p>Status Pembayaran : <span
                                                                        class=" rounded p-1 d-inline-block"
                                                                        style="background-color: #00a5cf; color:aliceblue;"><i
                                                                            class="fa fa-regular fa-clock"></i> Waiting for
                                                                        Confirmation</span></p>
                                                            @elseif($payments->status == 'approved')
                                                                <p>Status Pembayaran : <span
                                                                        class="bg-primary rounded p-1 d-inline-block">
                                                                        <i class="fa-regular fa-circle-check"></i>
                                                                        Paid</span>
                                                                </p>
                                                            @elseif ($payments->status == 'rejected')
                                                                <p>Status Pembayaran : <span
                                                                        class="bg-danger rounded p-1 d-inline-block">
                                                                        <i class="fa-solid fa-circle-exclamation"></i>
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

                                                @if ($bookList->status_pembayaran == 'completed')
                                                    <div class="alert alert-primary d-flex align-items-center justify-content-center mt-3"
                                                        role="alert">
                                                        <div>
                                                            <h5><i class="fa-solid fa-circle-check"
                                                                    style="color: #008009;"></i> Please check your email.
                                                                Once confirmed by admin INVOICE will be sent to your email.
                                                            </h5>
                                                        </div>
                                                    </div>
                                                @endif
                                                <div class="d-flex my-2">
                                                    <div class="m-2 col-lg-12">

                                                        @foreach ($bookList->payments as $ket)
                                                            @if ($ket->status == 'rejected')
                                                                <div class="text-center bg-danger-subtle mb-2 p-2">
                                                                    <h5 class="text-danger">We're Sorry,</h5>
                                                                    <p class="text-danger">Your Payment Proof is Not Valid.
                                                                        Please Reupload your payment proof.</p>
                                                                </div>
                                                            @endif
                                                        @endforeach
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
                                                                    <label class="fw-bold">Estimated Date :
                                                                    </label><br>
                                                                    <p class="bg-success rounded d-inline-flex p-2">
                                                                        {{ Carbon::parse($bookList->tanggal)->format('j F Y') }}
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="row">
                                                                <div class="col">
                                                                    <label class="fw-bold">Package :
                                                                    </label>
                                                                    <p> {{ $bookList->packages->name }}</p>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <div class="col">
                                                            <div class="row">
                                                                <label class="fw-bold">Event Location :
                                                                </label>
                                                                <div class="col mx-3 mb-3 bg-body-tertiary border rounded">
                                                                    <div class="row">
                                                                        @if ($bookList->location_type == 'other')
                                                                            <p>Location : Luar Kota</p>
                                                                        @else
                                                                            <p>Location :
                                                                                {{ ucwords($bookList->location_type) }}
                                                                            </p>
                                                                        @endif
                                                                        <hr class="w-25 ms-2 float-start border-2">
                                                                    </div>
                                                                    <div class="row">
                                                                        <p>Detail Location :</p>
                                                                        <p>{{ ucwords($bookList->location) }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <label class="fw-bold">Concept :
                                                                </label>
                                                                <div class="col mx-3 mb-3 bg-body-tertiary border rounded">

                                                                    <p>{{ ucwords($bookList->concept) }}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        @foreach ($bookList->payments as $payments)
                                                            @if ($payments->status == 'pending' || $payments->status == 'rejected')
                                                                <button type="button" class="btn btn-primary"
                                                                    data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                    <i class="fa-solid fa-receipt"></i> View Your Receipt
                                                                </button>

                                                                <!-- Modal -->
                                                                <div class="modal fade" id="exampleModal" tabindex="-1"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog modal-dialog-centered">
                                                                        <div class="modal-content">
                                                                            <img src="/storage/admin_assets/buktiPembayaran/bukti_pembayaran_photoshoot/{{ $payments->bukti_pembayaran }}"
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
                                                                        @if ($bookList->payment_type == 'dp')
                                                                            <p
                                                                                class="bg-warning rounded p-1 d-inline-block">
                                                                                DP</p>
                                                                        @else
                                                                            <p
                                                                                class="bg-primary rounded p-1 d-inline-block">
                                                                                Full Payment</p>
                                                                        @endif

                                                                    </div>
                                                                    <hr class="border-3 m-0 p-0">

                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Package Price</p>

                                                                        <p>Rp
                                                                            {{ number_format($bookList->packages->harga, 0, ',', '.') }}
                                                                        </p>
                                                                    </div>

                                                                    <hr class="border-3 m-0 p-0">

                                                                    <div class="d-flex justify-content-between">
                                                                        <p>Additional Costs</p>
                                                                        @if ($bookList->location_type == 'other')
                                                                            <p>Rp 250.000</p>
                                                                        @else
                                                                            <p>-</p>
                                                                        @endif

                                                                    </div>


                                                                    <hr class="border-3 m-0 p-0">

                                                                    <div class="d-flex mt-1 justify-content-between">
                                                                        @if ($bookList->payment_type == 'dp')
                                                                            <p class="fw-bold text-primary">Total Payment
                                                                                DP
                                                                            </p>
                                                                        @else
                                                                            <p class="fw-bold">Total Payment
                                                                            </p>
                                                                        @endif

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
                                                            $hasPendingPayment = $bookList->payments->contains(
                                                                'status',
                                                                'pending',
                                                            );

                                                        @endphp

                                                        {{-- @foreach ($bookList->payments as $payments) --}}
                                                        @if ($bookList->payments->isNotEmpty() && $bookList->payments->first()->status == 'rejected')
                                                            <a type="button" class="btn btn-primary d-block"
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#staticBackdrop{{ $bookList->id }}"
                                                                style="font-size: 10pt;"><i
                                                                    class="fa-solid fa-receipt"></i> Update
                                                                Payment Receipt</a>
                                                        @elseif ($bookList->payments->isEmpty() || !$hasPendingPayment)
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
                                                    @foreach ($bookList->payments as $payments)
                                                        <div class="col-lg-3">
                                                            @if ($payments->status == 'approved')
                                                                <a type="button" class="btn btn-success d-block"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop2{{ $bookList->id }}"
                                                                    style="font-size: 10pt;" disabled>Re-Schedule Date</a>
                                                            @else
                                                                <a type="button" class="btn btn-success d-block"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdrop2{{ $bookList->id }}"
                                                                    style="font-size: 10pt;">Re-Schedule Date</a>
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                    @if ($bookList->status_pembayaran == 'pending')
                                                        <div class="col-lg-3">
                                                            <form
                                                                action="/jobolos/transactions/cancel/{{ $bookList->id }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')

                                                                <button type="submit"
                                                                    class="btn btn-danger cancel-button"
                                                                    style="font-size: 10pt;">Cancel</button>
                                                            </form>
                                                            {{-- <a href="" class="btn btn-danger d-block"
                                                                style="font-size: 10pt;">Cancel</a> --}}
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
                                                                    action="{{ route('frontend.transactions.payment', $bookList->id) }}"
                                                                    method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    @foreach ($bookList->payments as $payments)
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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.cancel-button').forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                const form = this.closest('form');
                Swal.fire({
                    title: "Cancel Booking",
                    text: "Are you sure you want to cancel your photoshoot booking?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#507558",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "YES!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>
