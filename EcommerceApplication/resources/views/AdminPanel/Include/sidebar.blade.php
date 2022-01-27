{{-- Sidebar for navigating through pages and keeping track of where we currently are. --}}

<!-- Main Sidebar Container -->
@php
$sid = session('sid');
@endphp
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/dashboard" class="brand-link">
        <img src="dist/img/AdminLTELogo.png" alt="Admin Panel Logo" class="brand-image img-circle elevation-3"
            style="opacity: .8">
        <span class="brand-text font-weight-light">Admin Panel</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->

        {{-- Username will be shown here. --}}
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ $sid }}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                {{-- Link to dashboard. --}}
                <li class="nav-item {{ request()->is('dashboard*') ? 'active menu-open' : '' }}">
                    <a href="/dashboard" class="nav-link {{ request()->is('dashboard*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                            {{-- <span class="badge badge-info right">2</span> --}}
                        </p>
                    </a>
                </li>

                <li
                    class="nav-item {{ request()->is('addCMS*') || request()->is('showCMS*') ? 'active menu-open' : '' }}">

                    {{-- Manage CMS Indicator. --}}
                    <a href="#"
                        class="nav-link {{ request()->is('addCMS*') || request()->is('showCMS*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tv"></i>
                        <p>
                            Manage CMS
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('showCMS*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show CMS. --}}
                            <a href="/showCMS" class="nav-link {{ request()->is('showCMS*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show CMS</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('addCMS*') ? 'active menu-open' : '' }}">

                            {{-- Link to add CMS. --}}
                            <a href="/addCMS" class="nav-link {{ request()->is('addCMS*') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add CMS</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->is('addUser*') || request()->is('showUsers*') ? 'active menu-open' : '' }}">

                    {{-- Manage Users Indicator. --}}
                    <a href="#"
                        class="nav-link {{ request()->is('addUser*') || request()->is('showUsers*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user"></i>
                        <p>
                            Manage Users
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('showUsers*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show Users. --}}
                            <a href="/showUsers" class="nav-link {{ request()->is('showUsers*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Users</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('addUser*') ? 'active menu-open' : '' }}">

                            {{-- Link to add User. --}}
                            <a href="/addUser" class="nav-link {{ request()->is('addUser*') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add User</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->is('addCoupon*') || request()->is('showCoupons*') ? 'active menu-open' : '' }}">

                    {{-- Manage Coupons Indicator. --}}
                    <a href="#"
                        class="nav-link {{ request()->is('addCoupon*') || request()->is('showCoupons*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            Manage Coupons
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('showCoupons*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show Coupons. --}}
                            <a href="/showCoupons"
                                class="nav-link {{ request()->is('showCoupons*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Coupons</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('addCoupon*') ? 'active menu-open' : '' }}">

                            {{-- Link to add Coupon. --}}
                            <a href="/addCoupon" class="nav-link {{ request()->is('addCoupon*') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Coupon</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->is('addCategory*') || request()->is('showCategories*') ? 'active menu-open' : '' }}">

                    {{-- Manage Categories Indicator. --}}
                    <a href="#"
                        class="nav-link {{ request()->is('addCategory*') || request()->is('showCategories*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-server"></i>
                        <p>
                            Manage Categories
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('showCategories*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show Categories. --}}
                            <a href="/showCategories"
                                class="nav-link {{ request()->is('showCategories*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Categories</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('addCategory*') ? 'active menu-open' : '' }}">

                            {{-- Link to add Category. --}}
                            <a href="/addCategory"
                                class="nav-link {{ request()->is('addCategory*') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->is('addProduct*') || request()->is('showProducts*') ? 'active menu-open' : '' }}">

                    {{-- Manage Products Indicator. --}}
                    <a href="#"
                        class="nav-link {{ request()->is('addProduct*') || request()->is('showProducts*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-gamepad"></i>
                        <p>
                            Manage Products
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('showProducts*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show Products. --}}
                            <a href="/showProducts"
                                class="nav-link {{ request()->is('showProducts*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Products</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('addProduct*') ? 'active menu-open' : '' }}">

                            {{-- Link to add Product. --}}
                            <a href="/addProduct"
                                class="nav-link {{ request()->is('addProduct*') ? 'active' : '' }}">
                                <i class="fas fa-plus nav-icon"></i>
                                <p>Add Product</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li
                    class="nav-item {{ request()->is('showConstants*') || request()->is('showOrders*') || request()->is('showContactUs*') ? 'active menu-open' : '' }}">

                    {{-- Manage Constants Indicator. --}}
                    <a href="#"
                        class="nav-link {{ request()->is('showConstants*') || request()->is('showOrders*') || request()->is('showContactUs*') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-exclamation-circle"></i>
                        <p>
                            Manage Notifications
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item {{ request()->is('showConstants*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show Constants. --}}
                            <a href="/showConstants"
                                class="nav-link {{ request()->is('showConstants*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Constants</p>
                            </a>
                        </li>
                        <li class="nav-item {{ request()->is('showOrders*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show Orders. --}}
                            <a href="/showOrders"
                                class="nav-link {{ request()->is('showOrders*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Orders</p>
                            </a>
                        </li>

                        <li class="nav-item {{ request()->is('showContactUs*') ? 'active menu-open' : '' }}">

                            {{-- Link to Show Contac tUs. --}}
                            <a href="/showContactUs"
                                class="nav-link {{ request()->is('showContactUs*') ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Show Contact Us</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item">
                    {{-- <hr style="color: white;"> --}}

                    {{-- Link to logout. --}}
                    <a href="#" class="nav-link" data-toggle="modal" data-target="#modal-logout">
                        <i class="nav-icon fas fa-sign-out-alt"></i>
                        <p>
                            Logout
                        </p>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>


{{-- Modal for logout confirmation. --}}
<div class="modal fade" id="modal-logout">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content bg-danger">
            <div class="modal-header">
                <h5 class="modal-title">Confirmation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="fas fa-times"></i></span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure ? You'll be logged out of the session and unsaved changes will be deleted too!</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-success btn-light" data-dismiss="modal">Close</button>
                <a href="/logout" class="btn btn-outline-dark btn-light">Logout</a>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
