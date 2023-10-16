<template>
    <div>
        <div>Dashboard VUE</div>
        <p>{{page.text}}</p>
        <p>{{page.other}}</p>
    </div>
</template>

<script>
import Layout from '@/Components/Layout'
export default {
    props: {
        page: [],
    },
    components: {
    },
    mounted() {
        console.log('mounted');
        console.log('page', this.page);
    },
    layout: Layout
}
</script>
