<script>
    import { ref } from 'vue';
    import NavLink from '@/Components/NavLink.vue';
    import { Link } from '@inertiajs/inertia-vue3';

    export default {
        components: {
            NavLink
        },
        props: {
            errors: Object,
            categories: Array
        },
        data () {
            return {
            }
        },
        methods: {
            setCategory() {
                category = this.category
            }
        },
        //computed: {
        //    console() {
        //        return console.log("Cat: " + JSON.stringify(this.categories))
        //    }
        //}
    }
</script>

<template>
        <div class="border-b border-gray-100 flex">
            <NavLink class="mr-5 pb-3" v-for="category in categories" v-if="$page.props.auth.user?.is_admin" :href="route('adminPanel.category', category.id)" :active="route().current('adminPanel.category', category.id)">
                {{ category.original_name }}
            </NavLink>
        </div>
        <slot />
</template>
