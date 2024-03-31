<template>
<form class="w-[600px] h-[80px] flex items-center">
    <TextInput type="text"
                   class="block w-full mr-2"
                   v-model="search"
                   autocomplete
                   placeholder="Введите имя файла или диреткории для поиска"/>

</form>
</template>

<script setup>
import TextInput from "@/Components/TextInput.vue";
import {router, useForm} from "@inertiajs/vue3";
const form= useForm({
    search: ''
})
</script>