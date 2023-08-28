<!-- <script setup>
import Checkbox from '@/Components/Checkbox.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import InputError from '@/Components/InputError.vue';
import InputLabel from '@/Components/InputLabel.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import TextInput from '@/Components/TextInput.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';

defineProps({
    canResetPassword: {
        type: Boolean,
    },
    status: {
        type: String,
    },
});

const form = useForm({
    email: '',
    password: '',
    remember: false,
});

const submit = () => {
    form.post(route('login'), {
        onFinish: () => form.reset('password'),
    });
};
</script>

<template>
    <GuestLayout>
        <Head title="Log in" />

        <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
            {{ status }}
        </div>

        <form @submit.prevent="submit">
            <div>
                <InputLabel for="email" value="Email" />

                <TextInput
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    required
                    autofocus
                    autocomplete="username"
                />

                <InputError class="mt-2" :message="form.errors.email" />
            </div>

            <div class="mt-4">
                <InputLabel for="password" value="Password" />

                <TextInput
                    id="password"
                    type="password"
                    class="mt-1 block w-full"
                    v-model="form.password"
                    required
                    autocomplete="current-password"
                />

                <InputError class="mt-2" :message="form.errors.password" />
            </div>

            <div class="block mt-4">
                <label class="flex items-center">
                    <Checkbox name="remember" v-model:checked="form.remember" />
                    <span class="ml-2 text-sm text-gray-600">Remember me</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Link
                    v-if="canResetPassword"
                    :href="route('password.request')"
                    class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                >
                    Forgot your password?
                </Link>

                <PrimaryButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </PrimaryButton>
            </div>
        </form>
    </GuestLayout>
</template> -->

<template>
    <Head>
        <title>Login Administrator - Aplikasi Ujian Online</title>
    </Head>
    <div
        class="bg-white shadow border-0 rounded border-light p-4 p-lg-5 w-100 fmxw-500"
    >
        <div class="text-center text-md-center mb-4 mt-md-0">
            <h3>ADMINISTRATOR</h3>
        </div>
        <form @submit.prevent="submit" class="mt-4">
            <div class="form-group mb-4">
                <label for="email">Email Address</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon1">
                        <i class="fa fa-envelope"></i>
                    </span>
                    <input
                        type="email"
                        class="form-control"
                        v-model="form.email"
                        placeholder="Email Address"
                    />
                </div>
                <div v-if="errors.email" class="alert alert-danger mt-2">
                    {{ errors.email }}
                </div>
            </div>

            <div class="form-group">
                <div class="form-group mb-4">
                    <label for="password">Password</label>
                    <div class="input-group">
                        <span class="input-group-text" id="basic-addon2">
                            <i class="fa fa-lock"></i>
                        </span>
                        <input
                            type="password"
                            placeholder="Password"
                            class="form-control"
                            v-model="form.password"
                        />
                    </div>
                    <div v-if="errors.password" class="alert alert-danger mt-2">
                        {{ errors.password }}
                    </div>
                </div>

                <div
                    class="d-flex justify-content-between align-items-top mb-4"
                >
                    <div class="form-check">
                        <input
                            class="form-check-input"
                            type="checkbox"
                            value=""
                            id="remember"
                        />
                        <label class="form-check-label mb-0" for="remember">
                            Remember me
                        </label>
                    </div>
                </div>
            </div>
            <div class="d-grid">
                <button type="submit" class="btn btn-gray-800">LOGIN</button>
            </div>
        </form>
    </div>
</template>

<script>
//import layout
import LayoutAuth from "../../Layouts/Auth.vue";

//import reactive
import { reactive } from "vue";
//import router
import { router, Head } from "@inertiajs/vue3";


export default {
    //layout
    layout: LayoutAuth,

    //register component
    components: {
        Head,
    },

    //props
    props: {
        errors: Object,
        session: Object,
    },

    //define composition API
    setup() {
        //define form state
        const form = reactive({
            email: "",
            password: "",
        });

        //submit method
        const submit = () => {
            //send data to server
            router.post("/login", {
                //data
                email: form.email,
                password: form.password,
            });
        };

        //return form state and submit method
        return {
            form,
            submit,
        };
    },
};
</script>
