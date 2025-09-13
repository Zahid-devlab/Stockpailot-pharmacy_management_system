<script setup>
import { ref, defineProps, reactive } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';


const page = usePage();

const liveImg = ref('');


const form = useForm({
    'id': page.props.product.id,
    'name': '',
    'price': '',
    'unit': '',
    'category_id': null,
    'img': '',
})

if (page.props.product) {
    form.name = page.props.product.name;
    form.price = page.props.product.price;
    form.unit = page.props.product.unit;
    form.category_id = page.props.product.category_id;
    form.img = page.props.product.img_url;

}



const imgInput = (e) => {
    let img = e.target.files[0];

    form.img = img;

    liveImg.value = URL.createObjectURL(img);

}

const ProductSubmit = () => {

    if (form.name == '') {
        new Notify({
            status: 'info',
            title: 'Product name is required',
            autotimeout: 2000,
        })
    } else if (form.price == '') {
        new Notify({
            status: 'info',
            title: 'Product price is required',
            autotimeout: 2000,
        })
    } else if (form.unit == '') {
        new Notify({
            status: 'info',
            title: 'Product unit is required',
            autotimeout: 2000,
        })
    } else if (form.category_id == null) {
        new Notify({
            status: 'info',
            title: 'Product category is required',
            autotimeout: 2000,
        })
    } else if (form.img_url == '') {
        new Notify({
            status: 'info',
            title: 'Product image is required',
            autotimeout: 2000,
        })
    } else {


        form.post('/user-product-update', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    form.reset();
                    router.get("/products");
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
        <form >
        <div class="mt-3 p-3 col-md-8 mx-auto card">
        <label class="input-label" for="productName">Product Name</label>
        <input type="text" v-model="form.name" class="form-control" id="productName" >

        <label for="price" class="input-label">Price</label>
        <input type="number" v-model="form.price" class="form-control" id="price" placeholder="Price">

        <label for="unit" class="input-label">Unit</label>
        <input type="number" v-model="form.unit" class="form-control" id="unit" placeholder="Unit">

        <label for="category_id" class="input-label">Category</label>
        <select class="form-select" v-model="form.category_id" id="category_id">
            <template v-for="category in page.props.categoriesList">
                <option :value="category.id">{{ category.name }}</option>
            </template>
        </select>

        <div class="my-3" style="height: 80px; width: 200px">
            <img width="100%" height="100%" v-if="liveImg == ''" :src="`/${form.img}`" alt="">
            <img width="100%" height="100%" v-else :src="liveImg" alt="">
        </div>
        <label for="image" class="input-label">Product Image-</label>
        <input type="file" class="form-control" id="image" @change="imgInput($event)">
        <button type="button" class="btn btn-secondary mx-auto mt-3 w-20" @click="ProductSubmit()">Update</button>
    </div>

    </form>
        </div>
    </div>


</template>

<style scoped></style>
