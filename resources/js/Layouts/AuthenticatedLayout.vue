<template>
    <div class="h-screen bg-gray-50 flex w-full gap-4">
        <Navigation/>


        <main  @drop.prevent="handleDrop"
                @dragover.prevent= "onDragOver"
                @dragleave.prevent="onDragLeave" 
                class="flex flex-col flex-1 px-4 overflow-hidden"
                :class="dragOver ? 'dropzone':'' ">
            <template v-if="dragOver" class="text-gray-500 text-center py-8 text-sm">
                Перетащите файл сюда

            </template>
            <template v-else>
                <div class="flex item-center justify-between w-full">
                <SearchForm />
                <UserSettingsDropdown/>
                </div>
            <div class="flex-1 flex flex-col overflow-hidden">
                <slot/>
            </div>
        </template>
        </main>
    </div>
</template>





<script setup>
import { ref } from 'vue';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import Dropdown from '@/Components/Dropdown.vue';
import DropdownLink from '@/Components/DropdownLink.vue';
import NavLink from '@/Components/NavLink.vue';
import ResponsiveNavLink from '@/Components/ResponsiveNavLink.vue';
import { Link } from '@inertiajs/vue3';
import Navigation from "@/Components/app/Navigation.vue"
import SearchForm from "@/Components/app/SearchForm.vue"
import UserSettingsDropdown from "@/Components/app/UserSettingsDropdown.vue"
const showingNavigationDropdown = ref(false);
import {MenuItem} from "@headlessui/vue";
import {emitter, FILE_UPLOAD_STARTED} from "@/event-bus";
import { onMounted } from 'vue';
import { usePage, useForm } from '@inertiajs/vue3';

 const page = usePage();
const fileUploadForm = useForm({
    files: [],
    relative_paths: [],
    parent_id: null
}) 



const dragOver = ref(false)


function onDragOver() {
    dragOver.value = true
}

function onDragLeave() {
    dragOver.value = false
}

function handleDrop(ev) {
    dragOver.value = false;
    const files = ev.dataTransfer.files
    if (!files.length) {
        return
    }

    uploadFiles(files)
}


function uploadFiles(files){
    console.log(page.props)
    fileUploadForm.parent_id = page.props.folder.id
    fileUploadForm.files = files

    fileUploadForm.post(route('file.store'))
}
onMounted(() => {
    emitter.on(FILE_UPLOAD_STARTED, uploadFiles)
})
</script>


<style scoped>
.dropzone {
    width: 100%;
    height: 100%;
    color: #888;
    border: 2px dashed gray;
    justify-content: center;
    align-items: center;
}
</style>