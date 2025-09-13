<script setup>
import { Link } from '@inertiajs/vue3'
import { useForm } from '@inertiajs/vue3'
import { usePage } from '@inertiajs/vue3'
import Notify from 'simple-notify'
import 'simple-notify/dist/simple-notify.css'

const page = usePage();
const form = useForm({
    'first_name': '',
    'last_name': '',
    'mobile': '',
    'email': '',
    'password': '',
    'password_confirmation': '',
})

const submitForm = () => {

    if(form.first_name == ''){
        new Notify ({
            status: 'error',
            title: 'First name is required',
            autotimeout: 2000,
        })
    }else if(form.last_name == ''){
        new Notify ({
            status: 'error',
            title: 'Last name is required',
            autotimeout: 2000,
        })
    }else if(form.mobile == ''){
        new Notify ({
            status: 'error',
            title: 'Mobile is required',
            autotimeout: 2000,
        })
    }else if(form.email == ''){
        new Notify ({
            status: 'error',
            title: 'Email is required',
            autotimeout: 2000,
        })
    }else if(form.password == ''){
        new Notify ({
            status: 'error',
            title: 'Password is required',
            autotimeout: 2000,
        })
    }else if(form.password_confirmation == ''){
        new Notify ({
            status: 'error',
            title: 'Password confirmation is required',
            autotimeout: 2000,
        })
    }else if(form.password != form.password_confirmation){
        new Notify ({
            status: 'error',
            title: 'Password and password confirmation should be same',
            autotimeout: 2000,
        })
    }else {
        form.post('/user-registration', {
            onSuccess: () => {

                if(page.props.flash.error){
                        new Notify ({
                        status: 'error',
                        title: page.props.flash.error.message,
                        autotimeout: 2000,
                    })
                    form.password = '';
                    form.password_confirmation = '';

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
                    title: 'Registration failed',
                    autotimeout: 2000,
                })
            }
        });
    }


}




</script>

<template>

    <section class="mx-auto mt-4">

        <div class="form-bg">
            <div class="container">
                <div class="row ">
                    <div class="col-md-8 col-md-offset-8 mx-auto">
                        <div class="form-container">
                            <div class="form-icon"><i class="fa fa-user"></i></div>

                            <h3 class="title">Registration</h3>

                            <form class="form-horizontal" @submit.prevent="submitForm()">

                                <div class="d-flex">
                                    <div class="form-group me-2 w-100">
                                        <label>First Name</label>
                                        <input v-model="form.first_name" class="form-control" type="text" placeholder="First Name">
                                    </div>

                                    <div class="form-group w-100">
                                        <label>Last Name</label>
                                        <input v-model="form.last_name" class="form-control" type="text" placeholder="Last Name">
                                    </div>

                                </div>


                                <div class="d-flex">

                                    <div class="form-group me-2 w-100">
                                        <label>Mobile</label>
                                        <input v-model="form.mobile" class="form-control" type="tel" placeholder="Mobile">
                                    </div>

                                    <div class="form-group w-100">
                                        <label>email</label>
                                        <input v-model="form.email" class="form-control" type="email" placeholder="email address">
                                    </div>
                                </div>

                                <div class="d-flex justify-content-center align-items-center">

                                    <div class="form-group w-100 me-2">
                                        <label>password</label>
                                        <input v-model="form.password" class="form-control" type="password" placeholder="password">
                                    </div>
                                    <div class="form-group w-100 me-2">
                                        <label>confirm password</label>
                                        <input v-model="form.password_confirmation" class="form-control" type="password" placeholder="confirm password">
                                    </div>


                                </div>

                                  <div class="form-group w-50 mx-auto">
                                        <button type="submit" class="btn btn-default" :disabled="form.processing">Registration</button>
                                </div>

                                <p class="text-center">Already have an account? <Link class="text-primary fw-bold form-link" href="/login">Login</Link></p>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>


</template>

<style scoped>
.form-container {
    background: #ecf0f3;
    font-family: 'Nunito', sans-serif;
    padding: 10px 40px;
    border-radius: 20px;
    box-shadow: 10px 10px 15px #cbced1, -10px -10px 15px white;
}
.form-link{
    text-decoration: none;
    color: #8B5DFF !important;
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
    padding: 10px 15px 11px;
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
