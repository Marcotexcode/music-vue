<template>
    <div class="container mt-5">
        <div class="card glass text-center" v-for="lista in listaBand" :key="lista.id" v-if="view == 0">
            <div class="card-header">
                <h2 class="text-uppercase">{{lista.name_band}}</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{lista.image_path}}</h5>
                <img class="img-band" :src="imageBand" alt="Card image cap">
                <p class="card-text"> Telefono: {{lista.phone_band}}</p>
                <p class="card-text">Descrizione</p>
                <a href="#" class="btn btn-primary" @click="view = 1">Modifica</a>
            </div>
        </div>
        <div v-else>
           <ModificaBand :cambiaView="view" :datiBand="listaBand" @cambiaView="cambiaView"/>
        </div>
    </div>
</template>

<script>
    import ModificaBand from "./ModificaBand.vue";

    export default ({
        name: "Band",

        components: {
            ModificaBand
        },

        data() {
            return {
                listaBand: [],
                imageBand: 0,
                view: 0
            }
        },

        created(){
            this.getBand()
        },

        methods: {
            getBand() {
                axios.get('/lista-band')
                .then(response => {
                    this.listaBand = response.data;
                    this.imageBand = '/image/' + response.data[0].image_path;
                });
            },
            cambiaView(valore) {
                this.view = valore
            }
        }
    });
</script>

<style lang="scss" scoped>
    @import '../../sass/band/index.scss';

</style>
