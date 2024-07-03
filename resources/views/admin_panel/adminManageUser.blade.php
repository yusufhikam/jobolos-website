@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | User List')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Users List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active">Users List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    <div class=" col-auto mb-2">
                        <a href="/admin_panel/admin-add-user">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah User</button>
                        </a>
                    </div>

                    @if (Session::has('status'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <div class=" col-auto mb-2">
                        <form class="d-flex" action="" method="get" role="search">
                            <input type="search" class="form-control me-2" name="keyword" placeholder="Search Data"
                                value="{{ request()->input('keyword') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>

                </div>


                <div class="table-responsive">
                    @if ($user->isEmpty())
                        <div class=" alert alert-danger text-center " role="alert">
                            <h2>Oops!</h2>
                            <p>Untuk saat ini data user dengan kata kunci <b>'{{ request()->input('keyword') }}'</b> tidak
                                ada.
                            </p>
                        </div>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-primary text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $pengguna)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pengguna->name }}</td>
                                        <td>{{ $pengguna->email }}</td>
                                        <td>{{ $pengguna->nama_role->name }}</td>
                                        <td>
                                            <div class="col-auto text-center">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop{{ $pengguna->id }}">
                                                    <i class="fa-regular fa-eye"></i> Detail
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row g-2 justify-content-center">

                                                <div class="col-auto">
                                                    <a href="/admin_panel/admin-edit-user/{{ $pengguna->id }}"><button
                                                            class="btn btn-warning"><i class="fa-regular fa-edit"></i>
                                                            Edit</button></a>
                                                </div>
                                                <div class="col-auto">

                                                    {{-- <a href="/admin_panel/admin-destroy-user/{{ $pengguna->id }}"
                                                class="btn btn-danger" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a> --}}


                                                    <form action="/admin_panel/admin-destroy-user/{{ $pengguna->id }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')

                                                        <a href="/admin_panel/admin-destroy-user/{{ $pengguna->id }}"><button
                                                                type="submit" class="btn btn-danger delete-button"><i
                                                                    class="fa-solid fa-trash"></i>
                                                                Delete</button></a>
                                                    </form>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal detail user-->
                                    <div class="modal fade" id="staticBackdrop{{ $pengguna->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel{{ $pengguna->id }}" aria-hidden="true">
                                        <div class="modal-dialog  modal-lg  modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header bg-primary">
                                                    <h1 class="modal-title fs-5 m-auto"
                                                        id="staticBackdropLabel{{ $pengguna->id }}">
                                                        Detail User</h1>
                                                </div>
                                                <div class="modal-body text-center">

                                                    <div class="col">

                                                        <div class="row-auto my-2">
                                                            @if ($pengguna->image != null)
                                                                <img class="img-fluid rounded"
                                                                    src="{{ asset('storage/admin_assets/images_users/' . $pengguna->image) }}"
                                                                    alt="foto_user" width="200px">
                                                            @else
                                                                <img class="img-fluid rounded"
                                                                    src="{{ asset('storage/users/images/pp.png') }}"
                                                                    alt="foto_user" width="200px">
                                                            @endif
                                                        </div>
                                                        <hr>
                                                        <div class="row-auto">
                                                            <h5>Nama Lengkap : </h5>
                                                            <p>{{ $pengguna->name }}</p>
                                                        </div>
                                                        <div class="row-auto">
                                                            <h5>Nomor WhatsApp : </h5>
                                                            <p>{{ $pengguna->no_telp }}</p>
                                                        </div>
                                                        <div class="row-auto">
                                                            <h5>Email : </h5>
                                                            <p>{{ $pengguna->email }}</p>
                                                        </div>

                                                        <div class="row-auto">
                                                            <h5>Roles : </h5>
                                                            <p>{{ $pengguna->nama_role->name }}</p>
                                                        </div>
                                                        <div class="row-auto">
                                                            <h5>Alamat : </h5>
                                                            <p>{{ $pengguna->alamat }}</p>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger"
                                                        data-bs-dismiss="modal">Close</button>
                                                    {{-- <button type="button" class="btn btn-primary">Understood</button> --}}
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
                        {{ $user->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: "Apakah Anda yakin ingin Menghapus Data User?",
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
