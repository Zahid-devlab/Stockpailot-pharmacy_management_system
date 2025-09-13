<script setup>
import { ref, reactive } from 'vue';
import { usePage, router } from '@inertiajs/vue3';
import { useForm } from '@inertiajs/vue3';
import { Modal } from 'bootstrap';


const form = useForm({
    'customer_id': '',
    'total': '',
    'discount': '',
    'vat': '',
    'payable': '',
    'products': '',
    'due': '',
})



const page = usePage();

const CustomerHeader = [
    { text: 'Name', value: 'name' },
    // { text: 'Email', value: 'email' },
    { text: 'Mobile', value: 'mobile' },
    { text: 'pickup', value: 'pickup' },

]

const CustomerItem = ref(page.props.customers);

const CustomerSearchField = ['id', 'name', 'email', 'mobile'];
const CustomerSearchValue = ref('');


const ProductHeader = [
    { text: 'Image', value: 'img_url' },
    { text: 'Name', value: 'name' },
    { text: 'pickup', value: 'pickup' },
]

const ProductItem = ref(page.props.products);

const ProductSearchField = ['id', 'name'];
const ProductSearchValue = ref('');


const customerDetails = reactive({
    'customer_id': '',
    'name': '',
    'email': '',
    'mobile': '',

})
const productDetails = reactive({
    'product_id': '',
    'name': '',
    'qty': '1',
    'price': '',
})


const sellsProducts = reactive([])

const updateChangeSellsProduct = () => {
    temTotal = 0
    for (let i = 0; i < sellsProducts.length; i++) {
        temTotal += sellsProducts[i].sale_price * sellsProducts[i].qty
    }


    form.total = temTotal

    let vat = temTotal * 0

    form.vat = vat

    form.payable = temTotal + vat
}



const customerClick = (id, name, email, mobile) => {
    customerDetails.customer_id = id
    customerDetails.name = name
    customerDetails.email = email
    customerDetails.mobile = mobile
    form.customer_id = id

}

let limitProduct = 0
const productClick = (id, name, price, unit) => {
    productDetails.product_id = id
    productDetails.name = name
    productDetails.price = price

    limitProduct = unit
}


let temTotal = 0

const addProduct = () => {

    sellsProducts.push({
        'product_id': productDetails.product_id,
        'name': productDetails.name,
        'sale_price': productDetails.price,
        'qty': productDetails.qty

    })
    form.products = sellsProducts

    Modal.getInstance('#ProductModal').hide();

    productDetails.qty = 1

    updateChangeSellsProduct()



}

const updateDiscount = (e) => {

    form.discount = e.target.value

    let total = temTotal - temTotal * (e.target.value / 100)
    form.total = total.toFixed(2)

    let vat = total * (5 / 100)
    form.vat = vat.toFixed(2)

    let payable = total + vat
    form.payable = payable.toFixed(2)

}

const submitProduct = () => {

    if (form.products.length ===0) {
        new Notify({
            status: 'error',
            title: 'Please Select Product',
            autotimeout: 2000,
        })

    }
    else if (form.customer_id === '') {
        new Notify({
            status: 'error',
            title: 'Please Select Customer',
            autotimeout: 2000,
        })


    }else{
        form.post('/user-invoice-create', {
        onSuccess: () => {
            if (page.props.flash.success) {
                new Notify({
                    status: 'success',
                    title: page.props.flash.success.message,
                    autotimeout: 2000,
                })
                form.reset();
                router.get("/invoice");
            } else if (page.props.flash.error) {
                new Notify({
                    status: 'error',
                    title: page.props.flash.error.message,
                    autotimeout:2000,
                })
            }
        }
    })
    }


}

const removeProduct = (item) => {
    sellsProducts.splice(sellsProducts.indexOf(item), 1)
    updateChangeSellsProduct()
}

document.addEventListener("DOMContentLoaded", function () {
    const productModal = document.getElementById("ProductModal");

    if (productModal) {
        productModal.addEventListener("hidden.bs.modal", function () {
            productDetails.qty = 1
        });
    }
});


</script>

