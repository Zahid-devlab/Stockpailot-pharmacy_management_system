<script setup>
import 'particles.js'

import { onMounted } from 'vue';

onMounted(() => {
    particlesJS.load('particles-js', '/particles.json', function () {
        console.log('callback - particles.js config loaded');
    });
});

</script>

=
<template>


    <div id="particles-js">

        <section class="home-bg-color">
            <!-- <div class="bg-overlay"></div> -->
            <div class="home-table" id="particles-js">
                <div class="home-table-center">
                    <div class="container z-1">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="text-white text-center">
                                    <h1 class="header_title mx-auto">Here is the best way to menage your business</h1>
                                    <p class="header_subtitle mx-auto pt-4 mb-0 pb-2 text-white">It is a long
                                        established fact that a reader will be distracted by the readable content layout
                                        readable English.</p>


                                    <div>
                                        <img src="home/images/home-desk.png" alt=""
                                            class="img-fluid mx-auto home-desk d-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>


<style scoped></style>
