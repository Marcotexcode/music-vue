
<template>
    <div class="container glass mt-5 glass p-5">
        <FullCalendar :options="calendarOptions" />
        <div>
            <b-button v-b-modal.modal-1>Launch demo modal</b-button>

            <b-modal id="modal-1" title="BootstrapVue">
                <p class="my-4">Hello from modal!</p>
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
            calendarOptions: {
                plugins: [ dayGridPlugin, interactionPlugin ],
                initialView: 'dayGridMonth',
                dateClick: this.aggiungiEvento,
            }
        }
    },
    methods: {
    aggiungiEvento: function(info) {
      console.log(info);
    }
  }
}
</script>

