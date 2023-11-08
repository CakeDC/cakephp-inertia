<script setup>
import { Link } from '@inertiajs/vue3'
</script>

<template>
    <main>
        <header>
            <Link as="button" href="/pages/dashboard">Dashboard</Link>
            <Link as="button" href="/pages">Pages</Link>
            <Link as="button" href="/tags">Tags</Link>
            <Link as="button" href="/categories">Categories</Link>
        </header>
        <article>
            <slot />
        </article>
    </main>
</template>
