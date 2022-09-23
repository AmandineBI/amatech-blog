<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    
    const props = defineProps({
        blog_posts: Array,
    });
    </script>
    
    <template>
        <Head title="Blog Posts" />
    
        <AuthenticatedLayout>
            <h1>Blog posts</h1>
            <div v-if="props.blog_posts">
                <div class="articles-list" v-for="post in props.blog_posts">
                    <h3>{{ post.title }}</h3>
                    <div><small>{{ post.author }}</small></div>
                    <div><small>{{ post.published_at }}</small></div>
                    <br/>
                    {{ post.content }}
                    <br/>
                    <p><a href="post/{{ post.id }}">Edit post</a></p>
                    <ol class="categories">
                        <li v-for="tag in post.tag">{{ tag.original_name }}</li>
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
            background-color: rgb(131, 210, 255);
        }
    
    </style>