<script>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    
    export default {
        components: {
            AuthenticatedLayout, Head, Link
        },
        setup() {
            const form = useForm({
                title: '',
                content: ''
            })
            return { form }
        }
    }

</script>

<template>
    <Head title="Edit post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create post
            </h2>
        </template>
        
        <form @submit.prevent="form.post(route('post.store'))">
            <div>
                <div>
                    <label for="title" class="block font-medium text-sm text-gray-700 mt-5">
                        Title
                    </label>
                    <input v-model="form.title" type="text" id="title" class="block mt-1 w-full rounded"/>
                </div>

                <div class="mt-4">
                    <label for="content" class="block font-medium text-sm text-gray-700">
                        Content
                    </label>
                    <input v-model="form.content" type="text" id="content" class="block mt-1 w-full rounded"/>
                </div>
            </div>

            <div class="py-4">
                <button type="submit" class="inline-block px-4 py-3 bg-blue-500 text-white rounded">
                    Save post
                </button>
                <Link :href="route('adminBlog')" class="ml-2 inline-block px-4 py-3 bg-gray-300 rounded">
                    Cancel
                </Link>
            </div>
        </form>
    </AuthenticatedLayout>
</template>
