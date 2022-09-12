
<template>
    <div class="container mt-5 p-5">
        <FullCalendar ref="fullCalendar" :options="calendarOptions" class="dimensione_calendario rounded" />
        <div>
            <b-modal class="glass" ref="my-modal" hide-footer :title="band.name_band">
                <form @submit.prevent="creaEvento">
                    <div class="form-group glass">
                        <!-- Nome Evento -->
                        <label for="exampleInputEmail1">Titolo evento</label>
                        <div id="errorenomeEvento"></div>
                        <input type="text" v-model="titoloEvento" class="form-control">
                        <input type="hidden" v-model="band.id" class="form-control">
                        <input type="hidden" v-model="idEvento" class="form-control">
                        <!-- Ora -->
                        <label for="exampleInputEmail1">Ora</label>
                        <div id="erroreoraEvento"></div>
                        <input type="time" v-model="oraEvento" class="form-control">
                        <!-- Compenso -->
                        <label for="exampleInputEmail1">Compenso</label>
                        <div id="errorecompenso"></div>
                        <input type="text" v-model="compenso" class="form-control">
                        <!-- Locale -->
                        <label for="exampleInputEmail1">Locale</label>
                        <div id="errorelocale"></div>
                        <select class="form-select" v-model="locale" aria-label="Default select example">
                            <option selected>Scegli</option>
                            <option v-for="locale in locali" :key="locale.id" :value="locale.id">{{ locale.nome}}</option>
                        </select>
                    </div>
                    <button class="btn btn-dark mt-5">
                        <span class="text" v-if="idEvento == ''">Aggiungi evento</span>
                        <span class="text" v-if="idEvento">Modifica Evento</span>
                    </button>
                </form>
                <button class="btn btn-secondary mt-1" @click="show = !show">Aggiungi Locale</button>
                <button class="btn btn-danger mt-1" v-if="idEvento" @click="eliminaEvento(idEvento)">Elimina evento</button>
                <Transition>
                    <CreaLocale v-if="show" :idBand="band.id" @showFalse="chiudiFormLocale"/>
                </Transition>
            </b-modal>
        </div>
    </div>

</template>

<script>
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue'
import CreaLocale from './CreaLocale.vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    name: 'Calendario',
    components: {
        FullCalendar,
        CreaLocale
    },
    data() {
        return {
            idEvento: '',
            dataCella: '',
            titoloEvento: '',
            oraEvento: '',
            compenso: '',
            locale: '',
            show: '',
            band:[],
            locali:[],
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                height: 550,
                locale: 'it',
                weekends: true,
                initialView: 'dayGridMonth',
                events: this.mostraEventi,
                dateClick: this.aggiungiEvento,
                eventClick: this.modificaEvento,
            },

        }
    },
    methods: {
        chiudiFormLocale(ritornaFalse){
            // Alla variabile show gli il valore passato dal parametro
            // Che sarebbe false
            this.show = ritornaFalse;

            // Faccio una chiamata get per riprendere il nuovo elenco
            // di locali
            axios.get('/locale/lista')
            .then(response => {
                this.locali = response.data;
            });
        },

        aggiungiEvento(info) {
            // https://vuejs.org/guide/essentials/template-refs.html
            this.$refs['my-modal'].show()
            this.dataCella = info.dateStr
        },

        mostraEventi(info, successCallback) {
            // L'assegnazione destrutturante è una sintassi speciale introdotta in ES6, per assegnare efficacemente dei valori presi da un oggetto.
            const { start, end } = info;
            axios.get('/evento/lista', { params: { dataInizio: start, dataFine: end } })
            .then(response => {
                // https://fullcalendar.io/docs/events-function
                successCallback(response.data)
            })
        },

        eliminaEvento(id) {
            axios.delete('/evento/elimina', {params: {'id': this.idEvento}})
            .then(response => {
                // Svuoto il form
                this.titoloEvento = '',
                this.idEvento = '',
                this.oraEvento = '',
                this.compenso = '',
                this.locale = '',
                this.$refs['my-modal'].hide()
                // https://fullcalendar.io/docs/Calendar-refetchEvents
                this.$refs.fullCalendar.getApi().refetchEvents()
            })
        },

        creaEvento() {
            axios.post('/evento/salva', {
                nomeEvento: this.titoloEvento,
                idBand: this.band.id,
                dataEvento: this.dataCella,
                idEvento: this.idEvento,
                oraEvento: this.oraEvento,
                compenso: this.compenso,
                locale: this.locale,
            })
            .then(response => {
                // Svuoto il form
                this.titoloEvento = '',
                this.idEvento = '',
                this.oraEvento = '',
                this.compenso = '',
                this.locale = '',
                this.$refs['my-modal'].hide()
                // https://fullcalendar.io/docs/Calendar-refetchEvents
                this.$refs.fullCalendar.getApi().refetchEvents()
            }).catch(function(error) {
                errorenomeEvento.textContent = '';
                erroreoraEvento.textContent = '';
                errorecompenso.textContent = '';
                errorelocale.textContent = '';

                var risposteErrori = error.response.data.errors

                for (const chiave in risposteErrori) {
                    if (chiave) {
                        var errore = document.getElementById('errore' + chiave)
                        errore.innerHTML = risposteErrori[chiave].join("<br>")
                        errore.classList.add('alert-danger', 'my-1')
                    }
                }
            });
        },

        modificaEvento(info) {
            this.$refs['my-modal'].show()
            this.titoloEvento = info.event.title
            this.idEvento = info.event.extendedProps.idEvento
            this.dataCella = info.event.startStr
            this.oraEvento = info.event.extendedProps.oraEvento
            this.compenso = info.event.extendedProps.compenso
            this.locale = info.event.extendedProps.locale
        },
    },

    created() {
        axios.get('/band/lista')
            .then(response => {
                this.band = response.data[0];
            });

        axios.get('/locale/lista')
            .then(response => {
                this.locali = response.data;
            });
    },
}
</script>


<style lang="css">

    .dimensione_calendario {
        width: 1100px;
        padding: 30px;
        background-color: rgb(250 250 250 / 17%);
        backdrop-filter: blur(5px);
    }

    .fc-daygrid-body,
    .fc-daygrid-body-balanced {
        width: 100%;
    }
    .fc-scrollgrid-sync-table {
        width: 100%;
    }

    .fc-daygrid-day-number {
        color: black;
        text-decoration: none;
    }
    .fc-col-header-cell-cushion {
        color: black;
        text-decoration: none;
    }
    .fc-theme-standard td,
    .fc-theme-standard th {
        border: 1px solid black;
    }
    .fc-theme-standard .fc-scrollgrid {
        border: 1px solid black;
        border: 1px solid black;
    }

    /* we will explain what these classes do next! */
    .v-enter-active,
    .v-leave-active {
        transition: opacity 0.5s ease;
    }

    .v-enter-from,
    .v-leave-to {
        opacity: 0;
    }

</style>
