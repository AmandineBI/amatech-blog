<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Inertia } from '@inertiajs/inertia';
import { Head, Link } from '@inertiajs/inertia-vue3';

const props = defineProps({
    blog_posts: Array,
});
function destroy(id) {
    Inertia.delete(route('posts.destroy', id));
}
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog posts
            </h2>
        </template>

        <Link :href="route('blogAdminCreate')" class="inline-block px-4 py-3 bg-blue-500 text-white rounded mb-4">Create new post</Link>

        <div v-if="props.blog_posts">
            <div class="articles-list" v-for="post in props.blog_posts">
                <h3>{{ post.title }}</h3>
                <div><small>{{ post.author }}</small></div>
                <div><small>{{ post.published_at }}</small></div>
                <br/>
                {{ post.content }}
                <br/>
                <Link :href="route('blogAdminEdit', {id: post.id})" class="inline-block px-4 py-1 mr-5 mt-2 bg-blue-500 text-white rounded mb-4">Edit post</Link>
                <Link :href="route('blogAdminView', {id: post.id})" class="inline-block px-4 py-1 mr-5 mt-2 bg-blue-500 text-white rounded mb-4">View post</Link>
                <BreezeButton @click="destroy(post.id)" class="inline-block px-4 py-1 bg-blue-500 text-white rounded mb-4">Delete post</BreezeButton>

                <ol class="categories">
                    <li v-for="tag in post.tags">{{ tag.original_name }}</li>
                </ol>
            </div>
        </div>

        <div v-else>
            <h3>There is no blog post yet.</h3>
            <p>Come back later to discover awesome posts!</p>
        </div>

    </AuthenticatedLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }

    h1 {
        max-width: 1000px;
    }

    main {
        margin: 30px;
    }

    .articles-list {
        margin-top: 50px;
    }

    .categories {
        list-style: none;
        padding: 0;
        display: block;
    }

    .categories li {
        display: inline-block;
        border: 1px solid;
        padding: 3px;
        border-radius: 5px;
        margin-bottom: 3px;
        margin-right: 5px;
        background-color: rgb(131, 255, 224);
    }

</style>