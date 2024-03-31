<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-blue-500 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-white">You're logged in "Пока только примерно расположил кнопки, скачал все нужные библиотеки, сначала установил ларавель 11 версии оказалось на него нет библиотеки Kelnoy/nestedset нужной версии, был конфликт с illuminate/support, потом настраивал мускл сервер, потом вспомнил как там на vue.js всё пишется, в следующем коммите уже будет больше работы" !</div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
