<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    
    const props = defineProps({
        blog_post: Object,
    });
    </script>
    
    <template>
        <Head title="Edit post" />
    
        <AuthenticatedLayout>
            <h1>Edit post</h1>
            <pre>{{ blog_post }}</pre>
        </AuthenticatedLayout>
    </template>
    
    <style>
        * {
            box-sizing: border-box;
        }
    </style>