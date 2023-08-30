<template>
    <Head title="Kategori Komoditas" />

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
            <BreadcrumbItem active link="#">Komoditas</BreadcrumbItem>
        </Breadcrumb>

        <div class="row">
            <div class="col-md-8">
                <div class="row">
                    <div class="col-md-3 col-12 mb-2">
                        <button
                            type="button"
                            class="btn btn-md btn-primary border-0 shadow w-100"
                            data-bs-toggle="modal"
                            data-bs-target="#modal-default"
                        >
                            <i class="fa fa-plus-circle"></i> Tambah
                        </button>
                    </div>
                    <div class="col-md-9 col-12 mb-2">
                        <form @submit.prevent="handleSearch">
                            <div class="input-group">
                                <input
                                    type="text"
                                    class="form-control border-0 shadow"
                                    v-model="search"
                                    placeholder="masukkan nama komoditas dan enter..."
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
                                        <th class="border-0">Kode</th>
                                        <th class="border-0">Kategori</th>
                                        <th class="border-0">Nama</th>
                                        <th class="border-0">Deskripsi</th>
                                        <th class="border-0">Stok</th>
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
                                        v-for="(
                                            commodity, index
                                        ) in commodities.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (commodities.current_page - 1) *
                                                    commodities.per_page
                                            }}
                                        </td>
                                        <td>{{ commodity.code }}</td>
                                        <td>{{ commodity.category.name }}</td>
                                        <td>{{ commodity.name }}</td>
                                        <td>{{ commodity.description }}</td>
                                        <td>{{ commodity.stock }}</td>
                                        <td class="text-center">
                                            <button
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                @click="
                                                    openEditModal(commodity)
                                                "
                                            >
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>
                                            <button
                                                @click.prevent="
                                                    destroy(commodity.id)
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
                        <Pagination :links="commodities.links" align="end" />
                    </div>
                </div>
            </div>
        </div>

        <div
            class="modal fade"
            id="modal-default"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modal-default"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="h6 modal-title">Tambah Data Komoditas</h2>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form @submit.prevent="submit">
                        <div class="modal-body">
                            <div class="mb-4">
                                <div
                                    v-if="errors.warehouse_id"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.warehouse_id }}
                                </div>
                                <label for="warehouse_id">Gudang</label>
                                <select
                                    class="form-select"
                                    name="warehouse_id"
                                    id="warehouse_id"
                                    v-model="form.warehouse_id"
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
                            <div class="mb-4">
                                <div
                                    v-if="errors.category_id"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.category_id }}
                                </div>
                                <label for="category_id">Kategori</label>
                                <select
                                    class="form-select"
                                    name="category_id"
                                    id="category_id"
                                    v-model="form.category_id"
                                >
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.code"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.code }}
                                </div>
                                <label for="code">Kode</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="code"
                                    name="code"
                                    placeholder="Masukkan kode komoditas"
                                    v-model="form.code"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.name"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.name }}
                                </div>
                                <label for="name">Nama Komoditas</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    placeholder="Masukkan nama komoditas"
                                    v-model="form.name"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.description"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.description }}
                                </div>
                                <label for="description">Deskripsi</label>
                                <textarea
                                    class="form-control"
                                    name="description"
                                    id="description"
                                    rows="3"
                                    placeholder="Masukkan deskripsi komoditas"
                                    v-model="form.description"
                                ></textarea>
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.stock"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.stock }}
                                </div>
                                <label for="stock">Stok</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="stock"
                                    id="stock"
                                    placeholder="Masukkan stok komoditas"
                                    v-model="form.stock"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="submit"
                                id="btn-save"
                                class="btn btn-secondary"
                            >
                                Simpan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div
            class="modal fade"
            id="modal-edit"
            tabindex="-1"
            role="dialog"
            aria-labelledby="modal-edit"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="h6 modal-title">Ubah Data Komoditas</h2>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <form @submit.prevent="submitEdit">
                        <div class="modal-body">
                            <div class="mb-4">
                                <div
                                    v-if="errors.warehouse_id"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.warehouse_id }}
                                </div>
                                <label for="warehouse_id">Gudang</label>
                                <select
                                    class="form-select"
                                    name="warehouse_id"
                                    id="warehouse_id"
                                    v-model="editModalData.warehouse_id"
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
                            <div class="mb-4">
                                <div
                                    v-if="errors.category_id"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.category_id }}
                                </div>
                                <label for="category_id">Kategori</label>
                                <select
                                    class="form-select"
                                    name="category_id"
                                    id="category_id"
                                    v-model="editModalData.category_id"
                                >
                                    <option
                                        v-for="category in categories"
                                        :key="category.id"
                                        :value="category.id"
                                    >
                                        {{ category.name }}
                                    </option>
                                </select>
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.code"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.code }}
                                </div>
                                <label for="code">Kode</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="code"
                                    name="code"
                                    placeholder="Masukkan kode komoditas"
                                    v-model="editModalData.code"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.name"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.name }}
                                </div>
                                <label for="name">Nama Komoditas</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    placeholder="Masukkan nama komoditas"
                                    v-model="editModalData.name"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.description"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.description }}
                                </div>
                                <label for="description">Deskripsi</label>
                                <textarea
                                    class="form-control"
                                    name="description"
                                    id="description"
                                    rows="3"
                                    placeholder="Masukkan deskripsi komoditas"
                                    v-model="editModalData.description"
                                ></textarea>
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.stock"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.stock }}
                                </div>
                                <label for="stock">Stok</label>
                                <input
                                    type="number"
                                    class="form-control"
                                    name="stock"
                                    id="stock"
                                    placeholder="Masukkan stok komoditas"
                                    v-model="editModalData.stock"
                                />
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="submit"
                                id="btn-save-edit"
                                class="btn btn-secondary"
                            >
                                Ubah
                            </button>
                        </div>
                    </form>
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

