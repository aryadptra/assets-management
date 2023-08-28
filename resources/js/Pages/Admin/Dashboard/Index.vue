<template>
    <Head>
        <title>Dashboard - Assets Management</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
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
        </Breadcrumb>
        <div class="row"></div>
    </div>
</template>

<script>
//import layout Admin
import LayoutAdmin from "../../../Layouts/Admin.vue";
import Breadcrumb from "../../../Components/Breadcrumb.vue";
import BreadcrumbItem from "../../../Components/BreadcrumbItem.vue";

//import Heade from Inertia
import { Head } from "@inertiajs/vue3";

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
        Breadcrumb,
        BreadcrumbItem,
    },

    //props
    props: {
        students: Number,
        exams: Number,
        exam_sessions: Number,
        classrooms: Number,
    },
};
</script>
