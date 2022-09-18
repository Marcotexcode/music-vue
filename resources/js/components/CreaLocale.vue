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

            <button v-if="!datiLocale" class="btn btn-dark mt-4">Aggiungi Locale</button>
            <button v-if="datiLocale" class="btn btn-dark mt-4">Modifica Locale</button>
        </form>
        <div id="erroreLocale"></div>
        <button class="btn btn-danger mt-1" v-if="datiLocale" @click="eliminaLocale(datiLocale)">Elimina Locale</button>
    </div>
</template>

<script>

    export default {
        name: "CreaLocale",
        props: ['idBand', 'datiLocale'],

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
                axios.post('locale/salva-modifica', {
                    nome: this.nomeLocale,
                    indirizzo: this.indirizzoLocale,
                    provincia: this.provinciaLocale,
                    cap: this.capLocale,
                    regione: this.regioneLocale,
                    telefono: this.telefonoLocale,
                    tipo: this.tipoLocale,
                    band_id: this.idBand,
                    idLocale: this.datiLocale,
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
                })
            },
            eliminaLocale(idLocale) {
                axios.delete('/locale/elimina', { params: { idLocale: idLocale } })
                .then(response => {
                    this.$emit('showFalse', this.showFalse)
                })
                .catch(error => {
                    erroreLocale.textContent = error.response.data.msg;
                    erroreLocale.classList.add('alert-danger', 'my-1', 'alert')
                })
            }
        },

        created() {
            axios.get('/locale/modifica', { params: { idLocale: this.datiLocale } })
            .then(response => {
                this.nomeLocale = response.data.nome
                this.indirizzoLocale = response.data.indirizzo
                this.provinciaLocale = response.data.provincia
                this.capLocale = response.data.cap
                this.regioneLocale = response.data.regione
                this.telefonoLocale = response.data.telefono
                this.tipoLocale = response.data.tipo
                this.showFalse = false
            });
        }
    };

</script>

<style lang="scss" scoped>

</style>
