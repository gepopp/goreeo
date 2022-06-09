<template>
<h1>{{ reference.title }}</h1>
</template>

<script>
import Layout from "../Shared/Layout";

export default {
    name: "ReferenceShow",
    props: ['reference'],
    layout: Layout
}
</script>

<style scoped>

</style>
