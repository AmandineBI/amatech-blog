<script>
import AdminPanelLayout from '@/Layouts/AdminPanelLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import BreezeButton from "@/Components/PrimaryButton.vue";

export default {
    components: {
        AdminPanelLayout, Head, Link, BreezeButton
    },
    props: {
        errors: Object,
        categories: Array
    },
    methods: {
        destroy(id) {
            console.log("Deleting category...")
            if(confirm('Are you sure?')) {
                Inertia.delete(route('adminCategories.destroy', id))
                this.forms = this.forms.filter(form => form.id != id)
            }
            console.log("Category deleted")
        },
        log(item) {
            console.log(item)
        }
    },
    setup (props) {
        const forms = props.categories.map(category => useForm(`EditCategory:${category.id}`, {
            id: category.id,
            original_name: category.original_name
        }))
        return { forms }
    }
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

        <div v-if="$page.props.auth.user?.is_admin">

            <Link :href="route('adminCategories.create')" class="inline-block px-4 py-3 bg-blue-500 text-white rounded mb-4">Create new category</Link>

            <div class="my-5 py-5 border-b-2 border-b-slate-200" v-for="form in forms" :key="form.id">

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

                        <button :load="log('Submit button')" type="submit" :disabled="form.processing" class="inline-flex px-4 py-2 mr-5 mt-2 mb-4 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest rounded hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">
                            Save category
                        </button>
                        <BreezeButton @click="destroy(form.id)" class="inline-block px-4 py-2 bg-blue-500 text-white rounded mb-4">Delete category</BreezeButton>

                    </div>

                </form>

            </div>

        </div>

    </AdminPanelLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }

</style>