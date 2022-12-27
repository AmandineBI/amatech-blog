<script>
    import DefaultLayout from '@/Layouts/DefaultLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    
    export default {
        props: ['can'],
        components: {
            DefaultLayout, Head, Link
        },
        props: {
            errors: Object
        },
        setup() {
            const form = useForm({
                title: '',
                content: ''
            })
            console.log(form);
            return { form }
        }
    }

</script>

<template>
    <Head title="Create post" />

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create post
            </h2>
        </template>
        
        <div class="grid grid-cols-2 gap-4">
            <form @submit.prevent="form.post(route('postBlog.store'))">
                <div>
                    <div>
                        <label for="title" class="block font-medium text-sm text-gray-700 mt-5">
                            Title
                        </label>
                        <input v-model="form.title" type="text" id="title" class="block mt-1 w-full rounded"/>
                        <div v-if="errors.title" class="text-red-600">
                            {{ errors.title}}
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="content" class="block font-medium text-sm text-gray-700">
                            Content
                        </label>
                        <textarea v-model="form.content" type="text" id="content" class="block mt-1 w-full rounded"/>
                        <div v-if="errors.content" class="text-red-600">
                            {{ errors.content}}
                        </div>
                    </div>
                </div>

                <div class="py-4">
                    <button type="submit" :disabled="form.processing" class="inline-block px-4 py-3 bg-blue-500 text-white rounded">
                        Save post
                    </button>
                    <Link :href="route('adminPanel')" class="ml-2 inline-block px-4 py-3 bg-gray-300 rounded">
                        Cancel
                    </Link>
                </div>
            </form>
            <div class="m-2 p-2 border-solid border-2">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-2">
                    <span v-html="form.title" style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit;"></span>
                </h2>
                <div>
                    <span v-html="form.content" style="white-space: pre-wrap; word-wrap: break-word; font-family: inherit;"></span>
                </div>
            </div>
        </div>
    </DefaultLayout>
</template>
