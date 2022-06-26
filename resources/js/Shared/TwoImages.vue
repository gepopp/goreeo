<template>
    <div class="flex flex-col lg:flex-row w-full">
        <div class="w-full lg:w-1/2">
            <div class="aspect-[4/3] left-0 w-full bg-cover bg-center"
                 :style="{ backgroundImage : 'url(' + data.images[0].url + ')' }"
                 :alt="data.content"
                 :title="data.title"></div>
        </div>
        <div class="w-full lg:w-1/2">
            <div class="aspect-[4/3] left-0 w-full bg-cover bg-center"
                 :style="{ backgroundImage : 'url(' + data.images[1].url + ')' }"
                 :alt="data.content"
                 :title="data.title"></div>
        </div>
    </div>
</template>

<script>
import ScrollXParallax from 'vue3-parallax/src/components/ScrollParallax.vue';

export default {
    name: "TwoImages",
    props: ['data'],
    components: {
        ScrollXParallax
    }
}
</script>

<style scoped>

</style>
