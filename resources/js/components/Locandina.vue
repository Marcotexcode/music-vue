<template>
    <div class="container p-3 text-center">
        <h3>Anteprima Locandina</h3>
        <div class="row">
            <div class="col-4">
                <form @submit.prevent="filtroLocandina">
                    <div class="form-group">
                        <label for="data-evento">Data</label>
                        <input type="date" v-model="dataEvento" class="form_input" id="data-evento">
                    </div>
                    <div class="form-group">
                        <label for="ora-evento">Ora</label>
                        <input type="time" v-model="oraEvento" class="form_input" id="ora-evento">
                        <button type="submit" class="btn btn-dark mt-3">Cerca</button>
                    </div>
                </form>
            </div>
            <div v-if="locandina" class="col-4">
                <div class="sfondo_locandina mb-3" id="stampa">
                    <img :src="'/storage/' + locandina.image_path" class="dimensione_immagine" alt="locandina">
                    <div class="mb-4">
                        <h3 class="testo_evento_locandina testo-locandina"><strong>{{locandina.nome_evento}}</strong></h3>
                        <p class="testo_locale_locandina testo-locandina">{{locandina.nome}}</p>
                        <p class="testo-locandina">{{dataLocandina}} | Ore {{oraLocandina}}</p>
                        <p class="testo-locandina">{{locandina.indirizzo}} - {{locandina.provincia}} </p>
                    </div>
                </div>
                <button class="btn btn-dark" @click="stampa()">Stampa</button>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import Printjs from "print-js";
    import moment from 'moment'

    export default ({
        name: "Locandina",

        data() {
            return {
                dataEvento: '',
                oraEvento: '',
                locandina: '',
                dataLocandina: '',
                oraLocandina: '',
            }
        },
        methods: {
            stampa(){
                Printjs({
                    printable: "stampa",
                    type: "html",
                    maxWidth: 1000,
                    targetStyles: ['*'],
                })
            },

            filtroLocandina(){
                axios.post('locandina/filtro', {
                    dataEvento: this.dataEvento,
                    oraEvento: this.oraEvento,
                })
                axios.get('/locandina/lista')
                .then(response => {
                    this.locandina = response.data[0]
                    this.oraLocandina = moment(String(this.locandina.ora), 'HH').format('HH:mm')
                    moment.locale('it')
                    this.dataLocandina = moment(String(this.locandina.data_evento)).format('DD MMMM')
                });
            }
        },
    });

</script>

<style lang="scss" scoped>
    .testo-locandina {
        font-family: monospace;
    }
    .sfondo_locandina {
        background:white;
    }
    .dimensione_immagine {
        width: 100%;
    }
    .testo_evento_locandina {
        font-size: 30px;
        text-transform: uppercase;
    }

    .testo_locale_locandina {
        font-size: 20px;
    }

</style>
