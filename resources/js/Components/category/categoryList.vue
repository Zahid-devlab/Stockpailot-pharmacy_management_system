<script setup>
import { ref } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Link } from '@inertiajs/vue3';
import { Modal } from 'bootstrap';

const page = usePage();

const header = [
    { text: 'Name', value: 'name' },
    { text: 'Product', value: 'product.length' },
    { text: 'Action', value: 'number' },
]

const item = ref(page.props.list);

const searchField = ['id', 'name'];
const searchValue = ref('');



const form = useForm({
    'name': '',
})

const CategorySubmit = () => {
    if (form.name == '') {
        new Notify({
            status: 'info',
            title: 'Category name is required',
            autotimeout: 2000,
        })
    } else {
        form.post('/user-category-create', {
            onSuccess: () => {
                Modal.getInstance('#exampleModal').hide();
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })

                    form.reset();
                    router.get("/category");

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
                    title: 'Create failed',
                    autotimeout: 2000,
                })
            }
        },
        );
    }
}

let id = 0
let productLen = 0
function itemClick(newId, productLength) {
    id = newId
    productLen = productLength

}

function deleteConfirm() {
    Modal.getInstance('#deleteModal').hide();
    if (productLen > 0) {
        new Notify({
            status: 'error',
            title: 'Delete failed, category has product',
            autotimeout: 2000,
        })
    } else {

        router.delete('/user-category-delete/' + id,{
            onSuccess: () => {
                if (page.props.flash.success) {
                    new Notify({
                        status: 'success',
                        title: page.props.flash.success.message,
                        autotimeout: 2000,
                    })
                    router.get("/category");
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





}

function categoryUpdateClick(Id, OldName) {
    id = Id
    let name = OldName
    form.name = name

}
function categoryUpdateSubmit() {

    form.post('/user-category-update/' + id, {
        onSuccess: () => {
            Modal.getInstance('#editModal').hide();
            if (page.props.flash.success) {
                new Notify({
                    status: 'success',
                    title: page.props.flash.success.message,
                    autotimeout: 2000,
                })
                form.reset();
                router.get("/category");
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
                            <button class="btn btn-sm btn-secondary  fs-sm-3" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">Add Category</button>
                        </div>

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <form @submit.prevent="CategorySubmit">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5 " id="exampleModalLabel">Enter New Category Name
                                            </h1>


                                        </div>
                                        <div class="modal-body">
                                            <input v-model="form.name" type="text" class="form-control w-100"
                                                placeholder="Category Name">
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-secondary"
                                                :disabled="form.processing">Save
                                                changes</button>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>

                        <EasyDataTable buttons-pagination alternating :headers="header" :items="item"
                            theme-color="#009A31" :rows-per-page="5" table-class-name="customize-table"
                            :search-field="searchField" :search-value="searchValue" show-index>


                            <template #item-number="{ id, name, product }">
                                <div class="d-flex align-items-center my-2">
                                    <Link class="btn btn-sm btn-secondary me-2" data-bs-toggle="modal"
                                        data-bs-target="#editModal" @click="categoryUpdateClick(id, name)" href="#"><i
                                        class="fa-regular fa-pen-to-square"></i></Link>
                                    <Link class="btn btn-sm btn-danger" href="#" data-bs-toggle="modal"
                                        data-bs-target="#deleteModal" @click="itemClick(id, product.length)"><i
                                        class="fa-regular fa-trash-can"></i></Link>
                                </div>
                            </template>


                        </EasyDataTable>

                        <!-- edit Modal -->
                        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Update Category Name</h1>

                                    </div>
                                    <div class="modal-body">
                                        <input v-model="form.name" type="text" class="form-control w-100"
                                            placeholder="Category Name">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                                            @click="form.reset()">Close</button>
                                        <button type="button" @click="categoryUpdateSubmit" class="btn btn-secondary"
                                            :disabled="form.processing">Save
                                            changes</button>
                                    </div>


                                </div>
                            </div>
                        </div>

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

<style scoped></style>
