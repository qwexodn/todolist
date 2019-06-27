<template>
<div class='box'>
    <div class='content'>
        <div class='item con-shadow' :class="{'done':item.state === 'clear', 'stay':item.state === 'stay'}" v-for="item in todos" :key='item.id'>
            <div class='title'>{{ item.title }}</div>
            <div class='udate'>{{ item.udate }}</div>
            <div class='update'>작성일 : {{ item.update }}</div>
            <div class='body' v-html='item.body'></div>
            <div class='input-group'>
                <button class='clear' v-if="item.state === 'stay'" @click='todoClear(item.id)'><i class="fas fa-check"></i></button>
                <button class='hold' v-else-if="item.state === 'clear'" @click='todoHold(item.id)'><i class="fas fa-sync-alt"></i></button>
                <button class='updated'><i class="fas fa-pen"></i></button>
                <button class='delete'><i class="fas fa-trash-alt"></i></button>
            </div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:['todos', 'uid'],
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
        }
    }
}
</script>


<style lang="scss" scoped>
@import '../../sass/_variables.scss';

.box{
    display: flex;
    justify-content: center;
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
            text-align:right;

            button{
                font-size:20px;
                display:inline-block;
                margin-left:10px;
                outline:none;
                transition:transform 0.1s;

                :hover{
                    transform:scale(1.2);
                }
                :active{
                    transform:scale(1);
                }
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

</style>
