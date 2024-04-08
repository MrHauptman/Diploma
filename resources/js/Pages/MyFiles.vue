<template>
<AuthenticatedLayout>

    <table  class="min-w-full">
        <thead class="bg-violet-500 border-b ">
           <tr> 
            <th class="text-sm font-medium text-white px-6 py-4 text-left">
                   Название
                   
            </th>
            
            <th class="text-sm font-medium text-white px-6 py-4 text-left">
                   Загрузчик
            </th>
         
            <th class="text-sm font-medium text-white px-6 py-4 text-left">
                   Изменено
            </th>
            
            <th class="text-sm font-medium text-white px-6 py-4 text-left">
                   Размер
            </th>
        
        </tr>
        </thead>
        <tbody>
            <tr v-for="file of files.data" :key="file.id"
            @dblclick="openFolder(file)"
            class="bg-white border-b transition duration-300 ease-in-out
            hover:bg-gray-100">
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 cursor-pointer">
                {{ file.name }}
            </td> 
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                {{ file.owner }}
            </td> 
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                {{ file.updated_at }}
            </td> 
            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 ">
                <a>
                    {{file.size}}
                </a>
            </td> 

            <td></td>
            </tr>
        </tbody>
        
    </table>
    <div v-if="!files.data.length" class="py-8 text-center text-lg">
        Папка пуста
    </div>

</AuthenticatedLayout>
</template>


<script setup>

function openFolder(file){
    if (!file.is_folder)
    {
        return;
    }
    router.visit(route('myFiles',{folder: file.path}))
}

import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { router } from "@inertiajs/vue3";


const{files} = defineProps({
    files: Object
})
</script>