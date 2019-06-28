<template>
    <div>
        <div class='haeder'>
            <div class='user-ip'>IP : {{ userIp }}</div>
            <div class='mobile-menu' @click='menuShow()'><i class="fas fa-bars"></i></div>
            <div class='title'>todolist</div>
        </div>
        <div class='space'></div>
    </div>
</template>

<script>
    import {lpad} from '../modules/strPad.ts';

    let date = new Date();
     
    export default {
        props:['mobile', 'userIp'],
        methods:{
            menuShow(){
                this.$emit('menuShow');
            }
        }
    }
</script>



<style lang="scss" scoped>
@import "../../sass/_variables.scss";

.space{
    margin-top:50px;
}
.haeder{
    position: fixed;
    top:0px;
    left:0px;
    width:100%;
    height:50px;
    box-shadow:0 -5px 5px 5px rgba(0, 0, 0, 0.1);
    text-align:center;
    font-family: 'Nanum Gothic', sans-serif;
    background-color:white;
    
    div{
        position: absolute;
        display: inline-block;
    }

    .user-ip{
        position:absolute;
        left:15px;
        top:50%;
        font-weight:900;
        transform: translateY(-50%);
        font-size: 12px;
        color:rgba($color:black, $alpha:0.4);
    }

    .mobile-menu{
        position:absolute;
        right:15px;
        top:50%;
        transform: translateY(-50%);
        display: inline-block;
        font-size:30px;
        cursor:pointer;
        visibility: hidden;
        color:$indigo;
    }

    .title{
        text-transform:uppercase;
        left:50%;
        top:50%;
        transform: translate(-50%, -50%);
        font-weight: 900;
        font-size:20px;
        color:$indigo;
    }
}

@media (max-width:950px){
    .haeder{

        .mobile-menu{
            visibility: visible;
        }
    }
}
</style>
