<script setup>
import { ref, reactive } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { Modal } from 'bootstrap';


const page = usePage();

const header = [
    { text: 'Name', value: 'customer.name' },
    { text: 'Phone', value: 'customer.mobile' },
    { text: 'Total', value: 'total' },
    { text: 'Dues', value: 'due' },
    { text: 'Action', value: 'number' },
]

const item = ref(page.props.list);

const searchField = ['customer.name', 'customer.mobile','customer.email'];
const searchValue = ref('');



const form = useForm({
    'invoice_id': '',
})



function itemClick(newId) {
    form.invoice_id = newId
}

function deleteConfirm() {
    Modal.getInstance('#deleteModalInvoice').hide();
    form.delete('/user-invoice-delete', {
        onSuccess: () => {
            if (page.props.flash.success) {
                new Notify({
                    status: 'success',
                    title: page.props.flash.success.message,
                    autotimeout: 2000,
                })
                router.get("/invoice");
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

const DuesForm = useForm({
    'invoice_id': '',
    'due' : '',
})

const EditDues = (id,due) => {
    DuesForm.invoice_id = id,
    DuesForm.due = due
}

const dueSubmit = () => {
    Modal.getInstance('#exampleModal').hide();
    DuesForm.put('/user-invoice-dues-update', {
        onSuccess: () => {
            if (page.props.flash.success) {
                new Notify({
                    status: 'success',
                    title: page.props.flash.success.message,
                    autotimeout: 2000,
                })
                router.get("/invoice");
            } else if (page.props.flash.error) {
                new Notify({
                    status: 'error',
                    title: page.props.flash.error.message,
                    autotimeout: 2000,
                })
            }
        }
    })
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
                            <Link href="/sale" class="btn btn-secondary">Create Invoice</Link>
                        </div>


                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Dues</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="number" class="form-control" v-model="DuesForm.due">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" @click="dueSubmit" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                            theme-color="#009A31" :rows-per-page="5" table-class-name="customize-table"
                            :search-field="searchField" :search-value="searchValue" show-index>

                            <template #item-due="{ due, id }">
                                <span v-if="due > 0" class="text-danger"> {{ due }}

                                    <a class="" data-bs-toggle="modal" @click="EditDues(id,due)"
                                        data-bs-target="#exampleModal"><i
                                            class="fa-solid fa-pen-to-square fs-9"></i></a>

                                </span>
                                <span v-else class="text-success"> 0 </span>
                            </template>

                            <template #item-number="{ id }">

                                <div class="d-flex align-items-center my-2">
                                    <Link class="btn btn-sm btn-secondary me-2" :href="`/user-invoice-select/${id}`"><i
                                        class="fa-regular fa-eye"></i></Link>
                                    <Link class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteModalInvoice" @click="itemClick(id)"><i
                                        class="fa-regular fa-trash-can"></i></Link>
                                </div>
                            </template>


                        </EasyDataTable>


                        <!-- delete Modal -->
                        <div class="modal fade" id="deleteModalInvoice" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
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
