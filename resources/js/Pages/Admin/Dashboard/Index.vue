<template>
    <Head>
        <title>Dashboard - Aplikasi Ujian Online</title>
    </Head>
    <div class="container-fluid mb-5 mt-5">
        <div class="row"></div>
    </div>
</template>

<script>
//import layout Admin
import LayoutAdmin from "../../../Layouts/Admin.vue";

//import Heade from Inertia
import { Head } from "@inertiajs/vue3";

export default {
    //layout
    layout: LayoutAdmin,

    //register components
    components: {
        Head,
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

<style></style>
