<script setup>
    import DefaultLayout from '@/Layouts/DefaultLayout.vue';
    import { Head } from '@inertiajs/inertia-vue3';
    
    const props = defineProps({
        blog_post: Object,
        canLogin: Boolean,
        canRegister: Boolean,
        permissions: Number,
        filters: Object,
        can: Object,
        laravelVersion: String,
        phpVersion: String,
    });
</script>

<template>
    <Head title="Edit post" />

    <DefaultLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                View post
            </h2>
        </template>
        
        <pre>{{ blog_post }}</pre>
    </DefaultLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }
</style>