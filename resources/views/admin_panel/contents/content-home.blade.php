@extends('layouts.admin_panel.adminLayouts')

@section('title', 'Home Contents Management')
@section('content')

    <div class="content-wrapper">
        {{-- breadcrumb --}}

        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-2">Halaman Home</h1>
                    <hr>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right m-2">
                        <li class="breadcrumb-item "><a href="/admin_panel/adminDashboard">Admin Dashboard</a></li>
                        <li class="breadcrumb-item "><a href="/admin_panel/adminManageContents">Manage Contents</a></li>
                        <li class="breadcrumb-item active">Home Contents Management</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <div class="row mb-2">
                <div class="col-4">
                    <a href="/admin_panel/adminManageContents" class="btn btn-warning"><i
                            class="fa fa-solid fa-circle-left"></i>
                        Kembali</a>
                </div>
            </div>

        </div><!-- /.container-fluid -->


        <section class="content">
            <div class="container">
                {{-- halaman home slider --}}
                {{-- <div class="row g-3"> --}}
                <div class="col-lg-12 card p-3">
                    <h2 class="text-primary border p-3 text-center">Slider</h2>
                    <div class="card-body">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary ms-2" data-bs-toggle="modal"
                            data-bs-target="#exampleModal"><i class="fa fa-plus"></i>
                            Tambah Data
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Foto Slider</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('admin_panel.sliderStore') }}" method="POST"
                                            enctype="multipart/form-data">
                                            @csrf

                                            <div class="mb-3">
                                                <label for="imageSlider">Foto Slider</label>
                                                <input type="file" class="form-control" name="image" id="imageSlider"
                                                    placeholder="">
                                            </div>
                                            <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12 my-4">
                            <div class="table-responsive">
                                @if ($sliders->isEmpty())
                                    <div class="alert bg-danger-subtle" role="alert">
                                        <h4 class="text-center text-danger">Oops!</h4>
                                        <p class="text-center ">Tidak ada data</p>
                                    </div>
                                @else
                                    <table class="table table-bordered text-center">
                                        <thead class="table-primary">
                                            <tr>
                                                <th>No</th>
                                                <th>Foto Slider</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sliders as $slider)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <img src="/storage/admin_assets/sliders/{{ $slider->image }}"
                                                            alt="" class="img-fluid" width="100" height="75">
                                                        {{-- {{ $slider->image }} --}}
                                                    </td>
                                                    <td>
                                                        <form action="{{ route('admin_panel.sliderDestroy', $slider->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger"><i
                                                                    class="fa fa-solid fa-trash"></i>
                                                                Delete</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{-- PAGINATION --}}

                                    <div class="mt-2">
                                        {{ $sliders->withQueryString()->links() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                {{-- </div> --}}
            </div>
        </section>
    </div>

@endsection
@section('scripts')
    @include('sweetalert::alert')
    {{-- <script>
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
    </script> --}}
@endsection
