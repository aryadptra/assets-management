<template>
    <Head title="Purchases" />

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
            <BreadcrumbItem active link="#">Pembelian</BreadcrumbItem>
            <BreadcrumbItem active link="#">Buat</BreadcrumbItem>
        </Breadcrumb>

        <div class="row mt-1">
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <!-- Select the categories -->
                        <div class="row">
                            <!-- <div class="col-md-6">
                                <div class="form-group">
                                    <label for="warehouse">Pilih Gudang</label>
                                    <select
                                        class="form-control"
                                        id="warehouse"
                                        v-model="warehouse"
                                        @change="changeWarehouse"
                                    >
                                        <option
                                            v-for="warehouse in warehouses"
                                            :key="warehouse.id"
                                            :value="warehouse.id"
                                        >
                                            {{ warehouse.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="category">Pilih Kategori</label>
                                    <select
                                        class="form-control"
                                        id="category"
                                        v-model="category"
                                    >
                                        <option value="" selected>
                                            -- Pilih Kategori --
                                        </option>
                                        <option
                                            v-for="category in categories"
                                            :key="category.id"
                                            :value="category.id"
                                            @onchange="filterCategory"
                                        >
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                            </div> -->
                        </div>
                        <!-- Foreach every commodities -->
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Stok</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in commodities"
                                    :key="index"
                                >
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ item.name }}</td>
                                    <td>
                                        {{ formatRupiah(item.selling_price) }}
                                    </td>
                                    <td>{{ item.stock }}</td>
                                    <td>
                                        <!-- Button add item -->
                                        <!-- pengecekan apakah stock >0 ? -->
                                        <!-- <button
                                            type="button"
                                            class="btn btn-primary btn-sm"
                                            @click="addItem(item)"
                                            v-if="item.stock > 0"
                                        > -->
                                        <button
                                            class="btn btn-info btn-sm"
                                            @click="addItem(item)"
                                            v-if="item.stock > 0"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                fill="currentColor"
                                                class="bi bi-plus-square"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"
                                                />
                                                <path
                                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"
                                                />
                                            </svg>
                                        </button>
                                        <!-- Badge stock habis -->
                                        <p class="text-danger" v-else>Habis</p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <!-- Data barang yang ditambahkan -->
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Barang</th>
                                    <th scope="col">Qty</th>
                                    <!-- <th scope="col">Harga</th> -->
                                    <th scope="col">Total</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr
                                    v-for="(item, index) in addedCommodities"
                                    :key="index"
                                >
                                    <th scope="row">{{ index + 1 }}</th>
                                    <td>{{ item.name }}</td>
                                    <td>{{ item.quantity }}</td>
                                    <!-- <td>
                                        {{ formatRupiah(item.selling_price) }}
                                    </td> -->
                                    <td>
                                        {{ formatRupiah(item.total) }}
                                    </td>
                                    <td>
                                        <!-- delete button -->
                                        <button
                                            class="btn btn-danger btn-sm"
                                            @click="deleteItem(item)"
                                        >
                                            <svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                width="16"
                                                height="16"
                                                fill="currentColor"
                                                class="bi bi-dash-lg"
                                                viewBox="0 0 16 16"
                                            >
                                                <path
                                                    fill-rule="evenodd"
                                                    d="M2 8a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11A.5.5 0 0 1 2 8Z"
                                                />
                                            </svg>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Align End Button Process -->
                        <div class="d-flex justify-content-end mt-3">
                            <!-- form -->
                            <form @submit.prevent="submit">
                                <button
                                    class="btn btn-primary btn-sm"
                                    type="submit"
                                >
                                    Proses Beli
                                </button>
                            </form>
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

import { reactive, ref, watch } from "vue";

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
        warehouses: Object,
        categories: Object,
        commodities: Object,
        purchases: Object,
        errors: Object,
    },

    setup() {
        const warehouse = ref(null);
        const category = ref(null);
        let form = ref(null);
        const addedCommodities = ref([]);

        const changeWarehouse = (warehouseId) => {
            category.value = null;
            addedCommodities.value = [];
        };

        const filterCategory = (categoryId) => {
            addedCommodities.value = [];
        };

        // add item
        const addItem = (commodity) => {
            const commodityIndex = addedCommodities.value.findIndex(
                (item) => item.id == commodity.id
            );
            if (commodityIndex == -1) {
                addedCommodities.value.push({
                    id: commodity.id,
                    name: commodity.name,
                    quantity: 1,
                    selling_price: commodity.selling_price,
                    total: commodity.selling_price,
                });
                Swal.fire({
                    title: "Berhasil",
                    text: "Barang berhasil ditambahkan",
                    icon: "success",
                });
            } else {
                // addedCommodities.value[commodityIndex].quantity++;
                // addedCommodities.value[commodityIndex].total =
                //     addedCommodities.value[commodityIndex].quantity *
                //     addedCommodities.value[commodityIndex].selling_price;
                // pengecekan apakah stock <= dari qty
                if (
                    commodity.stock <=
                    addedCommodities.value[commodityIndex].quantity
                ) {
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        text: "Stock tidak cukup",
                    });
                } else {
                    addedCommodities.value[commodityIndex].quantity++;
                    addedCommodities.value[commodityIndex].total =
                        addedCommodities.value[commodityIndex].quantity *
                        addedCommodities.value[commodityIndex].selling_price;
                    Swal.fire({
                        title: "Berhasil",
                        text: "Barang berhasil ditambahkan",
                        icon: "success",
                    });
                }
            }

            form = addedCommodities.value;
        };

        // delete item
        const deleteItem = (item) => {
            const commodityIndex = addedCommodities.value.findIndex(
                (item) => item.id == item.id
            );
            addedCommodities.value.splice(commodityIndex, 1);
            Swal.fire({
                title: "Berhasil",
                text: "Barang berhasil dihapus",
                icon: "success",
            });
        };

        const submit = () => {
            const commodities = addedCommodities.value.map((item) => {
                return {
                    commodity_id: item.id,
                    quantity: item.quantity,
                    total: item.total,
                    unit_price: item.selling_price,
                };
            });

            const totalCommodities = addedCommodities.value.length;
            const sub_total = commodities.reduce((accumulator, commodity) => {
                return accumulator + commodity.total;
            }, 0);

            router.post(
                route("purchases.store"),
                {
                    commodities: commodities,
                    total_commodities: totalCommodities,
                    sub_total: sub_total,
                },
                {
                    onSuccess: () => {
                        Swal.fire({
                            title: "Berhasil",
                            text: "Pesanan berhasil diproses",
                            icon: "success",
                        });
                    },
                },
                {
                    onError: (error) => {
                        Swal.fire({
                            title: "Gagal",
                            text: "Pesanan gagal diproses",
                            icon: "error",
                        });
                    },
                }
            );
        };

        return {
            warehouse,
            category,
            addedCommodities,
            changeWarehouse,
            filterCategory,
            addItem,
            deleteItem,
            submit,
        };
    },
};
</script>
