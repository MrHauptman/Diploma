<template>
    <div>
        Navigation
        <link
        href="/">
        <link/>
        <div class="px-3">
            <CreateNewDropdown/>
            <div class="py-3">
                <NavLink href="/">Мои файлы</NavLink>
                <NavLink href="/">Полученные</NavLink>
                <NavLink href="/">Отправленные</NavLink>
                <NavLink href="/">Корзина</NavLink>
            </div>

        </div>
    </div>
</template>

<script setup>
import CreateNewDropdown from "@/Components/app/CreateNewdropdown.vue";
import { Link } from "@inertiajs/vue3";
import NavLink from "@/Components//NavLink.vue";

</script>