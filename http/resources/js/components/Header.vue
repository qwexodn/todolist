<template>
    <div class='haeder'>
        <div class='title'>todolist</div>
        <div class="datepick"><i class="far fa-calendar-alt"></i></div>
    </div>
</template>

<script>
    export default {

    }
</script>

<style lang="scss" scoped>
@import '../../sass/common.scss';
@import url('https://fonts.googleapis.com/css?family=Akronim|Nanum+Gothic');

.haeder{
    position: sticky;
    top:0px;
    width:100%;
    height:50px;
    box-shadow:0 -5px 20px 5px rgba(0, 0, 0, 0.3);
    text-align:center;
    font-family: 'Akronim', 'Nanum Gothic', sans-serif;
    
    div{
        position: absolute;
        display: inline-block;
    }

    .title{
        text-transform:uppercase;
        left:50%;
        top:50%;
        transform: translate(-50%, -50%);
    }
    .datepick{

    }
}
</style>
