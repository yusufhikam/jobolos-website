@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Admin | Photoshoot Packages')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Kelola Photoshoot Packages</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item active">Photoshoot Packages List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container-fluid">
                <div class="row my-3 ms-2 me-2 justify-content-between ">
                    <div class=" col-auto mb-2">
                        <a href="/admin_panel/admin-add-package">
                            <button class="btn btn-primary"><i class="fa-solid fa-plus"></i> Tambah Paket
                                Photoshoot</button>
                        </a>
                    </div>

                    @if (Session::has('status'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('message') }}
                        </div>
                    @endif

                    <div class=" col-auto mb-2">
                        <form class="d-flex" action="" method="get" role="search">
                            <input type="search" class="form-control me-2" name="keyword" autocomplete="off"
                                placeholder="Search Data" value="{{ request()->input('keyword') }}">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>

                </div>


                <div class="table-responsive">
                    @if ($package->isEmpty())
                        <div class=" alert alert-danger text-center " role="alert">
                            <h2>Oops!</h2>
                            <p>Untuk saat ini paket photoshoot <b>'{{ request()->input('keyword') }}'</b> tidak ada.</p>
                        </div>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr class="table-primary text-center">
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Harga</th>
                                    <th>Detail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($package as $pcg)
                                    <tr>
                                        <td class="text-center">{{ $loop->iteration }}</td>
                                        <td>{{ $pcg->name }}</td>
                                        <td>Rp {{ number_format($pcg->harga, 0, ',', '.') }}</td>
                                        <td>
                                            <div class="col-auto text-center">
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdrop{{ $pcg->id }}">
                                                    <i class="fa-regular fa-eye"></i> Detail
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="row g-2 justify-content-center">

                                                <div class="col-auto">
                                                    <a href="/admin_panel/admin-edit-package/{{ $pcg->id }}"><button
                                                            class="btn btn-warning"><i class="fa-regular fa-edit"></i>
                                                            Edit</button></a>
                                                </div>
                                                <div class="col-auto">

                                                    {{-- <a href="/admin_panel/admin-destroy-user/{{ $pcg->id }}"
                                                class="btn btn-danger" data-confirm-delete="true">
                                                <i class="fa-solid fa-trash"></i> Delete
                                            </a> --}}


                                                    <form action="/admin_panel/admin-destroy-package/{{ $pcg->id }}"
                                                        method="POST" class="delete-form">
                                                        @csrf
                                                        @method('DELETE')

                                                        <a href="/admin_panel/admin-destroy-package/{{ $pcg->id }}"><button
                                                                type="submit" class="btn btn-danger delete-button"><i
                                                                    class="fa-solid fa-trash"></i>
                                                                Delete</button></a>
                                                    </form>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <!-- Modal detail packages-->
                                    <div class="modal fade" id="staticBackdrop{{ $pcg->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel{{ $pcg->id }}" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header ">
                                                    <h1 class="modal-title fs-5 m-auto"
                                                        id="staticBackdropLabel{{ $pcg->id }}">
                                                        Photoshoot Packages Detail</h1>
                                                </div>
                                                <div class="modal-body text-center">

                                                    <div class="col">

                                                        <div class="row-auto my-2">
                                                            @if ($pcg->image != null)
                                                                <img class="img-fluid rounded"
                                                                    src="{{ asset('storage/admin_assets/package/' . $pcg->image) }}"
                                                                    alt="package_thumbnail" width="200px">
                                                            @else
                                                                <img class="img-fluid rounded"
                                                                    src="{{ asset('storage/admin_assets/package/package.png') }}"
                                                                    alt="package_thumbnail" width="200px">

                                                                <p class="text-danger mt-2">Belum Ada Data Thumbnail</p>
                                                            @endif
                                                        </div>
                                                        <hr>
                                                        <div class="row-auto">
                                                            <h5>Nama Paket : </h5>
                                                            <p>{{ $pcg->name }}</p>
                                                        </div>
                                                        <div class="row-auto">
                                                            <h5>Harga Paket : </h5>
                                                            <p>Rp {{ number_format($pcg->harga, 0, ',', '.') }}</p>
                                                        </div>
                                                        <div class="row-auto">
                                                            <h5>Deskripsi Paket : </h5>
                                                            <div class="card bg-secondary-subtle text-start p-2">
                                                                <p>{!! htmlspecialchars_decode($pcg->deskripsi) !!}</p>
                                                            </div>
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
                        {{ $package->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
    @include('sweetalert::alert')
@endsection
@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.delete-button').forEach(function(button) {
                button.addEventListener('click', function(event) {
                    event.preventDefault();
                    const form = this.closest('form');
                    Swal.fire({
                        title: "Apakah Anda yakin ingin Menghapus Data Package?",
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
