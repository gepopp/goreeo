<template>

    <div>
        <div class="w-full min-h-screen bg-gray-800 relative">
            <div class="">
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
            </div>

            <div class="absolute bottom-0 left-0 w-full flex justify-center py-5">
                <div class="mx-auto text-white text-xl animate-pulse cursor-pointer z-50"
                     @click="introOut"
                     v-show="!fade"
                >
                    weiter
                </div>
            </div>

            <div class="absolute top-0 left-0 w-full h-full" v-if="!intro">
                <carousel :items-to-show="3">
                    <slide v-for="slide in slides" :key="slide">
                        <div class="h-screen w-full">
                            <Transition name="slide">
                                <div class="flex items-end p-10 h-screen bg-blue-500 bg-cover" :class="bgPos(slide)" :style="{ backgroundImage: 'url(' + slide.image +')' }" v-show="fade">
                                    <Transition name="fade">
                                        <div v-show="fade" class="text-left mb-24" :class="slide.color == 'logo' ? 'text-logo' : 'text-white'">
                                            <h1 class="text-5xl font-bold pb-5 mb-5 border-b-4"
                                                :class="slide.color == 'logo' ? 'border-logo' : 'border-white'"
                                                v-show="fade">{{ slide.title }}</h1>
                                            <p class="text-xl font-semibold">{{ slide.subtitle }}</p>
                                        </div>
                                    </Transition>
                                </div>
                            </Transition>
                        </div>
                    </slide>

                    <template #addons>
                        <navigation/>
                    </template>

                </carousel>
            </div>


            <div class="absolute top-0 left-0 max-w-xs">
                <img :src="logo" class="w-full h-auto"/>
            </div>
        </div>


    </div>

    <slot/>

</template>

<script>
import axios from 'axios'
import 'vue3-carousel/dist/carousel.css';
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel';

export default {
    name: "Layout",
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
    },
    data() {
        return {
            loaded: [],
            intro: true,
            slides: [],
            fade: false
        }
    },
    mounted() {
        axios.get('references/slides')
            .then((data) => {
                this.slides = data.data;
            });
    },
    computed: {
        logo() {
            return this.$page.props.logo;
        },

    },
    methods: {
        introOut() {
            this.intro = false;
            setTimeout(() => this.fade = true, 500);
        },
        bgPos(slide){
            if(slide.pos == 'left'){
                return 'bg-left';
            }
            if(slide.pos == 'right'){
                return 'bg-right';
            }
            return 'bg-center';
        }
    }
}
</script>

<style scoped>
/* we will explain what these classes do next! */
.slide-enter-active,
.slide-leave-active {
    width: 100%;
    transition: width 1s ease;
}

.slide-enter-from,
.slide-leave-to {
    width: 0 !important;
}

.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
    transition-delay: 1.25s;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
