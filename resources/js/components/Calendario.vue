
<template>
    <div class="container glass rounded mt-5 glass p-5">
        <FullCalendar ref="fullCalendar" :options="calendarOptions" />
        <div>
            <b-modal ref="my-modal" hide-footer :title="'Aggiungi Evento: ' + band.name_band">
                <form @submit.prevent="creaEvento">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nome evento {{band.id}}</label>
                        <input type="text" v-model="nome_evento" class="form-control" id="exampleInputEmail1">
                        <input type="hidden" v-model="band.id" class="form-control" id="exampleInputEmail1">
                    </div>
                    <button class="btn btn-dark mt-5">Aggiungi evento</button>
                </form>
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
            nome_evento: '',
            data_evento: '',
            dataCella: '',
            band:[],
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                editable: true,
                selectable: true,
                selectMirror: true,
                dayMaxEvents: true,
                weekends: true,
                initialView: 'dayGridMonth',
                events: this.mostraEventi,
                dateClick: this.aggiungiEvento,
            },
        }
    },
    methods: {
        aggiungiEvento(info) {
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

        creaEvento() {
            axios.post('/crea-evento', {
                nomeEvento: this.nome_evento,
                idBand: this.band.id,
                dataEvento: this.dataCella,
            })
            .then(response => {
                this.$refs['my-modal'].hide()
                this.$refs.fullCalendar.getApi().refetchEvents()
            })
            .catch((error) => {
            })
        },
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
