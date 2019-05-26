<template>
    <div>
        <div class='action-btn button'><i class="fas fa-pen-alt"></i></div>
        <div class='todolist-edit'>
            <div class='edit-container'>
                <div class='con-name'>list</div>
                <div class='input-case'>
                    <label for="title">title</label>
                    <input id=title type="text" class='todolist-title' @focus="titleFocus()" @blur="titleFocusout()">
                </div>
                <div class='input-case'>
                    <label for="title">text</label>
                    <textarea class='todolist-text' name="" @focus="textFocus()" @blur="textFocusout()" @input="textInput()"></textarea>
                </div>
                <div class='input-cnt'>
                    <span>{{ inputCnt }}</span>/<span>{{ inputMaxCnt }}</span><span class='small'>byte</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { toByte } from "../modules/valueCnt.ts";

export default {
    data(){
        return{
            inputCnt:0,
            inputMaxCnt:200,
            inputMaxRows:9,
        }
    },
    mounted(){
        window.title = document.querySelector('input.todolist-title');
        window.titleParent = title.parentNode;
        window.titleLabel = titleParent.children[0];

        window.text = document.querySelector('textarea.todolist-text');
        window.textParent = text.parentNode;
        window.textLabel = textParent.children[0];
    },
    methods:{
        titleFocus:()=>{
            titleLabel.classList.add('hidden');
        },
        titleFocusout:()=>{
            if(title.value.length > 0)  return;
            titleLabel.classList.remove('hidden');
        },
        textFocus:()=>{
            textLabel.classList.add('hidden');
        },
        textFocusout:()=>{
            if(text.value.length > 0)  return;
            textLabel.classList.remove('hidden');
        },
        textInput(){
            let event = window.event;
            let obj = event.target;
            let value = obj.value;

            let rows = value.split('\n').length;

            
            this.inputCnt = toByte(obj.value);

            if(rows > this.inputMaxRows || this.inputCnt > this.inputMaxCnt){
                obj.value = value.substr(0, value.length-1);
                this.inputCnt = toByte(obj.value);
            }

        },
    }
}
</script>


<style lang="scss" scoped>
input, textarea{
    display:block;
}

.button{
    cursor:pointer;
}

.hidden{
    visibility: hidden;
}
.small{
    font-size:12px;
}

.con-name{
    text-transform: uppercase;
    font-family: 'Nanum Gothic', sans-serif;
    font-size:13px;
    font-weight: 900;
    color:rgba($color: #000000, $alpha: 0.5);
}

.input-case{
    position:relative;
    padding:5px 10px;
    box-sizing: border-box;
    box-shadow: 0 0px 3px 1px #ccc;
    margin:5px 0;
    border-radius: 0.5em;


    label{
        position:absolute;
        left:10px;
        top:8px;
        text-transform: uppercase;
        color:rgba($color: #000000, $alpha: 0.3);
        font-size:15px;
    }
}

.action-btn{
    border-radius: 50%;
    width:55px;
    height:55px;
    background-color:#EAF2F8;
    position:fixed;
    right:10%;
    bottom:7%;
    box-shadow: 2px 2px 5px -1px #333;
    display:flex;
    justify-content: center;
    align-items: center;
    font-size:22px;
    color:rgba($color: #000000, $alpha: 0.6);
}




.todolist-edit{
    position:fixed;
    bottom:-10px;
    left:50%;
    transform:translate(-50%, 0%);
    width:500px;
    height:400px;
    background-color: white;
    border-radius: 0.5em;
    box-shadow: 0px 0px 5px 0.2px #999;


    .edit-container{
        width: 400px;
        height:370px;
        margin: 15px 50px;
        font-family: sans-serif;

        textarea, input[type=text]{
            border:none;
            outline:none;
            color:#666;
            font-size:15px;
        }

        .todolist-title{
            width:100%;
            height:20px;
        }

        .todolist-text{
            width:100%;
            height:150px;
            overflow: hidden;
            resize: none;
        }

        .input-cnt{
            text-align:right;
            font-size:14px;
            color:#797979;
        }
    }
}


</style>