<template>

    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-5 d-md-flex">

                <div class=" col-md-4 ">
                    <div class="card m-2">
                        <div class="card-body">
                            <div>

                                <div class="d-flex justify-content-between">

                                    <div>
                                        <p class="fw-bold text-dark">BILLED TO</p>
                                        <p class="m-0">Name: <span>{{ customerDetails.name }}</span> </p>
                                        <p v-if="customerDetails.email" class="m-0">Email: <span>{{ customerDetails.email }}</span></p>
                                        <p class="m-0">Mobile: <span>{{ customerDetails.mobile }}</span> </p>
                                        <p class="m-0">User ID: <span>{{ customerDetails.customer_id }}</span></p>
                                        <p class="m-0">Date: <span>{{ new Date().toLocaleString().slice(0, 9) }}</span>
                                        </p>
                                    </div>


                                    <div>
                                        <img style="width: 100px; height: 50px" src="/dashboard/img/logo.png" alt="">

                                    </div>

                                </div>

                                <div>
                                    <table class="table mt-3">
                                        <tr class="text-dark border-bottom ">
                                            <th class="table-header fw-normal">Name</th>
                                            <th class="table-header fw-normal">Qty</th>
                                            <th class="table-header fw-normal">Price</th>
                                            <th class="table-header fw-normal">Total</th>
                                            <th class="table-header fw-normal">Remove</th>
                                        </tr>

                                        <tr v-for="item in sellsProducts" class="border-bottom">

                                            <td class="tble-data">{{ item.name }}</td>
                                            <td class="tble-data">{{ item.qty }}</td>
                                            <td class="tble-data">{{ item.sale_price }}</td>
                                            <td class="tble-data">{{ item.sale_price * item.qty }}</td>
                                            <td class="tble-data"><button class="btn btn-sm border-0" @click="removeProduct(item)"><i class="fa-regular fa-trash-can text-danger"></i></button>
                                            </td>


                                        </tr>
                                    </table>

                                </div>

                                <div>
                                    <h6>Total: {{ form.total }}</h6>
                                    <h6>Vat(0%):{{ form.vat}}</h6>
                                    <h6>Payable: {{ form.payable }} </h6>
                                    <h6 v-if="form.due">Due: {{ form.due }}</h6>

                                    <label for="due" class="form-label">Due</label>
                                    <input type="number" class="form-control" id="due"  placeholder="Total Due" v-model="form.due"  min="0">

                                    <button class="btn btn-success mt-3" @click="submitProduct()">Save</button>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="card m-2">
                        <div class="card-body">

                            <div class="mb-4">
                                <input type="text" class="form-control  w-auto mb-2" placeholder="Search..."
                                    v-model="ProductSearchValue">

                            </div>

                            <EasyDataTable buttons-pagination alternating :headers="ProductHeader" :items="ProductItem"
                                theme-color="#009A31" :rows-per-page="5" table-class-name="customize-table"
                                :search-field="ProductSearchField" :search-value="ProductSearchValue">

                                <template #item-img_url="{ img_url }">
                                    <!-- Safe check for item and item.img -->
                                    <img v-if="img_url" :src="img_url" alt="Product Image" width="50" height="30" />
                                    <span v-else>No Image</span> <!-- Fallback if no image exists -->
                                </template>

                                <template #item-pickup="{ id, name, price, unit }">
                                    <div class="d-flex align-items-center my-2">
                                        <button class="btn btn-sm btn-primary  me-2" data-bs-toggle="modal"
                                            data-bs-target="#ProductModal"
                                            @click="productClick(id, name, price, unit)">Add</button>
                                    </div>
                                </template>


                            </EasyDataTable>



                        </div>
                    </div>
                </div>

                <div class="col-md-4 ">
                    <div class="card m-2">
                        <div class="card-body">

                            <div class="mb-4">
                                <input type="text" class="form-control  w-auto mb-2" placeholder="Search..."
                                    v-model="CustomerSearchValue">

                            </div>

                            <EasyDataTable buttons-pagination alternating :headers="CustomerHeader"
                                :items="CustomerItem" theme-color="#009A31" :rows-per-page="5"
                                table-class-name="customize-table" :search-field="CustomerSearchField"
                                :search-value="CustomerSearchValue">

                                <template #item-name="{name}">
                                    <p><i class="fa-solid fa-user text-secondary me-1"></i>{{ name }}</p>
                                </template>

                                <template #item-pickup="{ id, name, email, mobile }">
                                    <div class="d-flex align-items-center my-2">
                                        <button class="btn btn-sm btn-primary me-2"
                                            @click="customerClick(id, name, email, mobile)">Add</button>
                                    </div>
                                </template>


                            </EasyDataTable>



                        </div>
                    </div>
                </div>

                <div class="modal fade" id="ProductModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">

                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Product</h1>
                            </div>

                            <div class="modal-body">
                                <div class="mb-1">
                                    <label class="input-label" for="productName">Product Name</label>
                                    <input type="text" v-model="productDetails.name" class="form-control"
                                        id="productName" placeholder="Product Name">
                                </div>

                                <div class="mb-1">
                                    <label class="input-label" for="productPrice">Price</label>
                                    <input type="text" v-model="productDetails.price" class="form-control"
                                        id="productPrice" placeholder="Product Price">
                                </div>

                                <div class="mb-1">
                                    <label class="input-label" for="productUnit">Qty</label>
                                    <input type="number" min="1" :max="limitProduct" v-model="productDetails.qty"
                                        class="form-control" id="productUnit" placeholder="Product Unit">
                                </div>
                            </div>

                            <div class="modal-footer d-flex justify-content-between">
                                <button type="button" class="btn btn-sm btn-danger"
                                    data-bs-dismiss="modal" @click="productDetails.qty = 1">Cancel</button>
                                <button type="button" class="btn btn-sm btn-secondary"
                                    @click="addProduct()">Add</button>
                            </div>


                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>



</template>

<style scoped>
.text-primary {
    color: #F51AA4 !important;
}

.text-secondary {
    color: #8B5DFF !important;
}

.btn-primary {
    background-color: #8B5DFF !important;
    border-color: white !important;
}
</style>
