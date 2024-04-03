<template>
<modal :show="modelValue">
    <div class="p-6">
        <h2
            class="text-lg font-meidum text-black">
            Создать новую папку
        </h2>

    </div>
</modal>
</template>


<script setup>



const {modelValue} = defineProps({
    modelValue: Boolean 
})
import Modal from "@/Components/Modal.vue"
</script>