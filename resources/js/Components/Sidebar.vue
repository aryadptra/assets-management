<template>
    <nav
        id="sidebarMenu"
        class="sidebar d-lg-block bg-gray-800 text-white collapse"
        data-simplebar
    >
        <div class="sidebar-inner px-4 pt-3">
            <div
                class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4"
            >
                <div class="collapse-close d-md-none">
                    <a
                        href="#sidebarMenu"
                        data-bs-toggle="collapse"
                        data-bs-target="#sidebarMenu"
                        aria-controls="sidebarMenu"
                        aria-expanded="true"
                        aria-label="Toggle navigation"
                    >
                        <svg
                            class="icon icon-xs"
                            fill="currentColor"
                            viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg"
                        >
                            <path
                                fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"
                            ></path>
                        </svg>
                    </a>
                </div>
            </div>
            <ul class="nav flex-column pt-3 pt-md-0">
                <li class="nav-item">
                    <span class="mt-2 d-flex justify-content-between">
                        <span class="text-center">
                            <span class="sidebar-text text-center fw-bold"
                                >ASSETS MANAGEMENT</span
                            >
                        </span>
                    </span>
                </li>

                <li
                    role="separator"
                    class="dropdown-divider mt-4 mb-3 border-gray-700"
                ></li>

                <li
                    class="nav-item"
                    :class="{
                        active: $page.url.startsWith('/dashboard'),
                    }"
                >
                    <Link
                        :href="route('dashboard')"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    fill="currentColor"
                                    class="bi bi-speedometer2 icon icon-xs me-2"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M8 4a.5.5 0 0 1 .5.5V6a.5.5 0 0 1-1 0V4.5A.5.5 0 0 1 8 4zM3.732 5.732a.5.5 0 0 1 .707 0l.915.914a.5.5 0 1 1-.708.708l-.914-.915a.5.5 0 0 1 0-.707zM2 10a.5.5 0 0 1 .5-.5h1.586a.5.5 0 0 1 0 1H2.5A.5.5 0 0 1 2 10zm9.5 0a.5.5 0 0 1 .5-.5h1.5a.5.5 0 0 1 0 1H12a.5.5 0 0 1-.5-.5zm.754-4.246a.389.389 0 0 0-.527-.02L7.547 9.31a.91.91 0 1 0 1.302 1.258l3.434-4.297a.389.389 0 0 0-.029-.518z"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        d="M0 10a8 8 0 1 1 15.547 2.661c-.442 1.253-1.845 1.602-2.932 1.25C11.309 13.488 9.475 13 8 13c-1.474 0-3.31.488-4.615.911-1.087.352-2.49.003-2.932-1.25A7.988 7.988 0 0 1 0 10zm8-7a7 7 0 0 0-6.603 9.329c.203.575.923.876 1.68.63C4.397 12.533 6.358 12 8 12s3.604.532 4.923.96c.757.245 1.477-.056 1.68-.631A7 7 0 0 0 8 3z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Dashboard</span>
                        </span>
                    </Link>
                </li>

                <li
                    role="separator"
                    class="dropdown-divider mt-2 mb-2 border-gray-700"
                ></li>

                <li
                    class="nav-item"
                    :class="{ active: $page.url.startsWith('/warehouses') }"
                >
                    <Link
                        href="/warehouses"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <!-- Icon Warehouse -->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="18"
                                    height="18"
                                    fill="currentColor"
                                    class="bi bi-house-door icon icon-xs me-2"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M8 1.5a.5.5 0 0 1 .5.5v1.5a.5.5 0 0 1-.5.5H2.5v9h11v-9H8.5a.5.5 0 0 1-.5-.5V2a.5.5 0 0 1 .5-.5zm.5 2.5h4.793L8.5 4.854V4z"
                                    />
                                    <path
                                        fill-rule="evenodd"
                                        d="M13.5 14h-11a.5.5 0 0 1-.5-.5V6.707l6-6L14 6.293V13.5a.5.5 0 0 1-.5.5zM2 5.207V13.5h11V5.207L8.854 2.354a.5.5 0 0 0-.708 0L2 5.207z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Gudang</span>
                        </span>
                    </Link>
                </li>
            </ul>
        </div>
    </nav>
</template>

<script>
//import Link
import { Link } from "@inertiajs/vue3";

export default {
    //register components
    components: {
        Link,
    },
};
</script>

<style></style>
