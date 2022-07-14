<template>
    <div class="container mt-5">
        <div class="card glass text-center">
            <h2>Modifica Band</h2>
           <form @submit.prevent="modificaBand">
                <div class="form-group">
                    <img class="img-band" :src="'/storage/' + band.image_path" alt="Card image cap">
                    <input type="file" class="form-control" v-on:change="onChange">
                    <input type="hidden" v-model="band.image_path" class="form-control" id="nameBand">
                </div>
                <div class="form-group">
                    <label for="nameBand">Nome band</label>
                    <input type="text" v-model="band.name_band" class="form-control" id="nameBand">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" v-model="band.phone_band" class="form-control" id="telefono">
                </div>
                <button class="btn btn-dark mt-5">Modifica</button>
            </form>
        </div>
    </div>
</template>

<script>
    export default ({
        name: "ModificaBand",

        data(){
            return {
                band:[],
                immagine: '',
            }
        },

        methods: {
            onChange(e) {
                this.immagine = e.target.files[0];
            },
            modificaBand() {
                const formData = new FormData()

                formData.append('image_path', this.immagine)
                formData.append('img_vecchia', this.band.image_path)
                formData.append('idBand', this.$route.params.id)
                formData.append('name_band', this.band.name_band)
                formData.append('phone_band', this.band.phone_band)

                axios.post('/aggiorna-band', formData)
                .then(response => {
                    // Torna alla view della band
                    this.$router.push({ name: 'band'})
                });
            }
        },

        created() {
            axios.get('/lista-band')
                .then(response => {
                    this.band = response.data[0];
                });
        },
    });
</script>

<style lang="scss" scoped>

</style>
