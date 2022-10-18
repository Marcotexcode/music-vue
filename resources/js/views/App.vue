<template>
    <div>
        <div class="cont">
            <Sidebar/>
        </div>
    </div>
</template>

<script>

    import Sidebar from '../components/Sidebar';


    export default ({
        name: "App",
        components: {
            Sidebar,
        }
    });

</script>

<style lang="scss" scoped>
    .cont {
        display: flex;
    }
</style>
