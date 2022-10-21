<template>
    <div class="sidebar"  :class="{ active: isActive }">
        <div class="logo_content">
            <a class="logo" href="#">
                <i class="fa-brands fa-reddit"></i>
                <div class="logo_name">Music Date</div>
            </a>
            <a v-if="isActive == false" @click="open">
                <i class="fa-solid fa-bars" id="btn"></i>
            </a>
            <a v-if="isActive == true" @click="close">
                <i class="fa-solid fa-bars" id="btn"></i>
            </a>
        </div>
        <ul class="nav_list">
            <li>
                <form action="" method="post" @submit.prevent="getPagine">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" v-model="filtroPagine"  placeholder="Search...">
                    <span class="tool_tip">Search</span>
                </form>
            </li>
            <li v-for="listaPagina in listaPagine" :key="listaPagina">
                <router-link :to="{name: listaPagina.link}" class="text link">
                    <i :class="listaPagina.font"></i>
                    <span class="links_name">{{listaPagina.name}}</span>
                </router-link>
                <span class="tool_tip">{{listaPagina.toll}}</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                    <img :src="'/storage/' + utente.img_profilo" alt="">
                    <div class="name_job">
                        <div class="name">{{utente.name}}</div>
                        <div class="job">Tipo amministratore</div>
                    </div>
                </div>
                <a @click="logout"><i class="fa-solid fa-arrow-right-from-bracket" id="log_out"></i></a>
            </div>
        </div>
    </div>
</template>

<script>

    export default ({
        name: "Sidebar",

        data() {
            return {
                isActive: false,
                utente: '',
                filtroPagine: '',
                listaPagine: []
            }
        },
        methods: {
            open() {
                this.isActive = true
            },
            close() {
                this.isActive = false
            },
            logout() {
                axios.post('/logout')
                    .then(() => location.href = '/')
            },
            getUser() {
                axios.get('/sidebar/lista-utente')
                .then(response => {
                   this.utente = response.data[0];
                });
            },
            getPagine() {
                axios.post('/sidebar/filtro', {
                    filtroPagine: this.filtroPagine,
                });

                axios.get('/sidebar/lista-pagine')
                .then(response => {
                   this.listaPagine = response.data
                });
            },
        },
        created(){
            this.getUser()
            this.getPagine()
        },
    })

</script>

<style lang="scss" scoped>
    @import '../../sass/vue_sass/sidebar.scss';

</style>
