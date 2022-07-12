<template>
    <div class="cont bg-dark" :style="{ width: larghezza + 'px' }">
        <i class="fa-solid button fa-arrow-right" v-if="larghezza == 70" @click="apri"></i>
        <i class="fa-solid button fa-xmark" v-if="larghezza == 250" @click="chiudi"></i>
        <ul class="unordered_list">

            <li class="list">
                <router-link :to="{name: 'home'}" class="text link">
                    <i class="fa-solid icon fa-house"></i>
                    <transition>
                        <span class="text" v-if="larghezza === 250">Home</span>
                    </transition>
                </router-link>
            </li>

            <li class="list">
               <router-link :to="{name: 'calendario'}" class="text link">
                    <i class="fa-solid icon fa-calendar"></i>
                    <transition>
                        <span class="text" v-if="larghezza === 250">Calendario</span>
                    </transition>
                </router-link>
            </li>

            <li class="list">
                <router-link :to="{name: 'band'}" class="text link">
                    <i class="fa-solid icon fa-music"></i>
                    <transition>
                        <span class="text" v-if="larghezza === 250">Band</span>
                    </transition>
                </router-link>
            </li>
        </ul>
    </div>
</template>

<script>

    export default ({
        name: "Sidebar",

        data() {
            return {
                larghezza: 70,
            }
        },
        methods: {
            apri() {
                this.larghezza = 250
            },
            chiudi() {
                this.larghezza = 70
            }
        }
    })

</script>

<style lang="scss" scoped>
    @import '../../sass/vue_sass/sidebar.scss';
    .v-enter-active {
        display: none;
        transition: display 0.5s ease;
    }


</style>
