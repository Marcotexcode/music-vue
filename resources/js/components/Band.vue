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
            ModificaBand,
        },

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
                    if (this.view == 0) {
                        console.log('ciso');
                    }
                    if(this.view == 1) {
                        console.log('dfafdsfdfd');
                    }
                    this.listaBand = response.data;
                    console.log(this.listaBand);
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
        
        // Chiamato dopo che il componente ha aggiornato il proprio albero DOM a causa di un cambiamento di stato reattivo.
        // updated () {
        //     this.getBand()
        // },

        
    });
</script>

<style lang="scss" scoped>
    @import '../../sass/band/index.scss';

</style>
