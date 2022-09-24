<script setup>
    import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    
    const props = defineProps({
        blog_post: Object, //To be improved with Post class
    });
</script>

<template>
    <Head title="Edit post" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit post
            </h2>
        </template>
        
        <pre>{{ blog_post }}</pre>
    </AuthenticatedLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }
</style>