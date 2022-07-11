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
        </div>
    </div>
</template>

<script>
    export default ({
        name: "ModificaBand",
        props: ['cambiaView', 'datiBand'],
    });
</script>

<style lang="scss" scoped>

</style>

