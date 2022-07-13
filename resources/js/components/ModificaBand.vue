<template>
    <div class="container mt-5">
        <div class="card glass text-center">
            <h2>Modifica Band</h2>
            <!-- @submit.prevent: Previene il comportameto predefinito di invio dei moduli, questo evento impedira il caricamento della pagina -->
            <!-- enctype: Specifica come codificare i dati del modulo durante l'invio al server. -->
            <!-- multipart/form-data: l'attributo ENCTYPE del tag <form> specifica il metodo di codifica per i dati del modulo. È uno dei due modi per codificare il modulo HTML. Viene utilizzato specificamente quando è richiesto il caricamento di file in formato HTML. Invia i dati del modulo al server in più parti a causa delle grandi dimensioni del file.   -->
           <form @submit.prevent="modificaBand" enctype="multipart/form-data">
                <div class="form-group">
                    <img class="img-band" :src="'/image/' + band.image_path" alt="Card image cap">
                    <!-- v-on: Allega un listener di eventi all'elemento. -->
                    <!-- onChange:  -->
                    <input type="file" class="form-control" v-on:change="onChange">
                </div>
                <div class="form-group">
                    <label for="nameBand">Nome band</label>
                    <!-- v-model : La direttiva v-model serve per creare associazioni di dati bidirezionali su elementi di input del modulo,
                     textarea e select, Seleziona automaticamente il modo corretto per aggiornare l'elemento in base al tipo di input -->
                    <input type="text" v-model="band.name_band" class="form-control" id="nameBand">
                </div>
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <!-- v-model : La direttiva v-model serve per creare associazioni di dati bidirezionali su elementi di input del modulo,
                     textarea e select, Seleziona automaticamente il modo corretto per aggiornare l'elemento in base al tipo di input -->
                    <input type="text" v-model="band.phone_band" class="form-control" id="telefono">
                </div>
                <button class="btn btn-dark mt-5">Modifica</button>
            </form>
        </div>
    </div>
</template>

<script>
    // export default : Serve per registrare il componente e per poterlo riutilizzare in seguito, se necessario
    export default ({
        // name : Serve per nominare il coponente
        name: "ModificaBand",

        // data() : Ogni proprietà all'interno di quell'oggetto viene aggiunta al sistema di reattività Vue in modo che se cambiamo quel valore della proprietà, vuejs esegue nuovamente il rendering del dom con i dati aggiornati.
        data(){
            return {
                // band : Inizializzo un array
                band:[],
                file: '',
            }
        },
        // methods : E' un oggetto associato all'istanza Vue. Le funzioni sono definite all'interno dell'oggetto methods. I metodi sono utili quando è necessario eseguire alcune azioni con la direttiva v-on su un elemento per gestire gli eventi. Le funzioni definite all'interno dell'oggetto metodi possono essere ulteriormente richiamate per eseguire azioni.
        methods: {
            onChange(e) {
                this.file = e.target.files[0];
            },
            // modificaBand : Funzione utilizzata per fare una chiamata axios
            modificaBand() {
                // FormData : L' interfaccia FormData fornisce un modo per costruire facilmente un insieme di coppie chiave/valore che rappresentano i campi del modulo ei relativi valori. Utilizza lo stesso formato che utilizzerebbe un modulo se il tipo di codifica fosse impostato su "multipart/form-data".
                const formData = new FormData()
                
                // Aggiunge un nuovo valore a una chiave esistente all'interno di un oggetto FormData o aggiunge la chiave se non esiste già.
                formData.append('image_path', this.file)
                // this : In JavaScript, la parola chiave this fa riferimento a un oggetto
                // $ : All' interno di un instanza Vue, hai accesso all'instanza del router come $router.
                formData.append('idBand', this.$route.params.id)
                formData.append('name_band', this.band.name_band)
                formData.append('phone_band', this.band.phone_band)


                // axios : Axios è un client HTTP basato su promise (promesse: eventuale completamento (o fallimento) di un'operazione asincrona e il suo valore risultante) per il browser e Node.js. Ha la capacità di effettuare richieste HTTP dal browser e gestire la trasformazione dei dati di richiesta e risposta.
                axios.post('/aggiorna-band', formData, {

                    // headers: {
                    //     "Content-Type": "multipart/form-data",
                    // },
                })
                // then : Il metodo then restituisce una risposta che ha esito positivo
                .then(response => {
                    // this : In javascript, la parola chiave this fa riferimento a un oggetto
                    // $ : All'interno di un instanza Vue, hai accesso all'instanza Del router come $router. Quindi il metodo viene chiamato $router.push()
                    // router.push : Un metodo che serve per passare a un url diverso
                    this.$router.push({ name: 'band'})
                });
            }
        },

        // created : Opzione chiamata in modo sincrono (sincrono: il processo rimane in attesa che questo venga eseguito e (solitamente) gli venga fornita una risposta.) dopo la creazione dell' instanza
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
