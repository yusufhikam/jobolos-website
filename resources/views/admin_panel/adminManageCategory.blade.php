@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Kategori List')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Kategori List</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item active">Kategori List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    <div class=" col-auto mb-2">
                        <a href="/admin_panel/admin-add-category">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Kategori</button>
                        </a>
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
