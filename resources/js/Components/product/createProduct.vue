<script setup>
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Modal } from 'bootstrap';


const page = usePage();

const liveImg = ref('https://agrimart.in/uploads/vendor_banner_image/default.jpg');


const form = useForm({
    'name': '',
    'price': '',
    'unit': '',
    'category_id': '',
    'img': '',
})


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
    }else if (form.price == '') {
        new Notify({
            status: 'info',
            title: 'Product price is required',
            autotimeout: 2000,
        })
    }else if (form.unit == '') {
        new Notify({
            status: 'info',
            title: 'Product unit is required',
            autotimeout: 2000,
        })
    }else if (form.category_id == null) {
        new Notify({
            status: 'info',
            title: 'Product category is required',
            autotimeout: 2000,
        })
    }else if (form.img == '') {
        new Notify({
            status: 'info',
            title: 'Product image is required',
            autotimeout: 2000,
        })
    }else{
        form.post('/user-product-create', {
            onSuccess: () => {
                Modal.getInstance('#exampleModal').hide();
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




function categoryUpdateSubmit() {

    form.post('/user-category-update/' + id, {
        onSuccess: () => {
            Modal.getInstance('#editModal').hide();
            if (page.props.flash.success) {
                new Notify({
                    status: 'success',
                    title: page.props.flash.success.message,
                })
                form.reset();
                router.get("/category");
            } else if (page.props.flash.error) {
                new Notify({
                    status: 'error',
                    title: page.props.flash.error.message,
                })
            }
        }
    });

}
</script>

<template>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <form @submit.prevent="ProductSubmit">
                    <div class="modal-body">

                        <div class="mb-1">
                            <label class="input-label" for="productName">Product Name</label>
                            <input type="text" v-model="form.name" class="form-control" id="productName" placeholder="Product Name">

                            <label for="price" class="input-label">Price</label>
                            <input type="number" v-model="form.price" class="form-control" id="price" placeholder="Price">

                            <label for="unit" class="input-label">Unit</label>
                            <input type="number" v-model="form.unit" class="form-control" id="unit" placeholder="Unit">

                            <label for="category_id" class="input-label">Category</label>
                            <select class="form-select" v-model="form.category_id" id="category_id">
                                <option value="" >Choose Category</option>
                                <template v-for="category in page.props.categoriesList">
                                    <option :value="category.id">{{ category.name }}</option>
                                </template>
                            </select>

                            <div class="my-3" style="height: 80px; width: 200px">
                                <img width="100%" height="100%"
                                    :src="liveImg" alt="">
                            </div>
                            <label for="image" class="input-label">Product Image-</label>
                            <input type="file" class="form-control" id="image" @change="imgInput($event)">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-secondary" :disabled="form.processing">Save
                            changes</button>
                    </div>

                </form>
            </div>
        </div>
    </div>


</template>

<style scoped></style>
