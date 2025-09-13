<script setup>
import { Link } from '@inertiajs/vue3';
import { router } from '@inertiajs/vue3';
</script>

<template>

<nav class="navbar navbar-expand-lg fixed-top custom-nav sticky">
        <div class="container">
            <!-- LOGO -->
            <a class='logo navbar-brand' href="#">
                <img src="home/images/logo.png" alt="" class="img-fluid logo-light">
                <img src="home/images/logo-dark.png" alt="" class="img-fluid logo-dark">
            </a>
            <button class="navbar-toggler mt-0" style="border: 2px solid #8B5DFF; color: #8B5DFF;" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="mdi mdi-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav mx-auto navbar-center" id="main_nav">
                    <li class="nav-item">
                        <a href="#home" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="#about" class="nav-link">About</a>
                    </li>
                    <li class="nav-item">
                        <a href="#features" class="nav-link">Features</a>
                    </li>
                    <li class="nav-item">
                        <a href="#screenshot" class="nav-link">Screenshot</a>
                    </li>
                    <li class="nav-item">
                        <a href="#client" class="nav-link">Client</a>
                    </li>
                    <li class="nav-item">
                        <a href="#price" class="nav-link">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a href="#contact" class="nav-link">Contact</a>
                    </li>
                </ul>

                <div class="nav-right mt-3 mt-lg-0">
                    <Link class="nav-link btn btn-custom" type="button" href="/login">Sign In</Link>
                </div>
            </div>
        </div>
    </nav>


</template>

<style scoped>
.btn-custom{
    background-color: #8B5DFF;
    color: #fff;
    font-size: 15px;
    font-weight: 400;
    padding: 10px 20px;


}
.btn-custom:hover{
    background-color: #8B5DFF;
    color: #000000;
}
</style>
