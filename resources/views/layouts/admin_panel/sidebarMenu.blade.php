@php
    $unReadNotifications = Auth::user()->unreadNotifications;
    $markAsReadNotifications = Auth::user()->marksAsread;
@endphp

<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            @if (Auth::user()->image != null)
                <img class="img-circle elevation-2"
                    src="{{ asset('storage/admin_assets/images_users/' . Auth::user()->image) }}" alt="foto_user"
                    width="200px">
            @else
                <img src="{{ asset('storage/users/images/pp.png') }}" alt="foto_user" class="img-circle elevation-2">
            @endif
            {{-- <img src="{{ asset('/') }}dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image"> --}}
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ ucwords(Auth::user()->name) }}</a>
        </div>
    </div>
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            {{-- BUSINESS CONTENTS MANAGEMENT --}}

            <li class="nav-item menu-open">
                <a href="#"
                    class="nav-link {{ Route::is([
                        'admin_panel.adminDashboard',
                        'admin_panel.adminManageUser',
                        'admin_panel.admin-add-user',
                        'admin_panel.adminManageContents',
                        'admin_panel.adminPhotoshootRekap',
                        'admin_panel.adminRentalRekap',
                    ])
                        ? 'active'
                        : '' }}">
                    <i class="nav-icon fas fa-laptop-file"></i>
                    <p>
                        Manajemen Bisnis
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin_panel/adminDashboard"
                            class="nav-link {{ Route::is('admin_panel.adminDashboard') ? 'active' : '' }}">
                            <i class="fa-solid fa-home nav-icon"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageUser"
                            class="nav-link {{ Route::is(['admin_panel.adminManageUser', 'admin_panel.admin-add-user']) ? 'active' : '' }}">
                            <i class="fa-solid fa-users nav-icon"></i>
                            <p>Manage Users</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageContents"
                            class="nav-link {{ Route::is('admin_panel.adminManageContents') ? 'active' : '' }}">
                            <i class="fa fa-solid fa-pen-to-square nav-icon"></i>
                            <p>Manage Contents</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/Rekap-Photoshoot"
                            class="nav-link {{ Route::is('admin_panel.adminPhotoshootRekap') ? 'active' : '' }}">
                            <i class="fa-solid fa-book"></i>
                            <p>Rekap Photoshoot</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/Rekap-Rental"
                            class="nav-link {{ Route::is('admin_panel.adminRentalRekap') ? 'active' : '' }}">
                            <i class="fa-solid fa-book"></i>
                            <p>Rekap Rental Kamera</p>
                        </a>
                    </li>
                </ul>
            </li>

            {{-- DASHBOARD PEMOTRETAN --}}
            <li class="nav-item menu-open">
                <a href="#"
                    class="nav-link {{ Route::is([
                        'admin_panel.adminManageCategory',
                        'admin_panel.adminManageGallery',
                        'admin_panel.admin-add-photo',
                        'admin_panel.adminManagePackage',
                        'admin_panel.adminManageBookingReceived',
                        'admin_panel.adminManageBookingConfirmation',
                        'admin_panel.adminManageBookingConfirmation.detail',
                    ])
                        ? 'active'
                        : '' }}">
                    <i class="nav-icon fas fa-book"></i>
                    <p>
                        Pemotretan
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">


                    <li class="nav-item">
                        <a href="/admin_panel/adminManageCategory"
                            class="nav-link {{ Route::is(['admin_panel.adminManageCategory', 'admin_panel.admin-add-category']) ? 'active' : '' }}">
                            <i class="fa-solid fa-table-cells nav-icon"></i>
                            <p>Category</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageGallery"
                            class="nav-link {{ Route::is(['admin_panel.adminManageGallery']) ? 'active' : '' }}">
                            <i class="far fa-images nav-icon"></i>
                            <p>Gallery</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManagePackage"
                            class="nav-link {{ Route::is(['admin_panel.adminManagePackage']) ? 'active' : '' }}">
                            <i class="fa fa-solid fa-camera-retro nav-icon"></i>
                            <p>Photoshoot Packages</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageBookingReceived"
                            class="nav-link {{ Route::is(['admin_panel.adminManageBookingReceived']) ? 'active' : '' }}">
                            <i class="fa-regular fa-calendar-check nav-icon"></i>
                            <p>Booking Received</p>
                            @if ($bookingReceived)
                                <span class="position-absolute top-0 end-0  badge  bg-danger">
                                    {{ $bookingReceived }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageBookingConfirmation"
                            class="nav-link {{ Route::is(['admin_panel.adminManageBookingConfirmation', 'admin_panel.adminManageBookingConfirmation.detail']) ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-plus nav-icon"></i>
                            <p>Booking Confirmation</p>
                            @if ($paymentConfirm)
                                <span class="position-absolute top-0 end-0  badge  bg-danger">
                                    {{ $paymentConfirm }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </li>

            {{-- DASHBOARD RENTAL KAMERA  --}}
            <li class="nav-item menu-open">
                <a href="#"
                    class="nav-link {{ Route::is([
                        'admin_panel.adminManageCamera',
                        'admin_panel.adminManageBrands',
                        'admin_panel.adminManageLens',
                        'admin_panel.adminManageBookingReceivedRental',
                        'admin_panel.adminManageBookingConfirmationRental',
                    ])
                        ? 'active'
                        : '' }}">
                    <i class="nav-icon fas fa-camera"></i>
                    <p>
                        Penyewaan Kamera
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageBrands"
                            class="nav-link {{ Route::is('admin_panel.adminManageBrands') ? 'active' : '' }}">
                            <i class="fa fa-solid fa-dice-d6 nav-icon"></i>
                            <p>Brands</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageCamera"
                            class="nav-link {{ Route::is('admin_panel.adminManageCamera') ? 'active' : '' }}">
                            <i class="fa fa-solid fa-camera nav-icon"></i>
                            <p>Cameras</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageLens"
                            class="nav-link {{ Route::is('admin_panel.adminManageLens') ? 'active' : '' }}">
                            <i class="fa fa-brands fa-edge nav-icon"></i>
                            <p>Lensa</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageBookingReceivedRental"
                            class="nav-link {{ Route::is(['admin_panel.adminManageBookingReceivedRental']) ? 'active' : '' }}">
                            <i class="fa-regular fa-calendar-check nav-icon"></i>
                            <p>Booking Received</p>
                            @if ($cameraBookingReceived)
                                <span class="position-absolute top-0 end-0  badge  bg-danger">
                                    {{ $cameraBookingReceived }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </a>

                    </li>
                    <li class="nav-item">
                        <a href="/admin_panel/adminManageBookingConfirmationRental"
                            class="nav-link {{ Route::is(['admin_panel.adminManageBookingConfirmationRental']) ? 'active' : '' }}">
                            <i class="fa-solid fa-cart-plus nav-icon"></i>
                            <p>Booking Confirmation</p>
                            @if ($cameraPaymentConfirm)
                                <span class="position-absolute top-0 end-0  badge  bg-danger">
                                    {{ $cameraPaymentConfirm }}
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            @endif
                        </a>
                    </li>
                </ul>
            </li>
        </ul>
    </nav>
</div>

<div class="sidebar-custom p-3">
    <a href="/logout" class="btn btn-danger">Log Out</a>
    {{-- <a href="#" class="btn btn-secondary hide-on-collapse pos-right">Help</a> --}}
</div>
