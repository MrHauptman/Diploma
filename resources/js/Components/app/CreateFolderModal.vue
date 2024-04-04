<template>
<modal :show="modelValue">
    <div class="p-6">
        <h2
            class="text-lg font-meidum text-black">
            Создать новую папку
        </h2>
        <div
        InputLabel for="folderName" value="folderName">
        <TextInput type="text"  id="folderName" v-model="form.name" 
        class="mt-1 block w-full" 
        :class="form.errors.name ? 'border-red-500 focus:border-red-500 focus:ring-red-500': ''"
        placeholder="Название папки"
        @keyup.enter="createFolder">
        </TextInput>
        <InputError :message="form.errors.name" class="mt-2">
        </InputError>
        <div class="mt-6 flex justify-end">
    <PrimaryButton class="ml-3"
                   :class="{ 'opacity-25': form.processing }"
                   @click="createFolder" :disable="form.processing">
        Создать
    </PrimaryButton>
    <div class="ml-3"></div>
    <SecondaryButton @click="closeModal">Отмена</SecondaryButton>
</div>
        
    </div>
    </div>
</modal>
</template>


<script setup>

const {folderNameInput}=ref(null)

const {modelValue} = defineProps({
    modelValue: Boolean 
})
import Modal from "@/Components/Modal.vue"
import TextInput from "../TextInput.vue";
import InputError from "../InputError.vue";
import { useForm } from "@inertiajs/vue3";
import SecondaryButton from "@/Components/SecondaryButton.vue";
import PrimaryButton from "@/Components/PrimaryButton.vue";
import {ref} from "vue";
import { nextTick } from "vue";


const form = useForm({
    name: ''
})

 function createFolder()
 {
    form.post(route('folder.create'),{
    preserveScroll: true,
    onSuccess: () => {
        closeModal()
        ///show.reset();
    },
    onError: () => folderNameInput.value.focus()
    
    })
    console.log("Создать Папку")

}
function closeModal() {
    emit('update:modelValue')
    form.clearErrors();
    form.reset()
}
const emit = defineEmits(['update:modelValue'])


function onShow(){

    nextTick(()=> folderNameInput.value.focus())
}

</script>