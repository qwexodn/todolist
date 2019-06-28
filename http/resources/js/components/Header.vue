<template>
    <div class='haeder'>
        <div class='mobile-menu' @click='menuShow()'><i class="fas fa-bars"></i></div>
        <div class='title'>todolist</div>
    </div>
</template>

<script>
    import {lpad} from '../modules/strPad.ts';

    let date = new Date();
     
    export default {
        props:['mobile'],
        components:{
        },
        data(){
            return{
            }
        },
        methods:{
            menuShow(){
                this.$emit('menuShow');
            }
        }
    }
</script>



<style lang="scss" scoped>
@import "../../sass/_variables.scss";

.haeder{
    position: sticky;
    top:0px;
    width:100%;
    height:50px;
    box-shadow:0 -5px 5px 5px rgba(0, 0, 0, 0.1);
    text-align:center;
    font-family: 'Nanum Gothic', sans-serif;
    background-color:white;
    color:$indigo;
    
    div{
        position: absolute;
        display: inline-block;
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
    }

    .title{
        text-transform:uppercase;
        left:50%;
        top:50%;
        transform: translate(-50%, -50%);
        font-weight: 900;
        font-size:20px;
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
