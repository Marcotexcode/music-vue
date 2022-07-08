<template>
    <div>
        <div class="cont">
            <Sidebar/>
            <Main/>
        </div>
    </div>
</template>

<script>

import Sidebar from '../components/Sidebar';
import Main from '../components/Main';


export default ({
    name: "App",
    components: {
        Sidebar,
        Main
    }
});

</script>

<style lang="scss" scoped>
.cont {
    display: flex;
}
</style>
