<template>
    <div class="container">
        <h3 class="mt-4">Aggiungi Locale</h3>
        <form @submit.prevent="creaLocale">
            <label for="exampleInputEmail1">Nome</label>
            <input type="text" v-model="nomeLocale" class="form-control">

            <label for="exampleInputEmail1">Indirizzo</label>
            <input type="text" v-model="indirizzoLocale" class="form-control">

            <label for="exampleInputEmail1">Provincia</label>
            <input type="text" v-model="provinciaLocale" class="form-control">

            <label for="exampleInputEmail1">Cap</label>
            <input type="text" v-model="capLocale" class="form-control">

            <label for="exampleInputEmail1">Regione</label>
            <input type="text" v-model="regioneLocale" class="form-control">

            <label for="exampleInputEmail1">Telefono</label>
            <input type="text" v-model="telefonoLocale" class="form-control">

            <label for="exampleInputEmail1">Tipo</label>
            <input type="text" v-model="tipoLocale" class="form-control">

            <button class="btn btn-dark mt-4">Crea locale</button>
        </form>
    </div>
</template>

<script>

    export default {
        name: "CreaLocale",
        props: {
            idBand: Number
        },

        data() {
            return {
                nomeLocale: '',
                indirizzoLocale: '',
                provinciaLocale: '',
                capLocale: '',
                regioneLocale: '',
                telefonoLocale: '',
                tipoLocale: '',
                showFalse: false,
            }
        },

        methods: {
            creaLocale() {
                axios.post('locale/salva', {
                    nome: this.nomeLocale,
                    indirizzo: this.indirizzoLocale,
                    provincia: this.provinciaLocale,
                    cap: this.capLocale,
                    regione: this.regioneLocale,
                    telefono: this.telefonoLocale,
                    tipo: this.tipoLocale,
                    band_id: this.idBand,
                }) .then(response => {
                    this.$emit('showFalse', this.showFalse)
                })
            }
        }
    };

</script>

<style lang="scss" scoped>

</style>
