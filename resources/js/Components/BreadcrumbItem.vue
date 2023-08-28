<template>
    <li
        :class="{
            'breadcrumb-item': !active,
            'breadcrumb-item active': active,
        }"
    >
        <a v-if="!active" :href="link">
            <slot></slot>
        </a>
        <span v-else>
            <slot></slot>
        </span>
    </li>
</template>

<script>
export default {
    props: {
        active: Boolean,
        link: String,
    },
};
</script>
