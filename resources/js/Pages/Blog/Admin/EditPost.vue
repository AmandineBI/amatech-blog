<script>
    import DefaultLayout from '@/Layouts/DefaultLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    
    export default {
        props: ['can'],
        components: {
            DefaultLayout, Head, Link
        },
        props: {
            errors: Object,
            blog_post: Object,
            categories: Object,
            languages: Array
        },
        setup(props) {
            const form = useForm({ //props.blog_post
                id: props.blog_post.id,
                title: props.blog_post.title,
                language: props.blog_post.original_language_code,
                content: props.blog_post.original_content,
                category: props.blog_post.categories
            })
            console.log(props.blog_post);
            return { form }
        }
    }
</script>

<template>
    <Head title="Edit post" />

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Create post
            </h2>
        </template>

        <form @submit.prevent="form.put(route('adminBlog.update', {id: form.id}))">
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
                    <label for="language" class="block font-medium text-sm text-gray-700">
                        Language
                    </label>
                    <select v-model="form.language" id="language" placeholder="Language" class="block mt-1 w-full rounded">
                        <option v-for="(language) in languages" :key="language.language_code" v-bind:value="language.language_code">{{ language.language_name }}</option>
                    </select>
                    <div v-if="errors.language" class="text-red-600">
                        {{ errors.language}}
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

            <div class="mt-4">
                <label for="category" class="block font-medium text-sm text-gray-700">
                    Category
                </label>
                <select v-model="form.category" id="category" placeholder="Category" class="block mt-1 w-full rounded">
                    <option v-for="category in categories" :key="category.id" v-bind:value="category.id">{{ category.original_name }}</option>
                </select>
                <div v-if="errors.category" class="text-red-600">
                    {{ errors.category}}
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
    </DefaultLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }
</style>