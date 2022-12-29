<script>
import AdminPanelLayout from '@/Layouts/AdminPanelLayout.vue';
import AdminPanelNavBarLayout from '@/Layouts/AdminPanelNavBarLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';
import BreezeButton from "@/Components/PrimaryButton.vue";

export default {
    components: {
        AdminPanelLayout, AdminPanelNavBarLayout, Head, Link, BreezeButton, Inertia
    },
    props: {
        blog_posts: Array,
        categories: Array
    },
    methods: {
        destroy(id) {
            if(confirm('Are you sure?')) {
            Inertia.delete(route('adminBlog.destroy', id)); //inertia delete method
            }
        },
        publish(id) {
            Inertia.patch(route('adminPanel.publish', id));
        },
        archive(id) {
            Inertia.patch(route('adminPanel.archive', id));
        }
    }
}


</script>

<template>
    <Head title="Admin Dashboard" />

    <AdminPanelLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog posts
            </h2>
        </template>

        <div v-if="$page.props.auth.user?.is_admin">

            <Link :href="route('adminBlog.create')" class="inline-block px-4 py-3 bg-blue-500 text-white rounded mb-4">Create new post</Link>

            <AdminPanelNavBarLayout :categories="categories">

                <div v-if="blog_posts">
                    <div class="my-5 py-5 border-b-2 border-b-slate-200" v-for="post in blog_posts">
                        <h3 class="text-lg font-bold">{{ post.title }}</h3>
                        <div class="text-xs">{{ post.author }}</div>
                        <div class="text-xs">{{ post.published_at }}</div>
                        <div class="my-2">
                            {{ post.content }}
                        </div>

                        <ol class="list-none p-1 block">
                            Tags: 
                            <li class="inline-block border-2 border-teal-300 p-1 rounded my-1 mr-3 bg-teal-100" v-for="tag in post.tags">
                                {{ tag.original_name }}
                            </li>
                        </ol>

                        <Link :href="route('adminBlog.edit', {id: post.id})" class="inline-flex px-4 py-2 mr-5 mt-2 mb-4 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest rounded hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">Edit post</Link>
                        <Link :href="route('adminBlog.show', {id: post.id})" class="inline-flex px-4 py-2 mr-5 mt-2 mb-4 bg-blue-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest rounded hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray transition ease-in-out duration-150">View post</Link>
                        <BreezeButton @click="destroy(post.id)" class="inline-block mr-5 px-4 py-2 bg-blue-500 text-white rounded mb-4">Delete post</BreezeButton>
                        <BreezeButton v-if="post.published==0" @click="publish(post.id)" class="inline-block px-4 py-2 bg-blue-500 text-white rounded mb-4">Publish post</BreezeButton>
                        <BreezeButton v-else class="inline-block mr-5 px-4 py-2 cursor-default bg-gray-500 hover:bg-gray-500 text-white rounded mb-4">Publish post</BreezeButton>
                        <BreezeButton v-if="post.published==1" @click="archive(post.id)" class="inline-block px-4 py-2 bg-blue-500 text-white rounded mb-4">Archive post</BreezeButton>

                    </div>
                </div>

                <div v-else>
                    <h3>There is no blog post yet.</h3>
                    <p>Come back later to discover awesome posts!</p>
                </div>

            </AdminPanelNavBarLayout>
        
        </div>
    
    </AdminPanelLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }

</style>