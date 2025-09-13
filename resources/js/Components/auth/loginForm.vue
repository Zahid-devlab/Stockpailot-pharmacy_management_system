<script setup>
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import Notify from 'simple-notify'
import 'simple-notify/dist/simple-notify.css'

const page = usePage();
const form = useForm({
    'email': '',
    'password': '',
})

const submitForm = () => {

    if(form.email == ''){
        new Notify ({
            status: 'error',
            title: 'Email is required',
        })
    }else if(form.password == ''){
        new Notify ({
            status: 'error',
            title: 'Password is required',
        })
    }else {
        form.post('/user-login', {
            onSuccess: () => {

                if(page.props.flash.error){
                        new Notify ({
                        status: 'error',
                        title: page.props.flash.error.message,
                        autotimeout: 2000,
                    })

                    form.password = '';

                }else if(page.props.flash.success){
                    new Notify ({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })

                    form.reset();
                }


            },
            onError: () => {
                new Notify ({
                    status: 'error',
                    title: 'Login failed',
                    autotimeout: 2000,
                })
            }
        });
    }


}

</script>

<template>

    <section class="mx-auto mt-5">
        <div class="form-bg">
            <div class="container">
                <div class="row ">
                    <div class="col-md-4 col-md-offset-4 mx-auto">
                        <div class="form-container">
                            <div class="form-icon"><i class="fa fa-user"></i></div>
                            <h3 class="title">Login</h3>
                            <form class="form-horizontal" @submit.prevent="submitForm">
                                <div class="form-group">
                                    <label>email</label>
                                    <input v-model="form.email" class="form-control" type="email" placeholder="email address">
                                </div>
                                <div class="form-group">
                                    <label>password</label>
                                    <input v-model="form.password" class="form-control" type="password" placeholder="password">
                                </div>
                                <button type="submit" class="btn btn-default" :disabled="form.processing">Login</button>

                                <p class="text-center mt-3">Don't have an account? <Link class="text-primary fw-bold form-link" href="/registration">Registration</Link></p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


</template>

<style scoped>
.form-link{
    text-decoration: none;
    color: #8B5DFF !important;
}
.form-container {
    background: #ecf0f3;
    font-family: 'Nunito', sans-serif;
    padding: 20px 40px;
    border-radius: 20px;
    box-shadow: 10px 10px 15px #cbced1, -10px -10px 15px white;
}

.form-container .form-icon {
    color: #8B5DFF;
    font-size: 40px;
    text-align: center;
    line-height: 100px;
    width: 100px;
    height: 100px;
    margin: 0 auto 10px;
    border-radius: 50px;
    box-shadow: 7px 7px 10px #cbced1, -7px -7px 10px #fff;
}

.form-container .title {
    color: #8B5DFF;
    font-size: 25px;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1px;
    text-align: center;
    margin: 0 0 10px;
}

.form-container .form-horizontal .form-group {
    margin: 0 0 20px 0;
}

.form-container .form-horizontal .form-group label {
    font-size: 15px;
    font-weight: 600;
    text-transform: uppercase;
}

.form-container .form-horizontal .form-control {
    color: #333;
    background: #ecf0f3;
    font-size: 15px;
    height: 50px;
    padding: 20px;
    letter-spacing: 1px;
    border: none;
    border-radius: 50px;
    box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px #fff;
    display: inline-block;
    transition: all 0.3s ease 0s;
}

.form-container .form-horizontal .form-control:focus {
    box-shadow: inset 6px 6px 6px #cbced1, inset -6px -6px 6px #fff;
    outline: none;
}

.form-container .form-horizontal .form-control::placeholder {
    color: #808080;
    font-size: 14px;
}

.form-container .form-horizontal .btn {
    color: #ffffff;
    background-color: #8B5DFF;
    font-size: 15px;
    font-weight: bold;
    text-transform: uppercase;
    width: 100%;
    padding: 12px 15px 11px;
    border-radius: 20px;
    box-shadow: 6px 6px 6px #cbced1, -6px -6px 6px #fff;
    border: none;
    transition: all 0.5s ease 0s;
}

.form-container .form-horizontal .btn:hover,
.form-container .form-horizontal .btn:focus {
    color: #fff;
    letter-spacing: 3px;
    box-shadow: none;
    outline: none;
}
</style>
