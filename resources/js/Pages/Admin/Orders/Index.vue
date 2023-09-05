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

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <Link
                            :href="route('orders.create')"
                            class="btn btn-md btn-primary border-0 shadow w-100"
                        >
                            <i class="fa fa-plus-circle"></i> Tambah
                        </Link>
                    </div>
                    <div class="col-md-9 col-12 mb-2">
                        <form @submit.prevent="handleSearch">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control border-0 shadow"
                                    v-model="search"
                                    placeholder="masukkan nama pesanan dan enter..."
                                />
                                <span class="input-group-text border-0 shadow">
                                    <i class="fa fa-search"></i>
                                </span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-1">
            <div class="col-md-12">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table
                                class="table table-bordered table-centered table-nowrap mb-0 rounded"
                            >
                                <thead class="thead-dark">
                                    <tr class="border-0">
                                        <th
                                            class="border-0 rounded-start"
                                            style="width: 5%"
                                        >
                                            No.
                                        </th>
                                        <th class="border-0">Invoice</th>
                                        <th class="border-0">Pemesan</th>
                                        <th class="border-0">Tanggal</th>
                                        <th class="border-0">Tipe</th>
                                        <th class="border-0">Pemesan</th>
                                        <th class="border-0">Sub Total</th>
                                        <th class="border-0">
                                            Total Komoditas
                                        </th>
                                        <th
                                            class="border-0 rounded-end"
                                            style="width: 15%"
                                        >
                                            Aksi
                                        </th>
                                    </tr>
                                </thead>
                                <div class="mt-2"></div>
                                <tbody>
                                    <tr
                                        v-for="(order, index) in orders.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (orders.current_page - 1) *
                                                    orders.per_page
                                            }}
                                        </td>
                                        <td>{{ order.invoice_number }}</td>
                                        <td>{{ order.user_id }}</td>
                                        <td>{{ order.date }}</td>
                                        <td>{{ order.type }}</td>
                                        <td>{{ order.status }}</td>
                                        <td>{{ order.sub_total }}</td>
                                        <td>{{ order.total_commodities }}</td>
                                        <td class="text-center">
                                            <button
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                @click="openEditModal(order)"
                                            >
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>
                                            <button
                                                @click.prevent="
                                                    destroy(order.id)
                                                "
                                                class="btn btn-sm btn-danger border-0"
                                            >
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination :links="orders.links" align="end" />
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
        Link,
    },

    props: {
        orders: Object,
        errors: Object,
    },

    setup() {
        //define state search
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        //define method search
        const handleSearch = () => {
            router.get(
                route("orders.index", {
                    q: search.value,
                })
            );
        };

        const destroy = (id) => {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Data supplier akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan!",
                // reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(
                        // `/commodity/categories/${id}`,
                        route("orders.destroy", id),
                        {
                            onSuccess: () => {
                                Swal.fire({
                                    title: "Success!",
                                    text: "Data Supplier Dihapus!.",
                                    icon: "success",
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            },
                            onError: () => {
                                Swal.fire({
                                    title: "Error!",
                                    text: "Data Supplier Dihapus!",
                                    icon: "error",
                                    showConfirmButton: false,
                                    timer: 2000,
                                });
                            },
                        }
                    );
                }
            });
        };

        return {
            search,
            handleSearch,
            destroy,
        };
    },
};
</script>
