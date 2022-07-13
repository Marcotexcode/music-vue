<template>
    <div class="container mt-5">
        <div class="card glass text-center" v-for="lista in listaBand" :key="lista.id" v-if="view == 0">
            <div class="card-header">
                <h2 class="text-uppercase">{{lista.name_band}}</h2>
            </div>
            <div class="card-body">
                <img class="img-band" :src="'/image/' + lista.image_path" alt="Card image cap">
                <p class="card-text"> Telefono: {{lista.phone_band}}</p>
                <p class="card-text">Descrizione</p>
                <router-link :to="{name: 'modifica-band', params: { id: lista.id }}" class="btn btn-dark">Modifica</router-link>
            </div>
        </div>
    </div>
</template>

<script>

    export default ({
        name: "Band",

        data() {
            return {
                listaBand: [],
                view: 0,
            }
        },

        // Per aggiungere metodi a un'istanza del componente
        methods: {
            getBand() {
                axios.get('/lista-band')
                .then(response => {
                    this.listaBand = response.data;
                });
            },
            cambiaView(valore) {
                this.view = valore
            }
        },

        // Chiamato dopo che l'istanza ha terminato l'elaborazione di tutte le opzioni relative allo stato.
        created(){
            this.getBand()
        },

    });
</script>

<style lang="scss" scoped>
    @import '../../sass/band/index.scss';

</style>
