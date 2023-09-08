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
                    <span class="mt-2">
                        <span class="text-center">
                            <span class="sidebar-text text-center fw-bold"
                                >ASSETS MANAGEMENT APP</span
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
                        :href="route('warehouses.index')"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <!-- Icon Warehouse -->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-house-gear-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M7.293 1.5a1 1 0 0 1 1.414 0L11 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l2.354 2.353a.5.5 0 0 1-.708.708L8 2.207 1.354 8.854a.5.5 0 1 1-.708-.708L7.293 1.5Z"
                                    />
                                    <path
                                        d="M11.07 9.047a1.5 1.5 0 0 0-1.742.26l-.02.021a1.5 1.5 0 0 0-.261 1.742 1.5 1.5 0 0 0 0 2.86 1.504 1.504 0 0 0-.12 1.07H3.5A1.5 1.5 0 0 1 2 13.5V9.293l6-6 4.724 4.724a1.5 1.5 0 0 0-1.654 1.03Z"
                                    />
                                    <path
                                        d="m13.158 9.608-.043-.148c-.181-.613-1.049-.613-1.23 0l-.043.148a.64.64 0 0 1-.921.382l-.136-.074c-.561-.306-1.175.308-.87.869l.075.136a.64.64 0 0 1-.382.92l-.148.045c-.613.18-.613 1.048 0 1.229l.148.043a.64.64 0 0 1 .382.921l-.074.136c-.306.561.308 1.175.869.87l.136-.075a.64.64 0 0 1 .92.382l.045.149c.18.612 1.048.612 1.229 0l.043-.15a.64.64 0 0 1 .921-.38l.136.074c.561.305 1.175-.309.87-.87l-.075-.136a.64.64 0 0 1 .382-.92l.149-.044c.612-.181.612-1.049 0-1.23l-.15-.043a.64.64 0 0 1-.38-.921l.074-.136c.305-.561-.309-1.175-.87-.87l-.136.075a.64.64 0 0 1-.92-.382ZM12.5 14a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Gudang</span>
                        </span>
                    </Link>
                </li>

                <li
                    class="nav-item"
                    :class="{ active: $page.url.startsWith('/suppliers') }"
                >
                    <Link
                        :href="route('suppliers.index')"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <!-- Icon Suppliers --><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-houses"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M5.793 1a1 1 0 0 1 1.414 0l.647.646a.5.5 0 1 1-.708.708L6.5 1.707 2 6.207V12.5a.5.5 0 0 0 .5.5.5.5 0 0 1 0 1A1.5 1.5 0 0 1 1 12.5V7.207l-.146.147a.5.5 0 0 1-.708-.708L5.793 1Zm3 1a1 1 0 0 1 1.414 0L12 3.793V2.5a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v3.293l1.854 1.853a.5.5 0 0 1-.708.708L15 8.207V13.5a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 4 13.5V8.207l-.146.147a.5.5 0 1 1-.708-.708L8.793 2Zm.707.707L5 7.207V13.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5V7.207l-4.5-4.5Z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Supplier</span>
                        </span>
                    </Link>
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: $page.url.startsWith('/commodity/categories'),
                    }"
                >
                    <Link
                        :href="route('categories.index')"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <!-- Icon categories -->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-tags-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586V2zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3z"
                                    />
                                    <path
                                        d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043-7.457-7.457z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Kategori Komoditas</span>
                        </span>
                    </Link>
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: $page.url.startsWith('/commodities'),
                    }"
                >
                    <Link
                        :href="route('commodities.index')"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <!-- Icon Commodity -->
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-box-seam-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003 6.97 2.789ZM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461L10.404 2Z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Komoditas</span>
                        </span>
                    </Link>
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: $page.url.startsWith('/orders'),
                    }"
                >
                    <Link
                        :href="route('orders.index')"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <!-- Icon Orders --><svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-cart4"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5zM3.14 5l.5 2H5V5H3.14zM6 5v2h2V5H6zm3 0v2h2V5H9zm3 0v2h1.36l.5-2H12zm1.11 3H12v2h.61l.5-2zM11 8H9v2h2V8zM8 8H6v2h2V8zM5 8H3.89l.5 2H5V8zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0zm9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2zm-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Pesanan</span>
                        </span>
                    </Link>
                </li>

                <li
                    class="nav-item"
                    :class="{
                        active: $page.url.startsWith('/purchases'),
                    }"
                >
                    <Link
                        :href="route('purchases.index')"
                        class="nav-link d-flex justify-content-between"
                    >
                        <span>
                            <span class="sidebar-icon">
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    width="16"
                                    height="16"
                                    fill="currentColor"
                                    class="bi bi-bag-check-fill"
                                    viewBox="0 0 16 16"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5v-.5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0zm-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0l3-3z"
                                    />
                                </svg>
                            </span>
                            <span class="sidebar-text">Pembelian</span>
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