import { ref, reactive } from "vue";

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
        commodities: Object,
        warehouses: Object,
        categories: Object,
        errors: Object,
    },

    setup() {
        //define state search
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        //define state form with reactive
        const form = reactive({
            warehouse_id: "",
            category_id: "",
            code: "",
            name: "",
            description: "",
            stock: "",
        });

        //define method search
        const handleSearch = () => {
            router.get("/commodities", {
                q: search.value,
            });
        };

        //define method submit
        const submit = () => {
            // disable btn-save menggunakan js
            document.getElementById("btn-save").disabled = true;
            // set btn-save menjadi loading
            document.getElementById("btn-save").innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            //send data to server
            router.post(
                "/commodities",
                {
                    //data
                    warehouse_id: form.warehouse_id,
                    category_id: form.category_id,
                    code: form.code,
                    name: form.name,
                    description: form.description,
                    stock: form.stock,
                },
                {
                    onSuccess: () => {
                        //reset form
                        form.warehouse_id = "";
                        form.category_id = "";
                        form.name = "";
                        form.code = "";
                        form.description = "";
                        form.stock = "";

                        // enable btn-save menggunakan js
                        document.getElementById("btn-save").disabled = false;
                        // hapus loading pada btn-save
                        document.getElementById("btn-save").innerHTML =
                            "Simpan";
                        //close modal menggunakan js
                        document.getElementById("modal-default").click();

                        Swal.fire({
                            title: "Success!",
                            text: "Data Komoditas Disimpan!.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                    onError: () => {
                        // enable btn-save menggunakan js
                        document.getElementById("btn-save").disabled = false;
                        // set btn-save menjadi simpan
                        document.getElementById("btn-save").innerHTML =
                            "Simpan";
                    },
                }
            );
        };

        const editModalData = reactive({
            id: "",
            warehouse_id: "",
            category_id: "",
            code: "",
            name: "",
            description: "",
            stock: "",
        });

        const openEditModal = (commodities) => {
            // set data to editModalData
            editModalData.id = commodities.id;
            editModalData.warehouse_id = commodities.warehouse_id;
            editModalData.category_id = commodities.category_id;
            editModalData.code = commodities.code;
            editModalData.name = commodities.name;
            editModalData.description = commodities.description;
            editModalData.stock = commodities.stock;

            // Open the edit modal
            const editModal = new bootstrap.Modal(
                document.getElementById("modal-edit")
            );
            editModal.show();
        };

        const submitEdit = () => {
            // disable btn-save-edit menggunakan js
            document.getElementById("btn-save-edit").disabled = true;
            // set btn-save-edit menjadi loading
            document.getElementById("btn-save-edit").innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            //send data to server
            router.put(
                `/commodities/${editModalData.id}`,
                {
                    //data
                    warehouse_id: editModalData.warehouse_id,
                    category_id: editModalData.category_id,
                    code: editModalData.code,
                    name: editModalData.name,
                    description: editModalData.description,
                    stock: editModalData.stock,
                },
                {
                    onSuccess: () => {
                        //reset form
                        editModalData.warehouse_id = "";
                        editModalData.category_id = "";
                        editModalData.code = "";
                        editModalData.name = "";
                        editModalData.description = "";
                        editModalData.stock = "";

                        document.getElementById(
                            "btn-save-edit"
                        ).disabled = false;

                        //close modal menggunakan js
                        document.getElementById("modal-edit").click();

                        Swal.fire({
                            title: "Success!",
                            text: "Data Komoditas Diubah!.",
                            icon: "success",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                    onError: () => {
                        // enable btn-save-edit menggunakan js
                        document.getElementById(
                            "btn-save-edit"
                        ).disabled = false;
                        // set btn-save-edit menjadi simpan
                        document.getElementById("btn-save-edit").innerHTML =
                            "Simpan";

                        Swal.fire({
                            title: "Error!",
                            text: "Data Komoditas Gagal Diubah!",
                            icon: "error",
                            showConfirmButton: false,
                            timer: 2000,
                        });
                    },
                }
            );
        };

        const destroy = (id) => {
            Swal.fire({
                title: "Apakah kamu yakin?",
                text: "Data komoditas akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan!",
                // reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(`/commodities/${id}`, {
                        onSuccess: () => {
                            Swal.fire({
                                title: "Success!",
                                text: "Data Komoditas Dihapus!.",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        },
                        onError: () => {
                            Swal.fire({
                                title: "Error!",
                                text: "Data Komoditas Gagal Dihapus!",
                                icon: "error",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        },
                    });
                }
            });
        };

        return {
            search,
            form,
            handleSearch,
            submit,
            editModalData,
            openEditModal,
            submitEdit,
            destroy,
        };
    },
};
</script>
