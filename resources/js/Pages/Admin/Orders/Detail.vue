<template>
    <Head title="Supplier" />

    <Admin>
        <Breadcrumb>
            <BreadcrumbItem link="#">
                <svg
                    class="icon icon-xxs"
                    fill="none"
                    stroke="currentColor"
                    viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"
                    ></path>
                </svg>
                Dashboard
            </BreadcrumbItem>
            <BreadcrumbItem active link="#">Pesanan</BreadcrumbItem>
        </Breadcrumb>

        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <!-- card title -->
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h3 class="mb-0">
                                    INVOICE-ORDER-{{ order.invoice_number }}
                                </h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <td style="width: 30%">Pemesan:</td>
                                        <td>{{ order.user.name }}</td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal:</td>
                                        <td>{{ order.date }}</td>
                                    </tr>
                                    <tr>
                                        <td>Status:</td>
                                        <td>
                                            {{ order.status }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <td>Total Komoditas:</td>
                                        <td>
                                            {{ order.total_commodities }}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Subtotal:</td>
                                        <td class="text-success">
                                            {{ formatRupiah(order.sub_total) }}
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="row mt-5">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Nama Komoditas</th>
                                            <th scope="col">Jumlah</th>
                                            <th scope="col">Harga</th>
                                            <th scope="col">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr
                                            v-for="(detail, index) in detail"
                                            :key="index"
                                        >
                                            <th scope="row">{{ index + 1 }}</th>
                                            <td>{{ detail.commodity.name }}</td>
                                            <td>
                                                {{ detail.quantity }}
                                            </td>
                                            <td>
                                                {{
                                                    formatRupiah(
                                                        detail.unit_price
                                                    )
                                                }}
                                            </td>
                                            <td>
                                                {{ formatRupiah(detail.total) }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Admin>
</template>

<script>
import Admin from "../../../Layouts/Admin.vue";
import Breadcrumb from "../../../Components/Breadcrumb.vue";
import BreadcrumbItem from "../../../Components/BreadcrumbItem.vue";
import Pagination from "../../../Components/Pagination.vue";

import { Head, Link, router } from "@inertiajs/vue3";

import { ref } from "vue";

import Swal from "sweetalert2";

export default {
    components: {
        Admin,
        Head,
        Breadcrumb,
        BreadcrumbItem,
        Pagination,
    },

    props: {
        order: Object,
        detail: Object,
        errors: Object,
    },
};
</script>
