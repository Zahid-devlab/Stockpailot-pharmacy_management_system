<script setup>
import { usePage } from '@inertiajs/vue3';

const page = usePage();
</script>

<template>
<div class="container-fluid pt-4 px-4">
                <div class="row g-4">

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                              <i class="fa-solid fa-dollar-sign fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Sale</p>
                                <h6 class="mb-0">{{ page.props.todayTotalSell }} tk</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                             <i class="fa-solid fa-hand-holding-dollar fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Dues</p>
                                <h6 class="mb-0">{{ page.props.todayDue }} tk</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                             <i class="fa-solid fa-sack-dollar fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Today Profit</p>
                                <h6 class="mb-0">{{ page.props.todayTotalProfit }} tk</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                             <i class="fa-solid fa-briefcase fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Product</p>
                                <h6 class="mb-0">{{ page.props.product }} th</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-people-group fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Customer</p>
                                <h6 class="mb-0">{{ page.props.customer }} th</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-pie fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Category</p>
                                <h6 class="mb-0">{{ page.props.category }} th</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa fa-chart-area fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Invoice</p>
                                <h6 class="mb-0">{{ page.props.invoice }} th</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-dollar-sign fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Sale</p>
                                <h6 class="mb-0">{{ page.props.total }} tk</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-hand-holding-dollar fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Dues</p>
                                <h6 class="mb-0">{{ page.props.due }} tk</h6>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-xl-3">
                        <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                            <i class="fa-solid fa-sack-dollar fa-3x text-secondary"></i>
                            <div class="ms-3">
                                <p class="mb-2">Total Profit</p>
                                <h6 class="mb-0">{{ page.props.totalProfit }} tk</h6>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
</template>

<style scoped>
.text-secondary{
    color: #8B5DFF !important;
}
</style>
