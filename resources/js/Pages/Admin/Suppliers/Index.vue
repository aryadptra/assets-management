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
            <BreadcrumbItem active link="#">Supplier</BreadcrumbItem>
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
                                    placeholder="masukkan nama supplier dan enter..."
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
                                        <th class="border-0">Nama</th>
                                        <th class="border-0">Email</th>
                                        <th class="border-0">No. Handphone</th>
                                        <th class="border-0">Alamat</th>
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
                                            supplier, index
                                        ) in suppliers.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (suppliers.current_page - 1) *
                                                    suppliers.per_page
                                            }}
                                        </td>
                                        <td>{{ supplier.name }}</td>
                                        <td>{{ supplier.email }}</td>
                                        <td>{{ supplier.phone }}</td>
                                        <td>{{ supplier.address }}</td>
                                        <td class="text-center">
                                            <button
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                @click="openEditModal(supplier)"
                                            >
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>
                                            <button
                                                @click.prevent="
                                                    destroy(supplier.id)
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
                        <Pagination :links="suppliers.links" align="end" />
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
                        <h2 class="h6 modal-title">Tambah Data Supplier</h2>
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
                                    v-if="errors.name"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.name }}
                                </div>
                                <label for="name">Nama Supplier</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    placeholder="Masukkan nama supplier"
                                    v-model="form.name"
                                />
                            </div>

                            <div class="mb-4">
                                <div
                                    v-if="errors.email"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.email }}
                                </div>
                                <label for="email">Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="code"
                                    name="code"
                                    placeholder="Masukkan alamat email"
                                    v-model="form.email"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.phone"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.phone }}
                                </div>
                                <label for="code">No. Handphone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="code"
                                    name="code"
                                    placeholder="Masukkan nomor handphone"
                                    v-model="form.phone"
                                />
                            </div>
                            <!-- Address with text area-->
                            <div class="mb-4">
                                <div
                                    v-if="errors.address"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.address }}
                                </div>
                                <label for="code">Alamat</label>
                                <textarea
                                    class="form-control"
                                    id="code"
                                    name="code"
                                    placeholder="Masukkan alamat"
                                    v-model="form.address"
                                ></textarea>
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
                        <h2 class="h6 modal-title">Edit Data Supplier</h2>
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
                                    v-if="errors.name"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.name }}
                                </div>
                                <label for="name">Nama Supplier</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    v-model="editModalData.name"
                                />
                            </div>

                            <div class="mb-4">
                                <div
                                    v-if="errors.email"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.email }}
                                </div>
                                <label for="email">Email</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="email"
                                    name="email"
                                    v-model="editModalData.email"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.phone"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.phone }}
                                </div>
                                <label for="phone">No. Handphone</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    v-model="editModalData.phone"
                                />
                            </div>
                            <!-- Address with text area-->
                            <div class="mb-4">
                                <div
                                    v-if="errors.address"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.address }}
                                </div>
                                <label for="code">Alamat</label>
                                <textarea
                                    class="form-control"
                                    id="code"
                                    name="code"
                                    v-model="editModalData.address"
                                ></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="submit"
                                id="btn-save-edit"
                                class="btn btn-secondary"
                            >
                                Simpan
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
        suppliers: Object,
        errors: Object,
    },

    setup() {
        //define state search
        const search = ref(
            "" || new URL(document.location).searchParams.get("q")
        );

        //define state form with reactive
        const form = reactive({
            name: "",
            email: "",
            phone: "",
            address: "",
        });

        //define method search
        const handleSearch = () => {
            router.get(
                route("suppliers.index", {
                    q: search.value,
                })
            );
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
                route("suppliers.store"),
                {
                    //data
                    name: form.name,
                    email: form.email,
                    phone: form.phone,
                    address: form.address,
                },
                {
                    onSuccess: () => {
                        //reset form
                        form.name = "";
                        form.email = "";
                        form.phone = "";
                        form.address = "";

                        // enable btn-save menggunakan js
                        document.getElementById("btn-save").disabled = false;
                        // hapus loading pada btn-save
                        document.getElementById("btn-save").innerHTML =
                            "Simpan";
                        //close modal menggunakan js
                        document.getElementById("modal-default").click();

                        Swal.fire({
                            title: "Success!",
                            text: "Data Suplier Disimpan!.",
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
            name: "",
            email: "",
            phone: "",
            address: "",
        });

        const openEditModal = (category) => {
            // set data to editModalData
            editModalData.id = category.id;
            editModalData.name = category.name;
            editModalData.email = category.email;
            editModalData.phone = category.phone;
            editModalData.address = category.address;

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
                // `/commodity/categories/${editModalData.id}`,
                route("suppliers.update", editModalData.id),
                {
                    //data
                    name: editModalData.name,
                    email: editModalData.email,
                    phone: editModalData.phone,
                    address: editModalData.address,
                },
                {
                    onSuccess: () => {
                        //reset form
                        editModalData.name = "";
                        editModalData.email = "";
                        editModalData.phone = "";
                        editModalData.address = "";

                        // enable btn-save-edit menggunakan js
                        document.getElementById(
                            "btn-save-edit"
                        ).disabled = false;
                        // set btn-save-edit menjadi simpan
                        document.getElementById("btn-save-edit").innerHTML =
                            "Simpan";

                        //close modal menggunakan js
                        document.getElementById("modal-edit").click();

                        Swal.fire({
                            title: "Success!",
                            text: "Data Supplier Diubah!.",
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
                            text: "Data Supplier Gagal Diubah!",
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
                        route("suppliers.destroy", id),
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
