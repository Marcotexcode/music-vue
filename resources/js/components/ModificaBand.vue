<template>
    <div class="container mt-5">
        <div class="card glass text-center">
            <h2>Modifica Band</h2>
            <p>Dati BandPassati: {{datiBand}}</p>
            <form>
                <div class="form-group">
                    <label for="exampleInputEmail1">Nome band</label>
                    <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Telefono</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <!-- Tramite l'emit gli passo valore 0 da inserire alla variabile view per tornare alla pagina che mostra la band -->
                <button type="submit" class="btn btn-primary mt-5" v-on:click="$emit('cambiaView', 0)">Modifica</button>
            </form>
            <!-- <form @submit.prevent="addPost">
      <div class="row">
        <div class="col-md-6">
          <div class="form-group">
            <label>Post Title:</label>
            <input type="text" class="form-control" v-model="post.title">
          </div>
        </div>
        </div>
        <div class="row">
          <div class="col-md-6">
            <div class="form-group">
              <label>Post Body:</label>
              <textarea class="form-control" v-model="post.body" rows="5"></textarea>
            </div>
          </div>
        </div><br />
        <div class="form-group">
          <button class="btn btn-primary">Create</button>
        </div>
    </form> -->
        </div>
    </div>
</template>

<script>
    export default ({
        name: "ModificaBand",
        props: ['cambiaView', 'datiBand'],
        // data(){
        //     return {
        //         post:{}
        //     }
        // },
        // methods: {
        //     addPost(){
        //         console.log(this.post);
        //     }
        // }
    });
</script>

<style lang="scss" scoped>

</style>

