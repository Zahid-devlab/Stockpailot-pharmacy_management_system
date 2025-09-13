<script setup>

import adminLayout from '../../Layouts/adminLayout.vue';
defineOptions({ layout: adminLayout });
import { usePage } from '@inertiajs/vue3';
const page = usePage();


 function reportGenerate() {
    const dateFrom = document.getElementById('date-from').value;
    const dateTo = document.getElementById('date-to').value;

    if(dateFrom === '' || dateTo === '') {

        new Notify({
            status: 'info',
            title: 'Please select date range',
            autotimeout: 1000,
        })

    }else{
        window.open('/sales-report/'+dateFrom+'/'+dateTo);
    }


}



</script>

<template>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="card m-2" id="invoice">
                    <div class="card-body">
                        <div>
                            <h3 class="card-title text-center">Sales Report</h3>

                            <label class="form-label" for="date-from">From</label>
                            <input class="form-control" type="date" id="date-from">

                            <label class="form-label" for="date-to">To</label>
                            <input class="form-control" type="date" id="date-to">

                            <button class="btn btn-secondary mt-3" @click="reportGenerate()">Generate</button>


                        </div>

                    </div>
                </div>

            </div>


        </div>
    </div>


</template>

<style scoped></style>
