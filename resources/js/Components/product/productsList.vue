<script setup>
import { ref, reactive } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { Modal } from 'bootstrap';
import createProduct from './createProduct.vue';


const page = usePage();

const header = [
    { text: 'Image', value: 'img_url' },
    { text: 'Name', value: 'name' },
    { text: 'Price', value: 'price' },
    { text: 'Unit', value: 'unit' },
    { text: 'Category', value: 'category_id' },
    { text: 'Invoices', value: 'invoices.count' },
    { text: 'Action', value: 'number' },
]

const item = ref(page.props.list);

const searchField = ['id', 'name'];
const searchValue = ref('');



const form = useForm({
    'id': '',
    'img_url': '',
})


let invLen = 0
function itemClick(newId, name, invLength) {
    form.id = newId
    form.img_url = name
    invLen = invLength
}

function deleteConfirm() {
    Modal.getInstance('#deleteModal').hide();

    if (invLen > 0) {

        new Notify({
            status: 'error',
            title: 'Product has invoice and can not be deleted',
            autotimeout: 2000,
        })

    } else {

        form.delete('/user-product-delete/', {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get("/products");
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
                    title: 'Delete failed',
                    autotimeout: 2000,
                })
            }
        });
    }




}





</script>

<template>

    <div class="container-fluid pt-4 px-4">
        <div class="row g-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <input type="text" class="form-control  w-auto mb-2" placeholder="Search..."
                                v-model="searchValue">
                            <button class="btn btn-secondary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Add Product</button>
                        </div>

                        <createProduct></createProduct>


                        <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                            theme-color="#009A31" :rows-per-page="5" table-class-name="customize-table"
                            :search-field="searchField" :search-value="searchValue" show-index>

                            <!-- Template for Image Column -->
                            <template #item-img_url="{ img_url }">
                                <!-- Safe check for item and item.img -->
                                <img v-if="img_url" :src="img_url" alt="Product Image" width="50" height="50" />
                                <span v-else>No Image</span> <!-- Fallback if no image exists -->
                            </template>

                            <template #item-invoices.count="{ invoice_product }">
                                {{ invoice_product.length }}
                            </template>

                            <template #item-number="{ id, img_url, invoice_product }">

                                <div class="d-flex align-items-center my-2">
                                    <Link class="btn btn-sm btn-secondary me-2" :href="`/product-edit/${id}`"><i
                                        class="fa-regular fa-pen-to-square"></i></Link>
                                    <Link class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal"
                                        @click="itemClick(id, img_url, invoice_product.length)"><i
                                        class="fa-regular fa-trash-can"></i></Link>
                                </div>
                            </template>


                        </EasyDataTable>


                        <!-- delete Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>


                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-secondary" :disabled="form.processing"
                                            @click="deleteConfirm()">Yes</button>
                                    </div>


                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

        </div>


    </div>
</template>

<style scoped>
@media (max-width: 575.98px) {

    button {
        font-size: 10px !important;
        font-weight: bold !important;
        padding: 10px 5px !important;
        margin: 0px !important;
        margin-left: 2px !important;
        margin-top: -8px !important;
    }
}
</style>
