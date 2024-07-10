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
                {{-- KONTEN HALAMAN ABOUT US --}}
                <div class="row g-3">
                    <div class="col-lg-12 card p-3">
                        <h2 class="text-primary">Halaman About Us</h2>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-lg-6">
                                    <div class="col">
                                        <h4>Crew</h4>
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" name="name" id="floatingInput"
                                                    placeholder="">
                                                <label for="floatingInput">Nama Crew</label>
                                            </div>
                                            <div class="mb-3">
                                                <label for="image">Foto</label>
                                                <input type="file" class="form-control" name="image" id="image"
                                                    placeholder="">
                                            </div>
                                            <div class=" mb-3">
                                                <label for="editor">Deskripsi</label>
                                                <textarea class="form-control" name="deskripsi" id="editorDeskripsi" cols="30" rows="10">{{ old('deskripsi') }}</textarea>

                                            </div>

                                            <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                        </form>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="table-responsive">
                                        @if ($crews->count() == 0)

                                            <div class="alert bg-danger-subtle">
                                                <h3 class="text-center text-danger">Oops!</h3>
                                                <p class="text-center">Maaf Data Crew Kosong</p>
                                            </div>
                                        @else
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Crew</th>
                                                        <th>Detail</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($crews as $crew)
                                                        <tr>
                                                            <td>{{ $loop->iteration }}</td>
                                                            <td>
                                                                <p>{{ $crew->name }}</p>
                                                            </td>
                                                            <td><button class="btn btn-success" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#modalAboutUs{{ $crew->id }}">Detail</button>
                                                            </td>
                                                            <td>
                                                                <div class="row g-2 d-flex justify-content-center">
                                                                    <div class="col d-grid">
                                                                        <button class="btn btn-warning "
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#editCrew{{ $crew->id }}"><i
                                                                                class="fa fa-solid fa-edit"></i>
                                                                            Edit</button>
                                                                    </div>
                                                                    <div class="col d-grid">
                                                                        <form
                                                                            action="/admin_panel/adminManageContents/{{ $crew->id }}"
                                                                            method="POST">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button class="btn btn-danger delete-button"><i
                                                                                    class="fa fa-solid fa-trash"></i>
                                                                                Delete</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <!-- Modal detail-->
                                                        <div class="modal fade" id="modalAboutUs{{ $crew->id }}"
                                                            tabindex="-1" aria-labelledby="modalAboutUsLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalAboutUsLabel">Crew
                                                                            Details</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        <div>
                                                                            <h5>Nama Crew</h5>
                                                                            <p>{{ $crew->name }}</p>
                                                                        </div>
                                                                        <div>
                                                                            <h5>Foto Crew</h5>
                                                                            <img src="/storage/admin_assets/dataCrew/{{ $crew->image }}"
                                                                                alt="" class="img-fluid"
                                                                                width="150" height="150">
                                                                        </div>
                                                                        <div class="card mt-3 p-2">
                                                                            <h5>Deskripsi Crew</h5>
                                                                            <p>{!! htmlspecialchars_decode($crew->deskripsi) !!}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Modal edit data crew-->
                                                        <div class="modal fade" id="editCrew{{ $crew->id }}"
                                                            tabindex="-1" aria-labelledby="modalAboutUsLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="modalAboutUsLabel">Crew
                                                                            Details
                                                                        </h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form
                                                                            action="/admin_panel/adminManageContents/edit-{{ $crew->id }}"
                                                                            method="POST" enctype="multipart/form-data">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="form-floating mb-3">
                                                                                <input type="text" class="form-control"
                                                                                    name="name" id="floatingInput"
                                                                                    value="{{ $crew->name }}" required>
                                                                                <label for="floatingInput">Nama
                                                                                    Crew</label>
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="">Foto saat ini</label>
                                                                                <br>
                                                                                <img src="/storage/admin_assets/dataCrew/{{ $crew->image }}"
                                                                                    alt="" class="img-fluid"
                                                                                    width="150" height="150">
                                                                            </div>
                                                                            <div class="mb-3">
                                                                                <label for="image">Foto</label>
                                                                                <input type="file" class="form-control"
                                                                                    name="image" id="image">
                                                                            </div>
                                                                            <div class=" mb-3">
                                                                                <label for="editor">Deskripsi</label>
                                                                                <textarea class="form-control" name="deskripsi" id="editorEditDeskripsi{{ $crew->id }}" cols="30"
                                                                                    rows="10">{!! htmlspecialchars_decode($crew->deskripsi) !!}</textarea>

                                                                            </div>

                                                                            <button type="submit"
                                                                                class="btn btn-primary float-end">Update</button>
                                                                        </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        @endif
                                        {{-- PAGINATION --}}

                                        <div class="mt-2">
                                            {{ $crews->withQueryString()->links() }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- HALAMAN TRANSACTION UNTUK BANK --}}

                    <div class="card col-lg-12 p-3">
                        <h2 class="text-primary">Halaman Transaction</h2>

                        <h4>Bank Account</h4>
                        <div class="row mt-2">
                            <div class="col-lg-4">
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
                                                                    <button class="btn btn-warning "
                                                                        data-bs-toggle="modal"
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
                                                                        <button
                                                                            class="btn btn-danger delete-button-bank"><i
                                                                                class="fa fa-solid fa-trash"></i>
                                                                            Delete</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!-- Modal edit data bank-->
                                                    <div class="modal fade" id="editBank{{ $bank->id }}"
                                                        tabindex="-1" aria-labelledby="modalAboutUsLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="modalAboutUsLabel">Bank
                                                                        Account
                                                                        Details
                                                                    </h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form
                                                                        action="/admin_panel/adminManageContents/edit/bank/{{ $crew->id }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="form-floating mb-3">
                                                                            <input type="text" class="form-control"
                                                                                name="name" id="name"
                                                                                placeholder=""
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
    <script>
        ClassicEditor
            .create(document.querySelector('#editorDeskripsi'), {
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|',
                        'heading',
                        '|',
                        'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|',
                        'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '|',
                        'link', 'blockQuote', 'codeBlock',
                        '|',
                        'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                    ],
                    shouldNotGroupWhenFull: true
                }
            })
            .catch(error => {
                console.error(error);
            });
        document.addEventListener('DOMContentLoaded', function() {
            @foreach ($crews as $crew)
                ClassicEditor
                    .create(document.querySelector('#editorEditDeskripsi{{ $crew->id }}'), {
                        toolbar: {
                            items: [
                                'undo', 'redo',
                                '|',
                                'heading',
                                '|',
                                'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                                '|',
                                'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                                '|',
                                'link', 'blockQuote', 'codeBlock',
                                '|',
                                'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                            ],
                            shouldNotGroupWhenFull: true
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            @endforeach
        });
        //
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: "Apakah Anda yakin ingin Menghapus Data Crew?",
                        text: "Anda Tidak Dapat Mengembalikan Data yang sudah dihapus",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Delete!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button-bank').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: "Apakah Anda yakin ingin Menghapus Data Akun Bank?",
                        text: "Anda Tidak Dapat Mengembalikan Data yang sudah dihapus",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Delete!"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            });
        });
    </script>
@endsection
