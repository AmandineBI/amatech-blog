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
        languages: Array
    },
    methods: {
        log(item) {
            console.log(item)
        }
    }
}


/*let cat = props.categories
let forms = cat.map(category => useForm({
    id: category.id,
    original_name: category.original_name
    }))*/

</script>

<template>
    <Head title="List Languages" />

    <AdminPanelLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Languages
            </h2>
        </template>

        <div v-if="$page.props.auth.user?.is_admin">

            <div class="my-5 py-5 border-b-2 border-b-slate-200" v-for="language in languages" :key="language.id">

                        <div>
                            {{ language.language_code }}
                            {{ language.language_name }}
                        </div>

                    </div>

            </div>

    </AdminPanelLayout>
</template>
