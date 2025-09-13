<script setup>

</script>

<template>

    <section class="section bg-contact-color" id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-white text-center started-text">
                        <h1 class="mb-0">Want To Get Started</h1>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-12">
                    <div class="contact_form mx-auto">
                        <form>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group mt-2 mb-3">
                                        <input name="name" id="name" type="text" class="form-control"
                                            placeholder="Your name..." required="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mt-2 mb-3">
                                        <input name="email" id="email" type="email" class="form-control"
                                            placeholder="Your email..." required="">
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mt-2 mb-3">
                                        <input type="text" class="form-control" id="subject"
                                            placeholder="Your Subject.." required="" />
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="form-group mt-2 mb-3">
                                        <textarea name="comments" id="comments" rows="4" class="form-control"
                                            placeholder="Your message..." required=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 mt-2 text-center">
                                    <input type="submit" class="btn btn-custom w-50" value="Get The Demo">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="footer_divider mb-5 mt-5"></div>
            <div class="row mt-3">
                <div class="col-lg-4">
                    <h6 class="mt-3 text-white text-uppercase"><img style="width: 150px;" src="home/images/logo.png"
                            alt=""></h6>
                    <div class="mt-3">
                        <p class="about_oxcer">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                            dolore eu fugiat pariatur.</p>
                    </div>
                    <ul class="list-inline fot_social">
                        <li class="list-inline-item"><a href="#" class="social-icon text-muted"><i
                                    class="mdi mdi-facebook"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-icon text-muted"><i
                                    class="mdi mdi-twitter"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-icon text-muted"><i
                                    class="mdi mdi-linkedin"></i></a></li>
                        <li class="list-inline-item"><a href="#" class="social-icon text-muted"><i
                                    class="mdi mdi-google-plus"></i></a></li>
                    </ul>
                </div>
                <div class="col-lg-8">
                    <div class="col-lg-12 d-flex justify-content-between">
                        <div class="col-md-4">
                            <h6 class="mt-3 text-custom text-uppercase">Our Pages</h6>
                            <ul class="list-unstyled footer_menu_list mt-3">
                                <li><a href="#">Home</a></li>
                                <li><a href="#">Features</a></li>
                                <li><a href="#">About</a></li>
                                <li><a href="#">Client</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mt-3 text-custom text-uppercase">Support</h6>
                            <ul class="list-unstyled footer_menu_list mt-3">
                                <li><a href="#">Help Center</a></li>
                                <li><a href="#">Live Chat</a></li>
                                <li><a href="#">Downloads</a></li>
                                <li><a href="#">Press Kit</a></li>
                            </ul>
                        </div>
                        <div class="col-md-4">
                            <h6 class="mt-3 text-custom text-uppercase">Locations</h6>
                            <ul class="list-unstyled footer_menu_list mt-3">
                                <li><a href="#">Melbourne</a></li>
                                <li><a href="#">London</a></li>
                                <li><a href="#">New York</a></li>
                                <li><a href="#">Ontario</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pt-3">
                <div class="col-md-12">
                    <div class="text-center">
                        <p class="copy-rights mb-0">2025 &copy; StockPilot | All rights reserved.</p>
                    </div>
                </div>
                
            </div>
        </div>
    </section>

</template>

<style scoped>
.btn-custom {
    background-color: #8B5DFF;
    color: #fff;
    font-size: 15px;
    font-weight: 400;
    padding: 10px 20px;
}

.btn-custom:hover {
    background-color: #8B5DFF;
    color: #000000;
}
</style>
