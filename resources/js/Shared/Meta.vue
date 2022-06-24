<template>
    <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-3/4">
            <TextOnly :data="data"></TextOnly>
        </div>
        <div class="w-full lg:w-1/4 flex flex-col justify-center items-center text-xl" :class="data.color == 'white' ? 'bg-logo text-white' : 'bg-white text-logo'">
            <ul class="px-5 py-48 lg:py-0">
                <li v-for="entry in metaarray" class="mb-10">
                    <p v-text="entry[0]" class="leading-tight font-semibold"></p>
                    <p v-text="entry[1]" class="leading-tight"></p>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
import TextOnly from "./TextOnly";
export default {
    name: "Meta",
    components: {TextOnly},
    props: ['data'],
    computed: {
        metaarray(){
            return Object.entries(this.data.meta);
        }
    }
}
</script>

<style scoped>

</style>
