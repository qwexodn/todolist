<template>
<div class='box'>
    <div class='content'>
        <div class='item con-shadow'
            :class="{'done':item.state === 'clear', 'stay':item.state === 'stay'}" 
            v-for="item in todos" 
            v-if=" show === item.state || show === 'all'"
            :key='item.id' 
        >
            <div class='title'>{{ item.title }}</div>
            <div class='udate'>{{ item.udate }}</div>
            <div class='update'>작성일 : {{ item.update }}</div>
            <div class='body' v-html='item.body'></div>
            <div class='input-group'>
                <button class='clear' v-if="item.state === 'stay'" @click='todoClear(item.id)'><i class="fas fa-check"></i></button>
                <button class='hold' v-else-if="item.state === 'clear'" @click='todoHold(item.id)'><i class="fas fa-sync-alt"></i></button>
                <button class='updated' @click="todoUpdate(item.id, item.title, item.body, item.udate)"><i class="fas fa-pen"></i></button>
                <button class='delete' @click='todoDelete(item.id)'><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
import { eventBus } from '../app';

export default {
    props:['todos', 'uid', 'show'],
    data(){
        return{
            
        }
    },
    methods:{
        todoClear(index){
            let post = {
                'uid':this.uid,
                'index':index
            }

            fetch('/api/todoClear',{
                headers:{
                    'content-type':'application/json',
                    'accept':'application/json'
                },
                method:'post',
                body:JSON.stringify(post)
            }).then((response)=>{
                if(response.ok){
                    this.$emit('listupdate');
                }
            })
        },
        todoHold(index){
            let post = {
                'uid':this.uid,
                'index':index
            }

            fetch('/api/todoHold',{
                headers:{
                    'content-type':'application/json',
                    'accept':'application/json'
                },
                method:'post',
                body:JSON.stringify(post)
            }).then((response)=>{
                if(response.ok){
                    this.$emit('listupdate');
                }
            })
        },
        todoUpdate(index, title, body, udate){
            eventBus.listUpdate(index, title, body, udate);
        },
        todoDelete(index){
            if(confirm('리스트를 삭제 하시겠습니까?')){
                let post = {
                    'uid':this.uid,
                    'index':index
                }

                fetch('/api/todoDelete',{
                    headers:{
                        'content-type':'application/json',
                        'accept':'application/json'
                    },
                    method:'post',
                    body:JSON.stringify(post)
                }).then((response)=>{
                    if(response.ok){
                        this.$emit('listupdate');
                    }
                })
            }
        }
    }
}
</script>


<style lang="scss" scoped>
@import '../../sass/_variables.scss';

.box{
    
    display: inline-block;
    position:absolute;
    left:50%;
    transform: translateX(-50%);
        z-index:-1;
}
.content{
    width:600px;
    border:none;
    margin:10px 0;
    
    .done{
        background-color:rgba($color: #000000, $alpha: 0.3);
    }

    .stay{
        background-color:white;
    }

    .item{
        height:200px;
        border-radius: 0.5em;
        margin:5px 0;
        padding:10px;
        box-sizing:border-box;
        position:relative;

        .title, .udate, .update, .body{
            all:unset;
            font-family:sans-serif;
            color: #434343;
        }
        .title, .udate{
            display:inline-block;
        }
        .update, .body{
            display:block;
        }
        .title{
            font-size:17px;
            font-weight:700;
            min-width:390px;
            color:$blue;
        }
        .udate{
            font-size:15px;
            font-weight:700;
            text-align: right;
            min-width:170px;
        }
        .update{
            font-size:12px;
            text-align: right;
            margin:5px;
        }
        .body{
            font-size:15px;
            text-align:left;
            word-wrap: break-word;
            min-height:110px;
        }

        .input-group{
            display: block;
            position:absolute;
            text-align: right;
            right:10px;
            bottom:10px;

            button{
                font-size:20px;
                display:inline-block;
                margin-left:10px;
                outline:none;
                transition:transform 0.1s;
                padding:5px;

                
            }

            button:hover{
                    transform:scale(1.2);
            }
            button:active{
                transform:scale(1);
            }

            .clear{
                color:$blue;
            }
            .hold{
                color:rgba($color: #228B22, $alpha: 0.5);
            }
            .updated{
                color:rgba($color: #D2691E, $alpha: 0.5);
            }
            .delete{
                color:rgba($color: #FF0000, $alpha: 0.5);
            }
        }
    }
}

@media (max-width: 1400px) {
    .box{
        margin-left:150px;
    }
}
@media (max-width:950px){
    .box{
        margin-left:0px;
    }
}

@media (max-width:700px){
    .box{
        .content{
            width:400px;

            .title, .udate{
                display:block;
            }
        }
    }
}

</style>
