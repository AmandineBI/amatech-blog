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
        users: Array
    },
    methods: {
        log(item) {
            console.log(item)
        }
    },
    setup() {
        const headers = [
            'id',
            'name',
            'email',
            'password',
            'introduction',
            'favorite_language',
            'favorite_category',
            'is_admin',
        ];
        return {
            headers
        };
    },
}


/*let cat = props.categories
let forms = cat.map(category => useForm({
    id: category.id,
    original_name: category.original_name
    }))*/

</script>

<template>
    <Head title="List Users" />

    <AdminPanelLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div v-if="$page.props.auth.user?.is_admin">

            <table id="userTable" class="table-auto w-full text-sm text-left dark:text-gray-400">
            
                <thead class="text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                    <!-- loop through each value of the fields to get the table header -->
                    <th  v-for="field in headers" :key="field" @click="sortTable(field)" > 
                        {{ field.replace('_', ' ') }} <i class="bi bi-sort-alpha-down" aria-label='Sort Icon'></i>
                    </th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Loop through the list get the each student data -->
                    <tr v-for="user in users" :key="user.id" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td v-for="field in headers" :key="field" class="border p-2">
                        {{ user[field] }}
                    </td>
                    </tr>
                </tbody>
            
            </table>

            </div>

    </AdminPanelLayout>
</template>
