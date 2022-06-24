<template>
    <div>
        <div class="w-full min-h-screen bg-gray-800 relative">

            <div class="flex justify-center items-center w-full h-full min-h-screen" v-if="setup">
                <div class="lds-ripple">
                    <div></div>
                    <div></div>
                </div>
            </div>

            <div v-else>
                <div class="animated-title" v-show="intro">
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

                <div class="absolute bottom-0 left-0 w-full flex justify-center py-5">
                    <div class="mx-auto mb-20 text-white text-xl animate-pulse cursor-pointer z-50"
                         @click="introOut"
                         v-show="!fade && intro"
                    >
                        weiter
                    </div>
                </div>
                <div class="block md:hidden z-50" v-if="!intro">
                    <div v-for="slide in slides" :key="slide" class="relative">
                        <Link :href="route('reference.show', {reference: slide.slug })">
                            <div class="w-full bg-cover bg-center"
                                 style="transition: height 1s;"
                                 :class="activeSlug == slide.slug ? 'h-screen' : 'h-48'"
                                 :style="{ backgroundImage: 'url(' + slide.image + ')' }"/>

                            <div class="p-5 text-logo bg-white">
                                <h2 class="text-2xl font-bold" v-text="slide.title"></h2>
                                <p class="text-lg lg:text-xl font-semibold">{{ slide.subtitle }}</p>
                            </div>
                        </Link>
                    </div>
                </div>

                <div class="absolute top-0 left-0 w-full h-full hidden md:block" v-if="!intro">
                    <carousel :items-to-show="toShow" ref="intro" :wrap-around="true">
                        <slide v-for="slide in slides" :key="slide">
                            <div class="h-screen w-full">
                                <Transition name="slide">
                                    <div class="flex items-end p-10 h-screen bg-cover transform transition-all ease-in-out duration-500"
                                         :class="[ bgPos(slide) ]"
                                         :style="{ backgroundImage: 'url(' + slide.image +')' }"
                                         v-show="fade">
                                        <Transition name="fade">
                                            <div v-show="fade" class="text-left mb-24" :class="slide.color == 'logo' ? 'text-logo' : 'text-white'">
                                                <Link :href="route('reference.show', {reference: slide.slug })">
                                                    <h1 class="text-2xl lg:text-3xl xl:text-5xl font-bold pb-5 mb-5 border-b-4 break-all"
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
                            <navigation v-if="slides.length > 1"/>
                        </template>
                    </carousel>
                </div>
            </div>
            <div class="absolute top-0 left-0 w-1/2 max-w-xs">
                <Link :href="route('home')">
                    <img :src="logo" class="w-full h-auto"/>
                </Link>
            </div>

            <Transition name="fade">
                <div class="absolute bottom-1/4 md:bottom-0 left-0 w-full flex justify-between p-10 text-white" v-if="activeSlug != '/' && activeSlug != ''">
                    <Link :href="route('home')" class="text-2xl animate-pulse flex items-center space-x-5">
                        <div class="w-10 h-10 bg-logo rounded-full flex justify-center items-center">
                            <svg class="text-white w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M15.41 16.59L10.83 12l4.58-4.59L14 6l-6 6 6 6 1.41-1.41z"></path>
                            </svg>
                        </div>
                        <span>zurück</span>
                    </Link>
                    <a href="#content" class="text-2xl animate-pulse flex items-center space-x-5">
                        <div class="w-10 h-10 bg-logo rounded-full flex justify-center items-center">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </div>
                    </a>
                </div>
            </Transition>


        </div>
    </div>


    <div id="content" class="my-48">
        <slot/>
    </div>

</template>

<script>
import axios from 'axios'
import 'vue3-carousel/dist/carousel.css';
import {Carousel, Navigation, Pagination, Slide} from 'vue3-carousel';
import {Link} from '@inertiajs/inertia-vue3';
import {Inertia} from '@inertiajs/inertia';

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
            setup: true,
            loaded: [],
            intro: true,
            all_slides: [],
            slides: [],
            fade: false,
            activeSlug: '',
            toShow: 3
        }
    },
    watch: {
        activeSlug(value) {


            if (value == '') {
                this.toShow = 3;
                this.slides = this.all_slides;
            } else {
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
                this.setup = false;
                if (Inertia.page.url != '/') {
                    this.intro = false;
                    this.introOut();
                    setTimeout(() => {
                        this.activeSlug = Inertia.page.url.split('/').pop();
                    }, 500);
                }
            });

        Inertia.on('success', (event) => {
            var url = event.detail.page.url;
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
        currentPage(slug) {
            if (this.activeSlug == '') {
                return '';
            }
            if (this.activeSlug == slug) {
                return 'w-screen h-screen top-0 left-0 z-50 transition-all duration-1000';
            } else {
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


.lds-ripple {
    display: inline-block;
    position: relative;
    width: 80px;
    height: 80px;
}

.lds-ripple div {
    position: absolute;
    border: 4px solid #fff;
    opacity: 1;
    border-radius: 50%;
    animation: lds-ripple 1s cubic-bezier(0, 0.2, 0.8, 1) infinite;
}

.lds-ripple div:nth-child(2) {
    animation-delay: -0.5s;
}

@keyframes lds-ripple {
    0% {
        top: 36px;
        left: 36px;
        width: 0;
        height: 0;
        opacity: 0;
    }
    4.9% {
        top: 36px;
        left: 36px;
        width: 0;
        height: 0;
        opacity: 0;
    }
    5% {
        top: 36px;
        left: 36px;
        width: 0;
        height: 0;
        opacity: 1;
    }
    100% {
        top: 0px;
        left: 0px;
        width: 72px;
        height: 72px;
        opacity: 0;
    }
}
</style>
