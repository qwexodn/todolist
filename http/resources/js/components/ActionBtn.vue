<template>
    <div>
        <div class='action-btn button' @click="actionToggle()"><i class="fas fa-pen-alt"></i></div>
        <div class='todolist-edit edit-hide con-shadow'>
            <div class='edit-container'>
                <div class="datepick input-shadow">
                    <datePicker v-model="date" :config="options"></datePicker>
                </div>
                <div class='con-name'>list</div>
                <div class='input-case input-shadow'>
                    <label for="title">title</label>
                    <input id=title type="text" class='todolist-title' @focus="titleFocus()" @blur="titleFocusout()">
                </div>
                <div class='input-case input-shadow'>
                    <label for="title">text</label>
                    <textarea class='todolist-text' name="" @focus="textFocus()" @blur="textFocusout()" @input="textInput()"></textarea>
                </div>
                <div class='input-cnt'>
                    <span>{{ inputCnt }}</span>/<span>{{ inputMaxCnt }}</span><span class='small'>byte</span>
                </div>
                <div class='input-btn'>
                    <button class='input-shadow'>ok</button>
                    <button class='input-shadow' @click="cancelClick()">cancel</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { toByte } from "../modules/valueCnt.ts";

//  Bootstrap datepicker 컴포넌트, css
import 'bootstrap/dist/css/bootstrap.css';
import datePicker from 'vue-bootstrap-datetimepicker';
import 'pc-bootstrap4-datetimepicker/build/css/bootstrap-datetimepicker.css';

export default {
    components:{
        datePicker
    },
    data(){
        return{
            inputCnt:0,
            inputMaxCnt:200,
            inputMaxRows:9,
            date:new Date(),
            options:{
                format: 'YYYY/MM/DD',
                useCurrent:false,
            }
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
        cancelClick(){
            let title = document.querySelector('.todolist-title')
            let txt = document.querySelector('.todolist-text')
            let list = document.querySelector('.todolist-edit')

            this.date = new Date();
            this.inputCnt = 0;

            title.value = '';
            titleLabel.classList.remove('hidden');

            txt.value = '';
            textLabel.classList.remove('hidden');

            list.classList.remove('edit-show');
            list.classList.add('edit-hide');
        },
        actionToggle(){
            let list = document.querySelector('.todolist-edit');

            if(list.className.split(' ').indexOf('edit-show') == -1){
                list.classList.add("edit-show");
                list.classList.remove("edit-hide");
            }else{
                list.classList.remove('edit-show');
                list.classList.add("edit-hide");
            }
        },
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
@import '../../sass/_variables.scss';

input, textarea{
    display:block;
}

button{
    height:30px;
    width:80px;
    vertical-align: middle;
    text-transform:uppercase;
    font-size:13px;
    font-family: sans-serif;
    font-weight: 900;
    outline: none;
    background-color:white;
    color:$inputColor;
}
button:active{
    background-color:$inputColor;
    color:white;
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

.input-btn{
    margin-top:30px;
    text-align:right;
}

.input-case{
    position:relative;
    padding:5px 10px;
    box-sizing: border-box;
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
    z-index:1;
}



.edit-show{
    bottom:-10px;
}

.edit-hide{
    bottom:-500px;
}

.form-control{
    border-radius: 3em;
    height:30px;
    margin:10px 0;
}
.form-control:focus{
    box-shadow: none;
}

.todolist-edit{
    position:fixed;
    left:50%;
    transform:translate(-50%, 0%);
    width:500px;
    height:400px;
    background-color: white;
    border-radius: 0.5em;
    transition: bottom 0.3s;


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
