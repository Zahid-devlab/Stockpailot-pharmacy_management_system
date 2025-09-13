<script setup>
import { Link } from '@inertiajs/vue3';
import { Head } from '@inertiajs/vue3';
import { ref } from 'vue';
import { usePage } from '@inertiajs/vue3';
const sidebar = ref(false);

const page = usePage();
</script>

<template>
<Head title="StockPilot | Admin" >
    <link rel="icon" type="image/x-icon" href="/dashboard/img/fav.png">
</Head>
<div class="container-xxl position-relative bg-white d-flex p-0">



        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3" :class="sidebar ? 'open' : ''" >
            <nav class="navbar bg-light navbar-light">
                <Link href="#" class="navbar-brand mx-4">
                    <h3 class="u-text-primary ">StockPilot</h3>
                </Link>
                <hr class="w-100 bg-primary m-0">
                <div class="navbar-nav w-100" >
                    <Link href="/user-dashboard" class="nav-item nav-link " :class="$page.url == '/user-dashboard' ? 'active' : ''"><i class="fa-solid fa-house u-text-primary me-2"></i>Dashboard </Link>

                    <Link href="/category" class="nav-item nav-link" :class="$page.url == '/category' ? 'active' : ''"><i class="fa-solid fa-bars me-2 u-text-primary"></i>Categories</Link>

                    <Link href="/products" class="nav-item nav-link" :class="$page.url == '/products' ? 'active' : ''"><i class="fa fa-th me-2 u-text-primary"></i>Products</Link>

                    <Link href="/customers" class="nav-item nav-link" :class="$page.url == '/customers' ? 'active' : ''"><i class="fa-solid fa-people-group me-2 u-text-primary"></i>Customers</Link>

                    <Link href="/sale" class="nav-item nav-link" :class="$page.url == '/sale' ? 'active' : ''"><i class="fa-solid fa-cart-plus me-2 u-text-primary"></i>Create Sale</Link>

                    <Link href="/invoice" class="nav-item nav-link" :class="$page.url == '/invoice' ? 'active' : ''"><i class="fa fa-chart-bar me-2 u-text-primary"></i>Invoice</Link>

                    <Link href="/report" class="nav-item nav-link"  :class="$page.url == '/report' ? 'active' : ''"><i class="fa-solid fa-chart-line me-2 u-text-primary"></i>Reports</Link>

                    <div class="nav-item dropdown">
                        <Link href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown"><i class="fa-solid fa-layer-group me-2 u-text-primary"></i>Settings</Link>
                        <div class="dropdown-menu bg-transparent border-0 mx-4">
                            <Link href="button.html" class="dropdown-item u-text-primary">All </Link>
                            <Link href="typography.html" class="dropdown-item u-text-primary">New</Link>

                        </div>
                    </div>


                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content" :class="sidebar ? 'open' : ''" >
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0 ">

                <Link href="#"  class="navbar-brand d-flex d-lg-none me-4" >
                    <h2 class="u-text-primary mb-0"><img src="/dashboard/img/fav.png" style="width: 50px; height: 40px;" alt=""></h2>
                </Link>

                <button class="sidebar-toggler flex-shrink-0 text-success" @click="sidebar = !sidebar" style="border-color: #7367f0;">
                    <i class="fa fa-bars u-text-primary"></i>
                </button>

                <!-- <form class="d-none d-md-flex ms-4">
                    <input class="form-control border-0" type="search" placeholder="Search">
                </form> -->
                <div class="navbar-nav align-items-center ms-auto">

                    <!-- <div class="nav-item dropdown">
                        <Link href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-envelope me-lg-2 u-text-primary"></i>
                            <span class="d-none d-lg-inline-flex">Message</span>
                        </Link>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <Link href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="/dashboard/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </Link>
                            <hr class="dropdown-divider">
                            <Link href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="/dashboard/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </Link>
                            <hr class="dropdown-divider">
                            <Link href="#" class="dropdown-item">
                                <div class="d-flex align-items-center">
                                    <img class="rounded-circle" src="/dashboard/img/user.jpg" alt="" style="width: 40px; height: 40px;">
                                    <div class="ms-2">
                                        <h6 class="fw-normal mb-0">Jhon send you a message</h6>
                                        <small>15 minutes ago</small>
                                    </div>
                                </div>
                            </Link>
                            <hr class="dropdown-divider">
                            <Link href="#" class="dropdown-item text-center">See all message</Link>
                        </div>
                    </div> -->

                    <div class="nav-item dropdown">
                        <Link href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2 u-text-primary"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </Link>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <Link href="#" class="dropdown-item">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </Link>
                            <hr class="dropdown-divider">
                            <Link href="#" class="dropdown-item text-center">See all notifications</Link>
                        </div>
                    </div>


                    <div class="nav-item dropdown">
                        <Link href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2" :src="page.props.user.img || '/dashboard/img/user.png'" alt="" style="width: 40px; height: 40px;">
                            <span class="d-none d-lg-inline-flex">{{ page.props.user.first_name }} {{ page.props.user.last_name }}</span>
                        </Link>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <Link href="/user-profile" class="dropdown-item">My Profile</Link>
                            <Link href="#" class="dropdown-item">Settings</Link>
                            <Link href="/user-logout" class="dropdown-item">Log Out</Link>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->







            <slot />


            <div>

        
        
        </div>

        </div>
        <!-- Content End -->

        



    </div>


</template>

<style scoped>
.u-text-primary{
    color: #7367f0 !important;
}
.back-to-top-btn{
    color: #ffffff !important;
    background-color: #8B5DFF;
}
.back-to-top-btn:hover{
    background-color: black !important;
}

@media screen and (max-width: 978px) {
    .sidebar .navbar .navbar-nav .nav-link {
  padding-top: 15px !important;
}
    
}
</style>
