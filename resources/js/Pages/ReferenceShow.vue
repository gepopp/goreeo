<template>
<div class="flex" v-for="block in reference.content_blocks">
    <div class="p-5 text-lg leading-loose text-logo bg-white">
        <h2>{{ block.title }}</h2>
        <div v-html="block.content"></div>
    </div>
    <div>
    </div>
</div>
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
