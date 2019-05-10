<template>
    <div>
        <Header></Header>
        <div class='content'></div>
    </div>
</template>
<script>
import Header from "../components/header";
export default {
    components:{
        Header
    }
}
</script>

<style lang="scss" scoped>
.content{
    width:10px;
    height:10000px;
}
</style>

