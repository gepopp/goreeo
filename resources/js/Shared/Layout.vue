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
                <carousel :items-to-show="toShow" ref="intro" :wrap-around="true">
                    <slide v-for="slide in slides" :key="slide">
                        <div class="h-screen w-full">
                            <Transition name="slide">
                                <div class="flex items-end p-10 h-screen bg-cover transform transition-all ease-in-out duration-500"
                                     :class="[ bgPos(slide), currentPage(slide.slug) ]"
                                     :style="{ backgroundImage: 'url(' + slide.image +')' }"
                                     v-show="fade">
                                    <Transition name="fade">
                                        <div v-show="fade" class="text-left mb-24" :class="slide.color == 'logo' ? 'text-logo' : 'text-white'">
                                            <Link :href="route('reference.show', {reference: slide.slug })">
                                                <h1 class="text-2xl lg:text-5xl font-bold pb-5 mb-5 border-b-4 break-all"
                                                    :class="slide.color == 'logo' ? 'border-logo' : 'border-white'"
                                                    v-show="fade">{{ slide.title }}</h1>
                                                <p class="text-lg lg:text-xl font-semibold h-48">{{ slide.subtitle }}</p>
                                            </Link>
                                        </div>
                                    </Transition>
                                </div>
                            </Transition>
                        </div>
                    </slide>

                    <template #addons>
                        <navigation v-if="slides.length > 1" />
                    </template>

                </carousel>
            </div>


            <div class="absolute top-0 left-0 max-w-xs">
                <Link :href="route('home')">
                    <img :src="logo" class="w-full h-auto"/>
                </Link>
            </div>
        </div>
    </div>

    <slot/>

</template>

<script>
import axios from 'axios'
import 'vue3-carousel/dist/carousel.css';
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel';
import { Link } from '@inertiajs/inertia-vue3';
import { Inertia } from '@inertiajs/inertia';
import { ref } from "vue";

export default {
    name: "Layout",
    components: {
        Carousel,
        Slide,
        Pagination,
        Navigation,
        Link,
        Inertia
    },
    data() {
        return {
            loaded: [],
            intro: true,
            all_slides: [],
            slides: [],
            fade: false,
            activeSlug: '',
            toShow: 3
        }
    },
    watch:{
        activeSlug(value){


            if(value == ''){
                this.toShow = 3;
                this.slides = this.all_slides;
            }else{
                this.toShow = 1;
                this.slides = this.all_slides.filter((slide) => slide.slug == this.activeSlug);
            }
            this.$refs.intro.restartCarousel();
            this.$refs.intro.slideTo(0);
        }
    },
    mounted() {
        axios.get(route('reference.slides'))
            .then((data) => {
                this.all_slides = this.slides = data.data;
            });

        Inertia.on('success', (event) => {
            var url =  event.detail.page.url;
            this.activeSlug = url.split('/').pop();
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
        bgPos(slide) {
            if (slide.pos == 'left') {
                return 'bg-left';
            }
            if (slide.pos == 'right') {
                return 'bg-right';
            }
            return 'bg-center';
        },
        currentPage(slug){
            if(this.activeSlug == ''){
                return '';
            }
            if(this.activeSlug == slug){
                return 'absolute w-screen h-screen top-0 left-0 z-50';
            }else{
                return '';
            }

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
