<script setup>
import { Link, Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="StockPilot">
        <link rel="icon" type="image/x-icon" href="/dashboard/img/fav.png">
    </Head>

    <section class="bg-light">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-light ">
                <div class="container-fluid">
                    <Link class="navbar-brand text-success" href="/"><img src="/dashboard/img/logo.png" style="width: 200px; height: 50px" alt=""></Link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                </button>
                    <div class="collapse navbar-collapse mx-auto" id="navbarSupportedContent">
                        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                            <li class="nav-item">
                                <Link class="nav-link active" aria-current="page" href="/">Home</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/about">About</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/login">Login</Link>
                            </li>
                            <li class="nav-item">
                                <Link class="nav-link" href="/registration">Registration</Link>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Dropdown
                                            </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="#">Action</a></li>
                                    <li><a class="dropdown-item" href="#">Another action</a></li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li><a class="dropdown-item" href="#">Something else here</a></li>
                                </ul>
                            </li>
                        </ul>
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit">Search</button>
                        </form>
                    </div>
                </div>
            </nav>
        </div>
    </section>

    <div id="particles-js">
        <slot />
    </div>
</template>

<style scoped>

</style>
