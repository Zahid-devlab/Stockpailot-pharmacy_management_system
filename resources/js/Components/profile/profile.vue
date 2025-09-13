<script setup>
import { useForm, usePage } from '@inertiajs/vue3';
import Notify from 'simple-notify';
import { router} from '@inertiajs/vue3';
import { ref } from 'vue';

const page = usePage()

const form = useForm({
    firstName: page.props.list[0].first_name,
    lastName: page.props.list[0].last_name,
    email: page.props.list[0].email,
    mobile: page.props.list[0].mobile,
    password: '',
    img :page.props.list[0].img,
    img_old: page.props.list[0].img,
})

const tempProfile = ref(form.img_old);

const userSubmit = () => {
    if (form.firstName === '') {

        new Notify({
            status: 'error',
            title: 'first name is required',
            autotimeout: 2000,
        })
    } else if (form.lastName === '') {
        new Notify({
            status: 'error',
            title: 'last name is required',
            autotimeout: 2000,
        })
    } else if (form.email === '') {
        new Notify({
            status: 'error',
            title: 'email is required',
            autotimeout: 2000,
        })
    } else if (form.mobile === '') {
        new Notify({
            status: 'error',
            title: 'mobile is required',
            autotimeout: 2000,
        })
    } else if (form.password === '') {
        new Notify({
            status: 'error',
            title: 'password is required',
            autotimeout: 2000,
        })
    } else {

        form.post('/user-update-profile', {
            onSuccess: () => {

                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    form.reset();
                    router.get("/user-profile");
                } else if (page.props.flash.error) {
                    new Notify({
                        status: 'error',
                        title: page.props.flash.error.message,
                        autotimeout: 2000,
                    })
                }
            },

            onError: () => {

                new Notify({
                    status: 'error',
                    title: 'Profile Update Failed',
                    autotimeout: 2000,
                })
            }
        })

    }


}



let loadFile = (event) => {
    let file = event.target.files[0];
    let image_url = URL.createObjectURL(file)
    tempProfile.value = image_url;
    form.img = event.target.files[0];
};

</script>

<template>
    <div class="container">
        <div class="row">

            <div class="card col-md-6 mx-auto mt-3">
                <div class="card-body">
                    <form @submit.prevent="userSubmit">
                        <div class="modal-body">

                            <div>
                                <div class="profile-pic">
                                    <label class="-label" for="file">
                                        <span>Change Photo</span>
                                    </label>
                                    <input id="file" type="file" @change="loadFile($event)" />
                                    <img :src="tempProfile ? tempProfile :'dashboard/img/user.png'" alt=""
                                        id="output" width="200" />

                                </div>
                            </div>

                            <div class="mb-1">

                                <label class="input-label" for="fName">First Name</label>
                                <input type="text" v-model="form.firstName" class="form-control" id="fName"
                                    placeholder="Name">

                                <label class="input-label" for="lName">Last Name</label>
                                <input type="text" v-model="form.lastName" class="form-control" id="lName"
                                    placeholder=" Name">

                                <label for="email" class="input-label">Email</label>
                                <input type="email" v-model="form.email" class="form-control" id="email"
                                    placeholder=" Email">

                                <label for="mobile" class="input-label">Mobile</label>
                                <input type="tel" v-model="form.mobile" class="form-control" id="mobile"
                                    placeholder="Mobile Number">

                                <label for="password" class="input-label">Password</label>
                                <input type="password" v-model="form.password" class="form-control" id="password"
                                    placeholder="password">

                                <div class="form-group">
                                    <button type="submit" class="btn btn-secondary mt-3">Update</button>
                                </div>

                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</template>

<style scoped>
.profile-pic {
    color: transparent;
    transition: all 0.3s ease;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    transition: all 0.3s ease;

}

.profile-pic input {
    display: none;
}

.profile-pic img {
    position: absolute;
    object-fit: cover;
    width: 100px;
    height: 100px;
    border-radius: 100px;
    z-index: 0;
    border: 2px solid #8B5DFF ;
}

.profile-pic .-label {
    cursor: pointer;
    height: 100px;
    width: 100px;
    font-size: 10px;
}

.profile-pic:hover .-label {
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: rgba(0, 0, 0, 0.562);
    z-index: 10000;
    color: #fafafa;
    transition: background-color 0.2s ease-in-out;
    border-radius: 100px;
    margin-bottom: 0;
}

.profile-pic span {
    display: inline-flex;
    padding: 0.2em;
    height: 2em;
}
</style>
