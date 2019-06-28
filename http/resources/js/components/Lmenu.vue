<template>
    <div class='content' :class='{"menu-show":menushow === true, "menu-hide":menushow === false}'>
        <ul class='menu'>
            <li @click='changeList("all")'>전체 리스트<span>{{ allCount }}</span></li>
            <li @click='changeList("stay")'>남은 리스트<span>{{ holdCount }}</span></li>
            <li @click='changeList("clear")'>완료한 리스트<span>{{ clearCount }}</span></li>
        </ul>
        <div class='smoke' :class='{"smoke-show":menushow === true, "smoke-hide":menushow === false}' @click='menuHide()'></div>
    </div>
</template>
<script>
export default {
    props:['todos', 'menushow'],
    computed:{
        allCount(){
            return this.todos.length;
        },
        clearCount(){
            let count = 0;
            this.todos.forEach(list => {
                if(list.state == 'clear')  count++;
            });

            return count;
        },
        holdCount(){
            let count = 0;
            this.todos.forEach(list => {
                if(list.state == 'stay')  count++;
            });

            return count;
        }
    },
    methods:{
        changeList(state){
            this.$emit('showList', state);
        },
        menuHide(){
            this.$emit('menuHide');
        },
        menuLoad(){
            console.log('aa');
            let smoke = document.querySelector('.smoke');

            smoke.style['width'] = `${event.currentTarget.innerWidth}px`;
            smoke.style['height'] = `${event.currentTarget.innerHeight}px`;
        }
    },
    mounted(){
        let smoke = document.querySelector('.smoke');

        smoke.style['width'] = '300%';
        smoke.style['height'] = '100vh';

        window.addEventListener('resize', ()=>{
            let smoke = document.querySelector('.smoke');

            smoke.style['width'] = `${event.currentTarget.innerWidth}px`;
            smoke.style['height'] = `${event.currentTarget.innerHeight}px`;
        });
    },
}
</script>

<style lang="scss" scoped>

.menu-show{
    transform:translateX(100%);
}
.menu-hide{
    transform:translateX(0%);
}

.content{
    display:inline-block;
    width:300px;
    height:100vh;
    position: fixed;
    top:51px;
    left:0px;
    border-right:1px solid rgba($color: #000000, $alpha: 0.1);
    background-color:white;


    .menu{

        li{
            position: relative;
            padding:15px 10px;
            border-bottom:1px solid rgba($color:black, $alpha:0.1);
            vertical-align: middle;
            cursor:pointer;
            transition:transform 0.3s;
            
            span{
                position:absolute;
                right:10px;
                top:50%;
                display:inline-block;
                width:40px;
                height:30px;
                line-height:30px;
                border-radius: 50%;
                text-align:center;
                transform: translateY(-50%);
                background-color:rgba($color:#0040FF, $alpha:0.1);
                color:#797979;
            }
        }

        li:hover{
            background-color:rgba($color:#A9F5F2, $alpha:0.1);
        }
        li:active{
            transform:scale(0.98);
        }
    }

    .smoke{
        position:absolute;
        left:300px;
        top:0px;
        background-color:rgba($color:#000000, $alpha:0.3);
        z-index:999;
    }
    .smoke-show{
        visibility: visible;
    }
    .smoke-hide{
        visibility: hidden;
    }
}

@media (max-width:950px){
    .content{
        left:-300px;
        transition:transform 0.5s;
    }
}
</style>
