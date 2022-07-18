<template>
    <div class="container mt-5">
        <div class="glass rounded text-center">
            <h2>Modifica Band</h2>
           <form @submit.prevent="modificaBand" class="p-2">
                <div class="form-group d-flex justify-content-center my-4">
                    <img class="img-band" :src="'/storage/' + band.image_path" alt="Card image cap">
                </div>
                <div class="form-group">
                    <label for="telefono"><h3>Cambia immagine</h3></label>
                    <div class="alert alert-danger" v-if="errors && errors.image_path">
                            {{errors.image_path[0]}}
                    </div>
                    <input type="file" class="form-control" v-on:change="onChange">
                    <input type="hidden" v-model="band.image_path" class="form-control" id="nameBand">
                </div>
                <div class="form-group my-4">
                    <label for="nameBand"><h3>Nome Band</h3></label>
                    <div class="alert alert-danger" v-if="errors && errors.name_band">
                            {{errors.name_band[0]}}
                    </div>
                    <input type="text" v-model="band.name_band" class="form-control" id="nameBand">
                </div>
                <div class="form-group">
                    <label for="telefono"><h3>Telefono</h3></label>
                    <div class="alert alert-danger" v-if="errors && errors.phone_band">
                            {{errors.phone_band[0]}}
                    </div>
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
                errors: {}
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
                    console.log(response);
                    // Torna alla view della band
                    this.$router.push({ name: 'band'})
                })
                .catch((error) => {
                    if (error.response.status == 422) {
                        this.errors = error.response.data.errors
                    }
                    console.log(this.errors);
                })
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
