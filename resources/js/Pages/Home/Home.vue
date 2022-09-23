<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
</script>

<template>
    <Head title="Admin Dashboard" />

    <AuthenticatedLayout>
        <h1>Home Page</h1>
    </AuthenticatedLayout>
</template>

<style>
    * {
        box-sizing: border-box;
    }
</style>