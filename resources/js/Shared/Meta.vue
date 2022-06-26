<template>

    <div class="fixed top-1/2 right-0 border-t-4" id="middle"></div>


    <div class="flex flex-col lg:flex-row">
        <div class="w-full lg:w-3/4">
            <TextOnly :data="data"></TextOnly>
        </div>
        <div class="w-full lg:w-1/4 flex flex-col justify-center items-center text-xl" :class="data.color == 'white' ? 'bg-logo text-white' : 'bg-white text-logo'">
            <Transition name="fade">
                <ul class="px-5 py-48 lg:py-0" :id="'meta-' + data.id">
                    <li v-for="entry in metaarray" class="mb-10" v-show="show">
                        <p v-text="entry[0]" class="leading-tight font-semibold"></p>
                        <p v-text="entry[1]" class="leading-tight"></p>
                    </li>
                </ul>
            </Transition>
        </div>
    </div>
</template>

<script>
import TextOnly from "./TextOnly";

export default {
    name: "Meta",
    components: {TextOnly},
    props: ['data'],
    data() {
        return {
            show: false,
        }
    },
    computed: {
        metaarray() {
            return Object.entries(this.data.meta);
        }
    },
    mounted() {

        const id = this.data.id;

        document.addEventListener('scroll', () => {
            var middle_offset = document.getElementById('middle').getBoundingClientRect().top;
            var metaoffset = document.getElementById('meta-' + id).getBoundingClientRect().top;

            if (metaoffset - middle_offset < 100) {
                this.show = true;
            }else if((metaoffset - middle_offset) < screen.height || (metaoffset - middle_offset) > screen.height ){
                this.show = false;
            }
        });
    }
}
</script>

<style scoped>
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease;
}

.fade-enter-active:nth-child(2) {
    transition-delay: 0.5s ;
}
.fade-enter-active:nth-child(3) {
    transition-delay: 1s ;
}

.fade-enter-active:nth-child(4) {
    transition-delay: 1.5s ;
}


.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}
</style>
