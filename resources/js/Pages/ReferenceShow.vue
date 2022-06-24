<template>
    <div class="flex" v-for="block in reference.content_blocks">
        <div class="flex justify-center items-center md:w-1/2 p-5 text-lg leading-loose text-logo bg-white">
            <div class="md:max-w-xl md:m-48">
                <h2 class="md:text-xl font-bold mb-10 tracking-wide">{{ block.title }}</h2>
                <div v-html="block.content" class="md:text-xl leading-6"></div>
            </div>
        </div>
        <div class="bg-logo bg-opacity-50 md:w-1/2 h-full flex flex-col">
            bild
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
