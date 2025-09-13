<script setup>
import adminLayout from '../../Layouts/adminLayout.vue';
defineOptions({ layout: adminLayout });
import { usePage } from '@inertiajs/vue3';
const page = usePage();


const printPage = () => {

    let printContent = document.getElementById('invoice').innerHTML;
    let originalContent = document.body.innerHTML;

    document.body.innerHTML = printContent;
    window.print();

    document.body.innerHTML = originalContent

    location.reload();

}
</script>

<template>

    <div class="container">
        <div class="row">
            <div class="col-md-8 mx-auto">
                <div class="card m-2" id="invoice">
                    <div class="card-body">
                        <div>

                            <div class="d-flex justify-content-between">

                                <div>
                                    <p class="fw-bold text-dark">BILLED TO</p>
                                    <p class="m-0">Name: <span>{{ page.props.list.invoice.customer.name }}</span> </p>
                                    <p v-if="page.props.list.invoice.customer.email" class="m-0">Email: <span>{{ page.props.list.invoice.customer.email}}</span></p>
                                    <p class="m-0">Mobile: <span>{{ page.props.list.invoice.customer.mobile }}</span> </p>
                                    <p class="m-0">User ID: <span>{{ page.props.list.invoice.customer.id}}</span></p>
                                    <p class="m-0">Date: <span>{{ page.props.list.invoice.created_at.split('T')[0]}}</span>
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
                                        <th class="table-header fw-normal">Price</th>
                                        <th class="table-header fw-normal">Qty</th>
                                        <th class="table-header fw-normal">Total</th>

                                    </tr>

                                    <tr v-for="item in page.props.list.product" class="border-bottom">

                                        <td class="tble-data">{{ item.product.name }}</td>
                                        <td class="tble-data">{{ item.sale_price  }}</td>
                                        <td class="tble-data">{{ item.qty  }}</td>
                                        <td class="tble-data">{{ item.sale_price * item.qty  }}</td>



                                    </tr>
                                </table>

                            </div>

                            <div>
                                <h6>Total: {{page.props.list.invoice.total }}</h6>
                                <h6>Discount: {{ page.props.list.invoice.discount }}</h6>
                                <h6>Vat:{{ page.props.list.invoice.vat }}</h6>
                                <h6>Payable: {{ page.props.list.invoice.payable }} </h6>

                            </div>

                        </div>

                    </div>
                </div>

                <button class="btn btn-success mt-3 " @click="printPage()">Print</button>
            </div>


        </div>
    </div>


</template>

<style scoped></style>
