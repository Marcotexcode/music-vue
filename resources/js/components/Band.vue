<template>
    <div class="container mt-5">
        <div class="card glass text-center" v-for="lista in listaBand" :key="lista.id">
            <div class="card-header">
                <h2 class="text-uppercase">{{lista.name_band}}</h2>
            </div>
            <div class="card-body">
                <h5 class="card-title">Immagine</h5>
                <p class="card-text"> Telefono: {{lista.phone_band}}</p>
                <p class="card-text">Descrizione</p>
                <a href="#" class="btn btn-primary">Modifica</a>
            </div>
        </div>
    </div>
</template>

<script>
    export default ({
        name: "Band",

        data() {
            return {
                listaBand: []
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
                });
            }
        }
    });
</script>

<style lang="scss" scoped>
    @import '../../sass/band/index.scss';

</style>
