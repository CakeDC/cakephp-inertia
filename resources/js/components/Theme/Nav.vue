<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
    csrfToken: String,
    flash: Array,
    page: Array|Object,
    menuNav: Array|Object,
    menuHeader: Array|Object,
})

onMounted(() => {
    console.log('Component Nav onMounted hook called')
    console.log('props.menuNav',props.menuNav);
    console.log('props.menuHeader',props.menuHeader);
})
</script>
<template>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">

        <hr class="mt-0">
        <!--
        <h6  v-if="props.menuNav !== undefined && props.menuNav.length>0" class="ms-4" style="color: white;">Project</h6>
        <span class="m-0" v-for="option in props.menuNav">
            <Link :href="option.url" :class="[(option.active) ? 'link-light' : ' link-secondary', 'nav-link','px-2', 'ms-4']">
                <i :data-feather="option.icon"></i>
                {{option.text}}
            </Link>
        </span>
        -->

        <hr class="d-lg-none">
        <div class="d-lg-none">
            <h6 class="ms-4" style="color: white;">Application</h6>
            <!--
            <span class="m-0"  v-for="option in props.menuHeader">
                <Link :href="option.url" :class="[(option.active) ? 'link-light' : ' link-secondary', 'nav-link','px-2', 'ms-4']">
                    <i :data-feather="option.icon"></i>
                    {{option.text}}
                </Link>
            </span>
            -->
            <span class="m-0">
                <a class="link-secondary nav-link px-2 ms-4" href="#"><i data-feather="log-out"></i> Logout</a>
            </span>
        </div>
    </div>
</template>
