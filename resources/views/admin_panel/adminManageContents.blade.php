@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Manage Contents')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Contents Management</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active">Contents Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container">
                {{-- halaman home slider --}}
                <div class="row g-3">
                    <div class="col-lg-4 card p-3 text-center">
                        <h2 class="text-primary">Halaman Home</h2>
                        <div class="card-body">
                            <div class="row">
                                <i class="fa-solid fa-house fa-4x mb-4 contents-icon"></i>
                                <a href="{{ route('admin_panel.contentHome') }}" class="btn btn-primary contents-btn">Manage
                                    Contents</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 card p-3 text-center">
                        <h2 class="text-primary">Halaman About Us</h2>
                        <div class="card-body">
                            <div class="row">
                                <i class="fa-solid fa-users fa-4x mb-4 contents-icon"></i>
                                <a href="{{ route('admin_panel.contentAbout') }}"
                                    class="btn btn-primary contents-btn">Manage
                                    Contents</a>
                            </div>
                        </div>
                    </div>

                    {{-- HALAMAN TRANSACTION UNTUK BANK --}}

                    <div class="card col-lg-12 p-3">
                        <h2 class="text-primary">Halaman Transaction</h2>

                        <h4>Bank Account</h4>
                        <div class="row mt-2 p-3">
                            <div class="col-lg-4 border rounded p-3">
                                <form action="{{ route('admin_panel.adminManageContents.Bank') }}" method="POST">
                                    @csrf
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="name" id="name"
                                            placeholder="">
                                        <label for="name">Nama Pemilik Bank <b class="text-danger">(sesuai
                                                KTP)</b></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="bank_name" id="bank_name"
                                            placeholder="BRI,BCA,BNI,BANK JATENG">
                                        <label for="bank_name">Nama Bank</label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="no_rek" id="no_rek"
                                            placeholder="">
                                        <label for="no_rek">Nomor Rekening</label>
                                    </div>
                                    <button type="submit" class="btn btn-primary col-lg-4 float-end">Simpan</button>
                                </form>
                            </div>
                            <div class="col-lg-8">
                                <div class="table-responsive">
                                    @if ($akunBank->count() == 0)
                                        <div class="alert bg-danger-subtle">
                                            <h3 class="text-center text-danger">Oops!</h3>
                                            <p class="text-center">Maaf Data Bank Kosong, Harap Segera tambahkan untuk
                                                memberi informasi kepada customer Terkait Transfer Bank</p>
                                        </div>
                                    @else
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Nama Lengkap</th>
                                                    <th>Nama Bank</th>
                                                    <th>Nomor Rekening</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($akunBank as $bank)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>
                                                            <p>
                                                                {{ $bank->name }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $bank->bank_name }}</p>
                                                        </td>
                                                        <td>
                                                            <p>{{ $bank->no_rek }}</p>
                                                        </td>
                                                        <td>
                                                            <div class="row g-2 d-flex m-auto">
                                                                <div class="col d-grid">
                                                                    <button class="btn btn-warning " data-bs-toggle="modal"
                                                                        data-bs-target="#editBank{{ $bank->id }}"><i
                                                                            class="fa fa-solid fa-edit"></i>
                                                                        Edit</button>
                                                                </div>
                                                                <div class="col d-grid">
                                                                    <form
                                                                        action="/admin_panel/adminManageContents/delete/bank-{{ $bank->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button class="btn btn-danger delete-button-bank"><i
                                                                                class="fa fa-solid fa-trash"></i>
                                                                            Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal edit data bank-->
                                                    <div class="modal fade" id="editBank{{ $bank->id }}" tabindex="-1"
                                                        aria-labelledby="modalAboutUsLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalAboutUsLabel">Bank
                                                                        Account
                                                                        Details
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="/admin_panel/adminManageContents/edit/bank/{{ $bank->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name" placeholder=""
                                                                                value="{{ $bank->name }}">
                                                                            <label for="name">Nama Pemilik Bank <b
                                                                                    class="text-danger">(sesuai
                                                                                    KTP)</b></label>
                                                                        </div>
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="bank_name" id="bank_name"
                                                                                placeholder="BRI,BCA,BNI,BANK JATENG"
                                                                                value="{{ $bank->bank_name }}">
                                                                            <label for="bank_name">Nama Bank</label>
                                                                        </div>
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="no_rek" id="no_rek"
                                                                                placeholder=""
                                                                                value="{{ $bank->no_rek }}">
                                                                            <label for="no_rek">Nomor Rekening</label>
                                                                        </div>

                                                                        <button type="submit"
                                                                            class="btn btn-primary float-end">Update</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        {{-- PAGINATION --}}

                                        <div class="mt-2">
                                            {{ $akunBank->withQueryString()->links() }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')

@endsection
@section('scripts')

@endsection
