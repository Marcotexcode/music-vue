
<template>
    <div class="container glass rounded mt-5 glass p-5">
        <FullCalendar ref="fullCalendar" :options="calendarOptions" />
        <div>
            <b-modal ref="my-modal" hide-footer :title="band.name_band">
                <form @submit.prevent="creaEvento">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome evento {{band.id}}</label>
                        <input type="text" v-model="titoloEvento" class="form-control">
                        <input type="hidden" v-model="band.id" class="form-control">
                        <input type="hidden" v-model="idEvento" class="form-control">
                        <input type="time" v-model="oraEvento" class="form-control">
                    </div>
                    <button class="btn btn-dark mt-5">
                        <span class="text" v-if="idEvento == ''">Aggiungi evento</span>
                        <span class="text" v-if="idEvento">Modifica Evento</span>
                    </button>
                </form>
                    <button class="btn btn-danger mt-1" v-if="idEvento" @click="eliminaEvento(idEvento)">Elimina evento</button>
            </b-modal>
        </div>
    </div>
</template>

<script>
import '@fullcalendar/core/vdom'
import FullCalendar from '@fullcalendar/vue'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'

export default {
    name: 'Calendario',
    components: {
        FullCalendar
    },
    data() {
        return {
            idEvento: '',
            dataCella: '',
            titoloEvento: '',
            oraEvento: '',
            band:[],
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
        aggiungiEvento(info) {
            // https://vuejs.org/guide/essentials/template-refs.html
            this.$refs['my-modal'].show()
            this.dataCella = info.dateStr
        },

        mostraEventi(info, successCallback) {
            // L'assegnazione destrutturante è una sintassi speciale introdotta in ES6, per assegnare efficacemente dei valori presi da un oggetto.
            const { start, end } = info;
            axios.get("/mostra-eventi", { params: { dataInizio: start, dataFine: end } })
            .then(response => {
                successCallback(response.data)

            })
        },

        eliminaEvento(id) {
            axios.delete('/elimina-evento', {params: {'id': this.idEvento}})
            .then(response => {
                // Svuoto il form
                this.titoloEvento = '',
                this.idEvento = '',
                this.oraEvento = '',
                this.$refs['my-modal'].hide()
                // https://fullcalendar.io/docs/Calendar-refetchEvents
                this.$refs.fullCalendar.getApi().refetchEvents()
            })
        },

        creaEvento() {
            axios.post('/crea-evento', {
                nomeEvento: this.titoloEvento,
                idBand: this.band.id,
                dataEvento: this.dataCella,
                idEvento: this.idEvento,
                oraEvento: this.oraEvento,
            })
            .then(response => {
                // Svuoto il form
                this.titoloEvento = '',
                this.idEvento = '',
                this.oraEvento = '',
                this.$refs['my-modal'].hide()
                // https://fullcalendar.io/docs/Calendar-refetchEvents
                this.$refs.fullCalendar.getApi().refetchEvents()
            })
        },

        modificaEvento(info) {
            this.$refs['my-modal'].show()
            this.titoloEvento = info.event.title
            this.idEvento = info.event.extendedProps.idEvento
            this.dataCella = info.event.startStr
            this.oraEvento = info.event.extendedProps.oraEvento
        }
    },

    created() {
        axios.get('/lista-band')
            .then(response => {
                this.band = response.data[0];
            });
    },
}
</script>


<style lang="css">
    .fc-daygrid-day-number {
        color: black;
        text-decoration: none;
    }
    .fc-col-header-cell-cushion {
        color: black;
        text-decoration: none;
    }
    .fc-theme-standard td, .fc-theme-standard th {
        border: 1px solid black;
    }
    .fc-theme-standard .fc-scrollgrid {
        border: 1px solid black;
        border: 1px solid black;
    }
</style>
