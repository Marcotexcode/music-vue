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
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search...">
                <span class="tool_tip">Search</span>
            </li>
            <li>
                <router-link :to="{name: 'home'}" class="text link">
                    <i class="fa-solid fa-house"></i>
                    <span class="links_name">Home</span>
                </router-link>
                <span class="tool_tip">Home</span>
            </li>
            <li>
                <router-link :to="{name: 'calendario'}" class="text link">
                    <i class="fa-solid fa-calendar"></i>
                    <span class="links_name">Calendario</span>
                </router-link>
                <span class="tool_tip">Calendario</span>
            </li>
            <li>
                <router-link :to="{name: 'band'}" class="text link">
                    <i class="fa-solid fa-music"></i>
                    <span class="links_name">Band</span>
                </router-link>
                <span class="tool_tip">Band</span>
            </li>
            <li>
                <router-link :to="{name: 'locandina'}" class="text link">
                    <i class="fa-solid fa-eye"></i>
                    <span class="links_name">Locandina</span>
                </router-link>
                <span class="tool_tip">Locandina</span>
            </li>
            <li>
                <a href="#">
                    <i class="fa-solid fa-user"></i>
                    <span class="links_name">Utente</span>
                </a>
                <span class="tool_tip">Utente</span>
            </li>
        </ul>
        <div class="profile_content">
            <div class="profile">
                <div class="profile_details">
                        <img src="https://d19wu2mwi84gij.cloudfront.net/speaker/image/default_placeholder.jpg" alt="">
                    <div class="name_job">
                        <div class="name"></div>
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
            }
        }
    })

</script>

<style lang="scss" scoped>
    @import '../../sass/vue_sass/sidebar.scss';

</style>
