<template>
  <main>
      <header>
        HEADER
      </header>
    <article>
      <slot />
    </article>
  </main>
</template>

<script>
import { InertiaLink } from '@inertiajs/inertia-vue'

export default {
  components: {
    InertiaLink,
  }
}
</script>
