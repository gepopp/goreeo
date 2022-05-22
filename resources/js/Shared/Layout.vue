<template>

    <div class="w-full min-h-screen bg-gray-800 relative">
        <div class="animated-title">
            <div class="text-top">
                <div>
                    <span>content </span>
                    <span>marketing &</span>
                </div>
            </div>
            <div class="text-bottom">
                <div>social media management</div>
            </div>
        </div>
        <div
            x-data="{fade: false}"
            x-init="setTimeout(() => fade = true, 2500)"
            class="absolute top-0 left-0 w-full h-full flex">
            <div class="bg-blue-500 transition-all ease-in-out duration-500 bg-cover bg-left"
                 x-bind:class="fade == true ? 'w-1/3' : 'w-0'"
                 v-bind:style="{ backgroundImage: 'url(' + images[0] +')' }"></div>
            <div class="bg-red-500 transition-all delay-500 ease-in-out duration-500 bg-cover bg-left"
                 x-bind:class="fade == true ? 'w-1/3' : 'w-0'"
                 v-bind:style="{ backgroundImage: 'url(' + images[1] +')' }"
            ></div>
            <div class="bg-green-500 transition-all delay-1000 ease-in-out duration-500 bg-cover bg-left"
                 x-bind:class="fade == true ? 'w-1/3' : 'w-0'"
                 v-bind:style="{ backgroundImage: 'url(' + images[2] +')' }"
            ></div>
        </div>

        <div class="absolute top-0 left-0 p-5">

        </div>

    </div>

    <slot/>

</template>

<script>
import { computed } from 'vue'
import { usePage } from '@inertiajs/inertia-vue3'


export default {


    name: "Layout",
    setup() {
        const images = computed(() => usePage().props.value.images)
        return { images }
    },
}
</script>

<style scoped>

</style>
