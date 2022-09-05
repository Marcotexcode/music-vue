<template>
    <div class="container">
        <h3 class="mt-4">Aggiungi Locale</h3>
        <form @submit.prevent="creaLocale">
            <label for="exampleInputEmail1">Nome</label>
            <div id="errorenome"></div>
            <input type="text" v-model="nomeLocale" class="form-control">

            <label for="exampleInputEmail1">Indirizzo</label>
            <div id="erroreindirizzo"></div>
            <input type="text" v-model="indirizzoLocale" class="form-control">

            <label for="exampleInputEmail1">Provincia</label>
            <div id="erroreprovincia"></div>
            <input type="text" v-model="provinciaLocale" class="form-control">

            <label for="exampleInputEmail1">Cap</label>
            <div id="errorecap"></div>
            <input type="text" v-model="capLocale" class="form-control">

            <label for="exampleInputEmail1">Regione</label>
            <div id="erroreregione"></div>
            <input type="text" v-model="regioneLocale" class="form-control">

            <label for="exampleInputEmail1">Telefono</label>
            <div id="erroretelefono"></div>
            <input type="text" v-model="telefonoLocale" class="form-control">

            <label for="exampleInputEmail1">Tipo</label>
            <div id="erroretipo"></div>
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
                }).then(response => {
                    this.$emit('showFalse', this.showFalse)
                }).catch(function(error) {
                    errorenome.textContent = '';
                    erroreindirizzo.textContent = '';
                    erroreprovincia.textContent = '';
                    errorecap.textContent = '';
                    erroreregione.textContent = '';
                    erroretelefono.textContent = '';
                    erroretipo.textContent = '';

                    var risposteErrori = error.response.data.errors

                    for (const chiave in risposteErrori) {
                        if (chiave) {
                            var errore = document.getElementById('errore' + chiave)
                            errore.innerHTML = risposteErrori[chiave].join("<br>")
                            errore.classList.add('alert-danger', 'my-1')
                        }
                    }
                });
            }
        }
    };

</script>

<style lang="scss" scoped>

</style>
