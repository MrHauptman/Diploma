<template>
<AuthenticatedLayout>
    <nav class="flex-item-center justify-between p-1 mb-3">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li v-for="ans of ancestors.data" :key="ans.id">
                <Link v-if="!ans.parent_id" :href="route('myFiles')" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <HomeIcon class="w-4 h-4"/>
                        My Files
                
                </Link>
                <div v-else class="flex items-center">
                    <svg aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                             xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                  d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                  clip-rule="evenodd"></path>
                        </svg>
                        <Link :href="route('myFiles', {folder: ans.path})"
                              class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ml-2 dark:text-gray-400 dark:hover:text-white">
                            {{ ans.name }}
                        </Link>
                </div>
            </li>

        </ol>
    </nav>
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
                {{ file.size}}
                </a>
            </td> 
            <td></td>
            </tr>
        </tbody>
    </table>
    <div v-if= "!files.data.length" class="py-8 text-center text-lg">
        Директория пуста
        
    </div>

</AuthenticatedLayout>
</template>


<script setup>
import AuthenticatedLayout from "@/Layouts/AuthenticatedLayout.vue"
import { router } from "@inertiajs/vue3";
import { Link } from "@inertiajs/vue3";


function openFolder(file){
    if (!file.is_folder)
    {
        return;
    }
    router.visit(route('myFiles',{folder: file.path}))
}


const{files} = defineProps({
    files: Object,
    folder: Object,
    ancestors: Array 
})
</script>