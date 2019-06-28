<template>
    <div class='haeder'>
        <div class='title'>todolist</div>
    </div>
</template>

<script>
    import {lpad} from '../modules/strPad.ts';

    let date = new Date();
     
    export default {
        components:{
        },
        data(){
            return{
            }
        },
        methods:{
            
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
    
    div{
        position: absolute;
        display: inline-block;
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
</style>
