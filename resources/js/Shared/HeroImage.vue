<template>
    <div class="aspect-[4/3] left-0 w-full bg-cover bg-center"
         :style="{ backgroundImage : 'url(' + data.images[0].url + ')' }"
         :alt="data.content"
         :title="data.title">
    </div>
</template>

<script>
export default {
    name: "HeroImage",
    props: ['data']
}
</script>

<style scoped>

</style>
