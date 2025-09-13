<script setup>
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { Modal } from 'bootstrap';

const page = usePage();

const header = [
    { text: 'Name', value: 'name' },
    { text: 'Mobile', value: 'mobile' },
    { text: 'Email', value: 'email' },
    { text: 'Invoices', value: 'invoices.count' },
    { text: 'Action', value: 'number' },
]

const item = ref(page.props.list);

const searchField = ['id', 'name', 'email', 'mobile'];
const searchValue = ref('');



let id = 0
let invoiceLen = 0
function itemClick(newId, invoiceLength) {
    id = newId
    invoiceLen = invoiceLength

}

function deleteConfirm() {
    Modal.getInstance('#deleteModal').hide();

    if (invoiceLen > 0) {

        new Notify({
            status: 'error',
            title: 'Customer has invoice and can not be deleted',
            autotimeout: 2000,
        })
    } else {

        router.delete('/user-customer-delete/' + id, {
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get("/customers");
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
                            <Link class="btn btn-secondary" href="/customer-crate">Add Customer</Link>
                        </div>

                        <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                            theme-color="#009A31" :rows-per-page="5" table-class-name="customize-table"
                            :search-field="searchField" :search-value="searchValue" show-index>

                            <template #item-invoices.count="{ invoice }">
                                {{ invoice.length }}
                            </template>

                            <template #item-number="{ id, invoice }">
                                <div class="d-flex align-items-center my-2">
                                    <Link class="btn btn-sm btn-secondary me-2" :href="`/customer-edit/` + id"><i
                                        class="fa-regular fa-pen-to-square"></i></Link>
                                    <Link class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" @click="itemClick(id, invoice.length)"><i
                                        class="fa-regular fa-trash-can"></i></Link>
                                </div>
                            </template>


                        </EasyDataTable>

                        <!-- delete Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Are you sure?</h1>


                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                        <button type="button" class="btn btn-secondary"
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

    .btn {
        font-size: 10px !important;
        font-weight: bold !important;
        padding: 10px 5px !important;
        margin: 0px !important;
        margin-left: 2px !important;
        margin-top: -8px !important;
    }
}
</style>
