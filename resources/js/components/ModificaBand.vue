<template>
    <div class="container mt-5">
        <div class="card glass text-center">
            <h2>Modifica Band</h2>
            <form @submit.prevent="modificaBand" v-for="lista in datiBand" :key="lista.id">
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome band</label>
                    <input type="text" v-model="band.name_band" class="form-control">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telefono</label>
                    <input type="text" v-model="band.phone_band" class="form-control">
                </div>
                <!-- Tramite l'emit gli passo valore 0 da inserire alla variabile view per tornare alla pagina che mostra la band -->
                <button class="btn btn-primary mt-5" > 
                    <span >Modifica</span> 
                </button>
            </form>
        </div>
    </div>
</template>

<script>
    export default ({
        name: "ModificaBand",
        props: ['cambiaView', 'datiBand'],

        data(){
            return {
                band:[],
            }
        },
        methods: {
            modificaBand() {
                axios.post('/aggiorna-band', { 
                    idBand: this.datiBand[0].id,
                    name_band: this.band.name_band,
                    phone_band: this.band.phone_band, 
                })
                .then(response => {
                    this.$forceUpdate();
                    this.$emit('cambiaView', 0)
                });
            }
        },
    });
</script>

<style lang="scss" scoped>

</style>    