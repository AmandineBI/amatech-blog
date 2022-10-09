<script setup>
import AdminPanelLayout from '@/Layouts/AdminPanelLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeButton from "@/Components/PrimaryButton.vue";
import {computed} from "vue";

const forms = computed(
    () => props.categories.map(category => useForm({
        id: category.id,
        original_name: category.original_name
    }))
)
let props = defineProps({
    errors: Object,
    categories: Array,
});
function destroy(id) {
    if(confirm('Are you sure?')) {
        forms = forms.filter(form => form.id != id);
        Inertia.delete(route('adminCategories.destroy', id));
    }
}
function log(item) {
      console.log(item)
    }

/*let cat = props.categories
let forms = cat.map(category => useForm({
    id: category.id,
    original_name: category.original_name
    }))*/

</script>

<template>
    <Head title="Edit Categories" />

    <AdminPanelLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Categories
            </h2>
        </template>

        <Link :href="route('adminCategories.create')" class="inline-block px-4 py-3 bg-blue-500 text-white rounded mb-4">Create new category</Link>

            <div class="my-5 py-5 border-b-2 border-b-slate-200" v-for="form in forms" :key="form.id" :load="log(forms)">

                <form @submit.prevent="form.put(route('adminCategories.update', {id: form.id}))">
                    <div>
                        <div>
                            <label for="original_name" class="block text-lg font-bold text-sm text-gray-700 mt-5">
                                {{ form.original_name }}
                            </label>
                            <input v-model="form.original_name" type="text" id="original_name" class="block mt-1 w-full rounded"/>
                            <div v-if="errors.original_name" class="text-red-600">
                                {{ errors.original_name}}
                            </div>
                        </div>

                        <button type="submit" :disabled="form.processing" class="inline-flex px-4 py-2 mr-5 mt-2 mb-4 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest rounded hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                            Save category
                        </button>
                        <BreezeButton @click="destroy(form.id)" class="inline-block px-4 py-2 bg-blue-500 text-white rounded mb-4">Delete category</BreezeButton>

                    </div>

                
                </form>

            </div>


    </AdminPanelLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }

</style>