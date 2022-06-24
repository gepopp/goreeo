<template>
    <div class="flex justify-center py-48 md:py-72">
        <div class="md:w-2/3 px-5 py-5 md:py-48">
            <h2 class="text-2xl md:text-5xl font-bold break-all">{{ data.title }}</h2>
            <h3 class="text-lg md:text-2xl font-semibold">{{ data.subtitle }}</h3>
            <div class="my-10 w-24 border-t-4" :class="data.color == 'logo' ? 'border-white' : 'border-logo'" v-if="data.content !== ''"></div>
            <div class="md:text-xl" v-html="data.content"></div>
        </div>
    </div>
</template>

<script>
export default {
    name: "TextOnly",
    props: ['data']
}
</script>

<style scoped>

</style>
