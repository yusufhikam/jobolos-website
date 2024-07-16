@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Rekap Bulanan Photoshoot ' . $monthName . ' ' . $year)
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        {{-- <h1 class="m-0">Rekap Bulanan Photoshoot Jobolos Photography {{ $monthName }}
                            {{ $year }}</h1> --}}
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                            <li class="breadcrumb-item active">Rekap Bulanan Pemesanan Photoshoot</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <h1 class="mb-5 text-center">Rekap Pemesanan Photoshoot Bulan {{ $monthName }}
                            {{ $year }}
                        </h1>

                        <div class="col-lg-6 border rounded p-3 mb-4">
                            <form action="{{ url('/admin_panel/Rekap-Photoshoot') }}" method="GET" class="mb-4">
                                <div class="form-group">
                                    <label for="month">Month:</label>
                                    <select name="month" id="month" class="form-control">
                                        @foreach (range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ $m == $month ? 'selected' : '' }}>
                                                {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="year">Year:</label>
                                    <select name="year" id="year" class="form-control">
                                        @foreach (range(date('Y') - 5, date('Y')) as $y)
                                            <option value="{{ $y }}" {{ $y == $year ? 'selected' : '' }}>
                                                {{ $y }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary d-block mx-auto">Lihat Rekap</button>
                            </form>
                        </div>

                        @if ($booking->isEmpty())
                            <div class="alert alert-danger text-center" role="alert">
                                <h4 class="text-danger">Oops</h4>

                                <p>Tidak ada Data untuk bulan ini</p>
                            </div>
                        @else
                            <div class="table-responsive">
                                <table id="example1" class="table table-bordered">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Customer</th>
                                            <th>Tanggal</th>
                                            <th>Paket</th>
                                            <th>Lokasi</th>
                                            <th>Tipe Pembayaran</th>
                                            <th>Total Pembayaran</th>
                                            <th>Sisa Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($booking as $bookList)
                                            <tr>
                                                <td>
                                                    <div class="px-2 m-0">
                                                        <div class="row">
                                                            <p>{{ $bookList->users->name }}</p>
                                                        </div>
                                                        <div class="row">
                                                            <p>[{{ $bookList->users->no_telp }}]</p>
                                                        </div>
                                                        <div class="row">
                                                            <p>[{{ $bookList->users->email }}]</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-center">{{ $bookList->tanggal }}</p>
                                                </td>
                                                <td>
                                                    <p class="text-center">{{ $bookList->packages->name }}</p>
                                                </td>
                                                <td>
                                                    <div class="p-2">
                                                        <div class="row">
                                                            @if ($bookList->location_type == 'other')
                                                                <p class="text-center">Luar Kota</p>
                                                            @else
                                                                <p class="text-center">Kabupaten Rembang</p>
                                                            @endif
                                                        </div>
                                                        <div class="row">
                                                            <p class="text-center">{{ $bookList->location }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @if ($bookList->payment_type == 'dp')
                                                        <p class="text-center">DP</p>
                                                    @else
                                                        <p class="text-center">Lunas</p>
                                                    @endif
                                                </td>
                                                <td>
                                                    <p class="text-center">Rp
                                                        {{ number_format($bookList->total_harga, 0, ',', '.') }}</p>
                                                </td>
                                                <td>
                                                    @if ($bookList->sisa_harga != 0)
                                                        <p class="text-center">Rp
                                                            {{ number_format($bookList->sisa_harga, 0, ',', '.') }}</p>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    </div>



    {{-- footer --}}
    {{-- @include('layouts.admin_panel.footerLayout') --}}

@endsection
{{-- @section('scripts')
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection --}}
