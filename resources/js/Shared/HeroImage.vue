<template>
    <div class="aspect-[4/3] w-full bg-cover bg-fixed bg-center bg-no-repeat" :style="{ backgroundImage : 'url(' + data.images[0].url + ')' }">
    </div>
</template>

<script>
export default {
    name: "HeroImage",
    props: ['data'],
    components: {
    }
}
</script>

<style scoped>

</style>
