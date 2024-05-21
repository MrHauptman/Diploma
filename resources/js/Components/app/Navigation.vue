<template>
    <nav class="min-w-[200px]">
        <Link :href="route('myFiles')" class="h-[80px] px-3 flex items-center gap-3">
            <ApplicationLogo
                class="block h-9 w-auto fill-current text-gray-800"
            />
            
        </Link>
            <CreateNewDropdown/>
            <div class="py-3">
                <NavLink :href = "route('myFiles')" :active="$page.url === '/my-files'">Мои файлы</NavLink>
                <NavLink :href="route('file.sharedWithMe')" :active="$page.props.route_name === 'file.sharedWithMe'">Полученные</NavLink>
                <NavLink :href="route('file.sharedByMe')" :active="$page.props.route_name === 'file.sharedByMe'">Отправленные</NavLink>
                <NavLink :href="route('trash')" :active="$page.props.route_name === 'trash'">Корзина</NavLink>
            </div>
    </nav>
</template>

<script setup>
import CreateNewDropdown from "@/Components/app/CreateNewdropdown.vue";
import { Link } from "@inertiajs/vue3";
import NavLink from "@/Components//NavLink.vue";
import ApplicationLogo from "../ApplicationLogo.vue";

</script>
