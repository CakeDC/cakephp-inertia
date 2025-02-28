<script setup>
import {Head, Link} from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
    csrfToken: String,
    flash: Array,
    page: Array|Object,
    project: Array|Object,
    menuHeader: Array|Object,
    menuNav: Object|Array,
})


onMounted(() => {
    console.log('Component Header onMounted hook called')
    console.log('menuHeader', props.menuHeader)
})
</script>
<template>
    <div class="header">
        <div class="col-left">
            <h5 class="mb-0">MANAGER</h5>
        </div>
        <div class="col-right">
            <nav class="menu-nav d-none d-lg-flex" v-for="option in props.menuHeader">
                <!--
                <Link :href="option.url" :class="[(option.active) ? 'link-light' : ' link-secondary', 'nav-link','px-2']">
                    <i :data-feather="option.icon"></i>
                    {{option.text}}
                </Link>
                -->
            </nav>
            <button class="btn btn-light d-lg-none" id="toggleSidebar"><i data-feather="menu"></i></button>
            <a href="/users/logout" class="logout-link d-none d-md-inline"><i data-feather="log-out"></i> Logout</a>
        </div>
    </div>
</template>
