<template>
    <Head title="Warehouses" />
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
            <BreadcrumbItem active link="#">Gudang</BreadcrumbItem>
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
                                    placeholder="masukkan nama gudang dan enter..."
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
                                        <th class="border-0">Nama Gudang</th>
                                        <th class="border-0">Wilayah</th>
                                        <th class="border-0">PIC</th>
                                        <th class="border-0">No. HP</th>
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
                                            warehouse, index
                                        ) in warehouses.data"
                                        :key="index"
                                    >
                                        <td class="fw-bold text-center">
                                            {{
                                                ++index +
                                                (warehouses.current_page - 1) *
                                                    warehouses.per_page
                                            }}
                                        </td>
                                        <td>{{ warehouse.name }}</td>
                                        <td>{{ warehouse.address }}</td>
                                        <td>{{ warehouse.pic }}</td>
                                        <td>{{ warehouse.phone }}</td>
                                        <td class="text-center">
                                            <button
                                                class="btn btn-sm btn-info border-0 shadow me-2"
                                                type="button"
                                                @click="
                                                    openEditModal(warehouse)
                                                "
                                            >
                                                <i class="fa fa-pencil-alt"></i>
                                            </button>
                                            <button
                                                @click.prevent="
                                                    destroy(warehouse.id)
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
                        <Pagination :links="warehouses.links" align="end" />
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div
                class="col-6 col-md-3"
                v-for="(warehouse, index) in warehouses.data"
                :key="index"
            >
                <div class="card border-0 shadow">
                    <div class="card-body">
                        <div class="row d-block d-xl-flex align-items-center">
                            <div
                                class="col-12 col-xl-5 text-xl-center mb-3 mb-xl-0 d-flex align-items-center justify-content-xl-center"
                            >
                                <div
                                    class="icon-shape icon-shape-tertiary rounded me-4 me-sm-0"
                                >
                                    <svg
                                        class="icon"
                                        fill="currentColor"
                                        viewBox="0 0 20 20"
                                        xmlns="http://www.w3.org/2000/svg"
                                    >
                                        <path
                                            fill-rule="evenodd"
                                            d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd"
                                        ></path>
                                    </svg>
                                </div>
                                <div class="d-sm-none">
                                    <h2 class="fw-extrabold h5">Gudang</h2>
                                    <h3 class="mb-1">{{ warehouse.name }}</h3>
                                </div>
                            </div>
                            <div class="col-12 col-xl-7 px-xl-0">
                                <div class="d-none d-sm-block">
                                    <h2 class="h6 text-gray-400 mb-0">
                                        Gudang
                                    </h2>
                                    <h3 class="fw-extrabold mb-2">
                                        {{ warehouse.name }}
                                    </h3>
                                </div>
                                <!-- <small class="text-gray-500">{{ warehouse.barangCount }} Barang</small> -->
                                <div class="small d-flex mt-1">
                                    <div>{{ warehouse.address }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Create -->
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
                        <h2 class="h6 modal-title">Tambah Data Gudang</h2>
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
                                <label for="name">Nama Gudang</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    name="name"
                                    id="name"
                                    placeholder="Masukkan nama gudang"
                                    v-model="form.name"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.address"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.address }}
                                </div>
                                <label for="address">Alamat</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="address"
                                    name="address"
                                    placeholder="Masukkan alamat gudang"
                                    v-model="form.address"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.pic"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.pic }}
                                </div>
                                <label for="pic">PIC</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="pic"
                                    name="pic"
                                    placeholder="Masukkan nama PIC"
                                    v-model="form.pic"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.phone"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.phone }}
                                </div>
                                <label for="phone">No. HP</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone"
                                    name="phone"
                                    placeholder="Masukkan no. HP PIC"
                                    v-model="form.phone"
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
                        <h2 class="h6 modal-title">Edit Data Gudang</h2>
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
                                <label for="name">Nama Gudang</label>
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
                                    v-if="errors.address"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.address }}
                                </div>
                                <label for="address">Alamat</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="address"
                                    name="address"
                                    v-model="editModalData.address"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.pic"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.pic }}
                                </div>
                                <label for="pic">PIC</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="pic"
                                    name="pic"
                                    v-model="editModalData.pic"
                                />
                            </div>
                            <div class="mb-4">
                                <div
                                    v-if="errors.nohp"
                                    class="alert alert-danger mt-2"
                                >
                                    {{ errors.nohp }}
                                </div>
                                <label for="phone">No. HP</label>
                                <input
                                    type="text"
                                    class="form-control"
                                    id="phone"
                                    name="phone"
                                    v-model="editModalData.phone"
                                />
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
    layout: Admin,
    components: {
        Head,
        Breadcrumb,
        BreadcrumbItem,
        Link,
        Pagination,
    },

    props: {
        warehouses: Object,
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
            address: "",
            pic: "",
            phone: "",
        });

        //method "submit"
        const submit = () => {
            // disable btn-save menggunakan js
            document.getElementById("btn-save").disabled = true;
            // set btn-save menjadi loading
            document.getElementById("btn-save").innerHTML =
                '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
            //send data to server
            router.post(
                "/warehouses",
                {
                    //data
                    name: form.name,
                    address: form.address,
                    pic: form.pic,
                    phone: form.phone,
                },
                {
                    onSuccess: () => {
                        //reset form
                        form.name = "";
                        form.address = "";
                        form.pic = "";
                        form.phone = "";

                        // enable btn-save menggunakan js
                        document.getElementById("btn-save").disabled = false;
                        // hapus loading pada btn-save
                        document.getElementById("btn-save").innerHTML =
                            "Simpan";
                        //close modal menggunakan js
                        document.getElementById("modal-default").click();

                        Swal.fire({
                            title: "Success!",
                            text: "Data Gudang Disimpan!.",
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

        //define method search
        const handleSearch = () => {
            router.get("/warehouses", {
                q: search.value,
            });
        };

        const editModalData = reactive({
            id: "",
            name: "",
            address: "",
            pic: "",
            phone: "",
        });

        const openEditModal = (warehouse) => {
            // set data to editModalData
            editModalData.id = warehouse.id;
            editModalData.name = warehouse.name;
            editModalData.address = warehouse.address;
            editModalData.pic = warehouse.pic;
            editModalData.phone = warehouse.phone;

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
                `/warehouses/${editModalData.id}`,
                {
                    //data
                    name: editModalData.name,
                    address: editModalData.address,
                    pic: editModalData.pic,
                    phone: editModalData.phone,
                },
                {
                    onSuccess: () => {
                        //reset form
                        editModalData.name = "";
                        editModalData.address = "";
                        editModalData.pic = "";
                        editModalData.phone = "";

                        document.getElementById(
                            "btn-save-edit"
                        ).disabled = false;

                        //close modal menggunakan js
                        document.getElementById("modal-edit").click();

                        Swal.fire({
                            title: "Success!",
                            text: "Data Gudang Diubah!.",
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
                            text: "Data Gudang Gagal Diubah!",
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
                text: "Data Gudang akan dihapus!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "Ya, hapus!",
                cancelButtonText: "Tidak, batalkan!",
                // reverseButtons: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    router.delete(`/warehouses/${id}`, {
                        onSuccess: () => {
                            Swal.fire({
                                title: "Success!",
                                text: "Data Gudang Dihapus!.",
                                icon: "success",
                                showConfirmButton: false,
                                timer: 2000,
                            });
                        },
                        onError: () => {
                            Swal.fire({
                                title: "Error!",
                                text: "Data Gudang Gagal Dihapus!",
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
            handleSearch,
            form,
            submit,
            editModalData,
            openEditModal,
            submitEdit,
            destroy,
        };
    },
};
</script>
