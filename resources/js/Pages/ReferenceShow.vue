<template>
    <div v-for="block in reference.content_blocks">
        <div :class="{ 'bg-logo text-white' : block.color == 'logo',  'bg-white text-logo' : block.color !== 'logo' }">
            <TextOnly :data="block" v-if="block.layout == 'text'"/>
            <TextImage :data="block" v-if="block.layout == 'row'"/>
            <Meta :data="block" v-if="block.layout == 'meta'"/>


            <HeroImage :data="block" v-if="block.layout == 'image'"/>


            <TwoImages :data="block" v-if="block.layout == 'images'"/>
        </div>
    </div>
</template>

<script>
import Layout from "../Shared/Layout";
import TextOnly from "../Shared/TextOnly";
import TextImage from "../Shared/TextImage";
import Meta from "../Shared/Meta";
import HeroImage from "../Shared/HeroImage";
import TwoImages from "../Shared/TwoImages";


export default {
    name: "ReferenceShow",
    components: {TwoImages, HeroImage, Meta, TextImage, TextOnly},
    props: ['reference'],
    layout: Layout,
}
</script>

<style scoped>

</style>
