<template>
    <div class="container p-3 text-center">
        <h3>Anteprima Locandina</h3>
        <div class="row">
            <div class="col-4">
                <form @submit.prevent="filtroLocandina">
                    <div class="form-group">
                        <label for="data-evento">Data</label>
                        <input type="date" v-model="dataEvento" class="form-control" id="data-evento">
                    </div>
                    <div class="form-group">
                        <label for="ora-evento">Ora</label>
                        <input type="time" v-model="oraEvento" class="form-control" id="ora-evento">
                        <button type="submit" class="btn btn-dark mt-3">Cerca</button>
                    </div>
                </form>
            </div>
            <div v-if="locandina" class="col-4">
                <div class="card mb-3">
                    <img :src="'/storage/' + locandina.image_path" class="card-img-top" alt="locandina">
                    <div class="card-body">
                        <h3 class="card-title testo-locandina"><strong>{{locandina.nome_evento}}</strong></h3>
                        <h6 class="card-text testo-locandina">Locale: {{locandina.nome}}</h6>
                        <h6 class="card-text testo-locandina">{{locandina.indirizzo}} - {{locandina.provincia}} - {{locandina.regione}} - Ore: {{locandina.ora}}</h6>
                    </div>
                </div>
                <button class="btn btn-dark">Stampa</button>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';

    export default ({
        name: "Locandina",

        data() {
            return {
                dataEvento: '',
                oraEvento: '',
                locandina: '',
            }
        },
        methods: {
            filtroLocandina(){
                axios.post('locandina/filtro', {
                    dataEvento: this.dataEvento,
                    oraEvento: this.oraEvento,
                })
                axios.get('locandina/mostra')
                .then(response => {
                    this.locandina = response.data[0]
                });
            }
        },
    });



</script>

<style lang="scss" scoped>
    .testo-locandina {
        font-family: monospace;
    }
</style>
