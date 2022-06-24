<template>
    <div class="flex justify-center">
        <div class="md:w-2/3 py-5 md:py-48">
            <img :src="data.images[0].url" :srcset="data.images[0].srcset"/>
        </div>
    </div>
</template>

<script>
export default {
    name: "Image",
    props: ['data']
}
</script>

<style scoped>

</style>
