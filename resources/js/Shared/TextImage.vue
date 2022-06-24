<template>

    <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-1/2">
            <TextOnly :data="data"></TextOnly>
        </div>
        <div class="w-full lg:w-1/2 py-48 md:py-72">
            <Image :data="data"></Image>
        </div>
    </div>


</template>

<script>
import TextOnly from "./TextOnly";
import Image from "./Image";
export default {
    name: "TextImage",
    components: {Image, TextOnly},
    props: ['data']
}
</script>

<style scoped>

</style>
