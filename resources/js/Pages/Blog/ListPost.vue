<script setup>
    import DefaultLayout from '@/Layouts/DefaultLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    
    const props = defineProps({
        blog_posts: Array,
    });
</script>

<template>
    <Head title="Blog Posts" />

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog posts
            </h2>
        </template>
        
        <div v-if="props.blog_posts">
            <div class="mt-10" v-for="post in props.blog_posts">
                <h3>{{ post.title }}</h3>
                <div><small>{{ post.author }}</small></div>
                <div><small>{{ post.published_at }}</small></div>
                <br/>
                {{ post.content }}
                <br/>
                <p><a href="post/{{ post.id }}">Edit post</a></p>
                <ol class="list-none p-0 block">
                    <li v-for="tag in post.tag">{{ tag.original_name }}</li>
                </ol>
            </div>
        </div>

        <div v-else>
            <h3>There is no blog post yet.</h3>
            <p>Come back later to discover awesome posts!</p>
        </div>

    </DefaultLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }

    h1 {
        max-width: 1000px;
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
        background-color: rgb(131, 255, 224);
    }

</style>