<script setup>
import { Link } from '@inertiajs/vue3'
import { onMounted, onUnmounted, ref } from 'vue'

const props = defineProps({
    csrfToken: String,
    flash: Array,
    page: Array|Object,
})

onMounted(() => {
    console.log('Component Nav onMounted hook called')
})
</script>
<template>
  <!-- Sidebar -->
  <div class="sidebar" id="sidebar">

    <hr class="mt-0">

    <h6 style="color: white;"></h6>
    <!-- app menu -->
    <span></span>

    <!-- mobile menu -->
    <hr class="d-lg-none">
    <div class="d-lg-none">
      <h6 class="ms-4" style="color: white;">Application</h6>
      <span class="m-0"></span>
    </div>
  </div>
</template>
