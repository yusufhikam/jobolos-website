@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Kategori List')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Kelola Kategori Foto</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item"><a href="/admin_panel/adminManageGallery">Kelola Galeri Foto</a></li>
                        <li class="breadcrumb-item active">Kelola Kategori Foto</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    <div class=" col-auto mb-2">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#exampleModal">
                            <i class="fa-solid fa-plus"></i> Tambah Kategori </button>
                    </div>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr class="table-primary text-center">
                                <th>No</th>
                                <th>Nama Kategori</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kategori as $ktg)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td>{{ $ktg->name }}</td>
                                    <td>
                                        <div class="row g-2 justify-content-center">

                                            <div class="col-auto">
                                                <a href="/admin_panel/admin-edit-category/{{ $ktg->id }}"><button
                                                        class="btn btn-warning"><i class="fa-regular fa-edit"></i>
                                                        Edit</button></a>
                                            </div>
                                            <div class="col-auto">

                                                {{-- <a href="/admin_panel/admin-destroy-user/{{ $ktg->id }}"
                                                class="btn btn-danger" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a> --}}


                                                <form action="/admin_panel/admin-destroy-category/{{ $ktg->id }}"
                                                    method="POST" class="delete-form">
                                                    @csrf
                                                    @method('DELETE')

                                                    <a href="/admin_panel/admin-destroy-category/{{ $ktg->id }}"><button
                                                            type="submit" class="btn btn-danger delete-button"><i
                                                                class="fa-solid fa-trash"></i>
                                                            Delete</button></a>

                                                    {{-- <a href="/admin_panel/admin-destroy-category/{{ $ktg->id }}"><button
                                                        type="submit" class="btn btn-danger " data-confirm-delete="true"><i
                                                            class="fa-solid fa-trash"></i>
                                                        Delete</button></a> --}}
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- PAGINATION --}}

                    <div class="mt-2">
                        {{ $kategori->withQueryString()->links() }}
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Formulir Tambah Kategori Foto</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="POST">
                                @csrf
                                <div class="col-auto">
                                    <div class="mb-3">
                                        <label class="form-label" for="name">Nama Kategori</label>
                                        <input type="text" class="form-control" name="name" id="name"
                                            value="{{ old('name') }}" required autocomplete="off">
                                    </div>
                                    <div class="float-end mt-3">
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                            </form>
                        </div>
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
