<template>
    <div>
        Navigation
        <link
        href="/">
        <link/>
        <div class="px-3">
            <CreateNewDropdown/>
            <div class="py-3">
                <NavLink href="/">My files</NavLink>
                <NavLink href="/">Shared with me</NavLink>
                <NavLink href="/">Shared</NavLink>
                <NavLink href="/">Trash</NavLink>
            </div>

        </div>
    </div>
</template>

<script setup>
import CreateNewDropdown from "@/Components/app/CreateNewdropdown.vue";
import { Link } from "@inertiajs/vue3";
import NavLink from "@/Components//NavLink.vue";

</script>