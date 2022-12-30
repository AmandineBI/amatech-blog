<script>
    import DefaultLayout from '@/Layouts/DefaultLayout.vue';
    import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
    import Vue3TagsInput from 'vue3-tags-input';

    
    export default {
        props: ['can'],
        components: {
            DefaultLayout, Head, Link, Vue3TagsInput
        },
        props: {
            errors: Object,
            categories: Object
        },
        setup() {
            const form = useForm({
                title: '',
                content: '',
                category: '',
                tags: []
            })
            return { form }
        },
        methods: {
            handleChangeTag(tags) {
            this.tags = tags;
            }
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
            <form @submit.prevent="form.post(route('adminBlog.store'))">
                <div>

                    <div>
                        <label for="title" class="block font-medium text-sm text-gray-700 mt-5">
                            Title
                        </label>
                        <input v-model="form.title" type="text" id="title" placeholder="Title" class="block mt-1 w-full rounded"/>
                        <div v-if="errors.title" class="text-red-600">
                            {{ errors.title}}
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="content" class="block font-medium text-sm text-gray-700">
                            Content
                        </label>
                        <textarea v-model="form.content" type="text" id="content" placeholder="Content" class="block mt-1 w-full rounded"/>
                        <div v-if="errors.content" class="text-red-600">
                            {{ errors.content}}
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="category" class="block font-medium text-sm text-gray-700">
                            Category
                        </label>
                        <select v-model="form.category" id="category" placeholder="Category" class="block mt-1 w-full rounded">
                            <option v-for="(category) in categories" :key="category.id" v-bind:value="category.id">{{ category.original_name }}</option>
                        </select>
                        <div v-if="errors.category" class="text-red-600">
                            {{ errors.category}}
                        </div>
                    </div>
                    

                    <!--div class="mt-4"> ADD THIS PACKAGE FOR THE TAGS: https://github.com/voerro/vue-tagsinput
                        <input v-model="form.tags" id="tags" :existing-tags="tags" :typeahead="true" typeahead-style="badges"/>
                    </div-->
                    <!--div class="mt-4">
                        <label for="tags" class="block font-medium text-sm text-gray-700">
                            Tags
                        </label>
                        <vue3-tags-input v-model="form.tags" id="tags" :tags="form.tags" placeholder="Tags" @on-tags-changed="handleChangeTag" class="block mt-1 w-full rounded"/>
                        <div v-if="errors.tags" class="text-red-600">
                            {{ errors.tags}}
                        </div>
                    </div-->
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
