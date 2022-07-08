<template>
    <div class="cont bg-dark" :style="{ width: larghezza + 'px' }">
        <i class="fa-solid button fa-arrow-right" v-if="larghezza == 70" @click="apri"></i>
        <i class="fa-solid button fa-xmark" v-if="larghezza == 250" @click="chiudi"></i>
        <ul class="unordered_list">
            <li class="list"><a class="link" href=""><i class="fa-solid icon fa-house"></i>
                <transition>
                    <router-link to="/home" class="text" v-if="larghezza === 250">Home</router-link>
                </transition>
            </a></li>
            <li class="list"><a class="link" href=""><i class="fa-solid icon fa-calendar"></i>
                <transition>
                   <router-link to="/calendario" class="text" v-if="larghezza === 250">Calendario</router-link>
                </transition>
            </a></li>
            <li class="list"><a class="link" href=""><i class="fa-solid icon fa-music"></i>
                <transition>
                    <router-link to="/band" class="text" v-if="larghezza === 250">Band</router-link>
                </transition>
            </a></li>
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
