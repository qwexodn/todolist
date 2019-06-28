<template>
    <div class='content'>
        <div class='group'>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
            <span></span>
        </div>
    </div>
</template>

<style lang="scss" scoped>
@import "../../sass/_variables.scss";

.content{
    position: fixed;
    height:100vh;
    width:100%;
    background: rgba($color: black, $alpha: 0.3);
    z-index:9999;

    
    .group{
        position:absolute;
        left:50%;
        top:50%;
        transform: translate(-50%, -50%);

        @keyframes show {
            0%{
                transform: translateY(0%);
            }
            30%{
                transform:translateY(-100%);
            }
            60%{
                transform:translateY(0%);
            }
            100%{
                transform:translateY(0%);
            }
        }

        span{
            display: inline-block;
            width:20px;
            height:20px;
            border-radius: 50%;
        }
        span:nth-child(1){
            background-color:red;
            animation: show 1.6s;
            animation-iteration-count: infinite;
            animation-delay: 0s;
        }
        span:nth-child(2){
            background-color:ORANGE;
            animation: show 1.6s;
            animation-iteration-count: infinite;
            animation-delay: 0.2s;
        }
        span:nth-child(3){
            background-color:YELLOW;
            animation: show 1.6s;
            animation-iteration-count: infinite;
            animation-delay: 0.4s;
        }
        span:nth-child(4){
            background-color:GREEN;
            animation: show 1.6s;
            animation-iteration-count: infinite;
            animation-delay: 0.6s;
        }
        span:nth-child(5){
            background-color:BLUE;
            animation: show 1.6s;
            animation-iteration-count: infinite;
            animation-delay: 0.8s;
        }
        span:nth-child(6){
            background-color:INDIGO;
            animation: show 1.6s;
            animation-iteration-count: infinite;
            animation-delay: 1s;
        }
        span:nth-child(7){
            background-color:VIOLET;
            animation: show 1.6s;
            animation-iteration-count: infinite;
            animation-delay: 1.2s;
        }
    }
}


</style>
