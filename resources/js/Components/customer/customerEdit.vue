<script setup>
import { usePage, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';


const page = usePage();




const form = useForm({
    'id': page.props.customer.id,
    'name': page.props.customer.name,
    'email': page.props.customer.email,
    'mobile': page.props.customer.mobile
})




const ProductSubmit = () => {

    if (form.name == '') {
        new Notify({
            status: 'info',
            title: 'Product name is required',
            autotimeout: 2000,
        })
    }else if (form.email == '') {
        new Notify({
            status: 'info',
            title: 'Product email is required',
            autotimeout: 2000,
        })
    }else if (form.mobile == '') {
        new Notify({
            status: 'info',
            title: 'Product mobile is required',
            autotimeout: 2000,
        })
    }
    else{
        form.post('/user-customer-update', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    form.reset();
                    router.get("/customers");
                } else if (page.props.flash.error) {
                    new Notify({
                        status: 'error',
                        title: page.props.flash.error.message,
                        autotimeout: 2000,
                    })
                }
            }
        });
    }
}


</script>

<template>

   <div class="container">
    <div class="row">
        <div class="card col-md-6 mx-auto mt-5">
            <div class="card-body">
                <form @submit.prevent="ProductSubmit">
                    <div class="modal-body">

                        <div class="mb-1">
                            <label class="input-label" for="customerName">Customer Name</label>

                            <input type="text" v-model="form.name" class="form-control" id="customerName" placeholder="Customer Name">

                            <label for="email" class="input-label">Email</label>
                            <input type="email" v-model="form.email" class="form-control" id="email" placeholder="Customer Email">

                            <label for="mobile" class="input-label">Mobile</label>
                            <input type="tel" v-model="form.mobile" class="form-control" id="mobile" placeholder="Customer Mobile">

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

<style scoped></style>
