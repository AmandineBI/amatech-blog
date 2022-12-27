<script setup>
    import NavBarLayout from '@/Layouts/NavBarLayout.vue';

</script>

<template>
    <NavBarLayout>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div v-if="$page.props.flash.message" class="text-blue-600 mb-4">
                            {{ $page.props.flash.message }}
                        </div>

                        <slot />
                    </div>
                </div>
            </div>
        </div>
        
    </NavBarLayout>
</template>
    