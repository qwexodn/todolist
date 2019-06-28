<template>
    <div>
        <div class='action-btn button action-btn-show' @click="actionToggle()"><i class="fas fa-pen-alt"></i></div>
        <div class='todolist-edit edit-hide con-shadow'>
            <div class='cancel-btn input-shadow button' @click="cancelClick()"><i class="fas fa-times"></i></div>
            <div class='edit-container'>
                <form name='fm'>
                    <div class='con-name'>date</div>
                    <div class="datepick input-shadow">
                        <datePicker v-model="date" :config="options"></datePicker>
                    </div>
                    <div class='con-name'>list</div>
                    <div class='input-case input-shadow'>
                        <label>title</label>
                        <input name='title' id=title type="text" v-model='title' class='todolist-title' @focus="titleFocus()" @blur="titleFocusout()">
                    </div>
                    <div class='input-case input-shadow'>
                        <label>text</label>
                        <textarea name='body' class='todolist-text' v-model='body' @focus="textFocus()" @blur="textFocusout()" @input="textInput()"></textarea>
                    </div>
                    <div class='input-cnt'>
                        <span>{{ inputCnt }}</span>/<span>{{ inputMaxCnt }}</span><span class='small'>byte</span>
                    </div>
                </form>
                <div class='input-btn'>
                    <button class='input-shadow' @click="listAdd()">ok</button>
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
import {lpad} from '../modules/strPad.ts';
import { eventBus } from '../app';

let date = new Date;

export default {
    props:['uid'],
    components:{
        datePicker
    },
    created(){
        eventBus.$on('listUpdate', (index, title, body, udate) => {
            let list = document.querySelector('.todolist-edit');
            
            this.index = index;
            this.date = udate;
            this.body = body;
            this.title = title;

            list.classList.add('edit-show');
            list.classList.remove("edit-hide");
        })
    },
    data(){
        return{
            inputCnt:0,
            inputMaxCnt:200,
            inputMaxRows:9,
            date:`${date.getFullYear()}-${lpad(date.getMonth()+1, 2, '0')}-${date.getDate()}`,
            options:{
                format: 'YYYY/MM/DD',
                useCurrent:false,
            },
            index:0,
            title:null,
            body:null,
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
            let actionBtn = document.querySelector('.action-btn');

            this.date = `${date.getFullYear()}-${lpad(date.getMonth()+1, 2, '0')}-${date.getDate()}`;
            this.inputCnt = 0;

            this.title = null;
            titleLabel.classList.remove('hidden');

            this.body = null;
            textLabel.classList.remove('hidden');

            this.index = 0;

            list.classList.remove('edit-show');
            list.classList.add('edit-hide');
            
            actionBtn.classList.add('action-btn-show');
            actionBtn.classList.remove('action-btn-hide');
        },
        actionToggle(){
            let list = document.querySelector('.todolist-edit');
            let actionBtn = document.querySelector('.action-btn');

            if(list.className.split(' ').indexOf('edit-show') == -1){
                list.classList.add("edit-show");
                list.classList.remove("edit-hide");
                actionBtn.classList.add('action-btn-hide');
                actionBtn.classList.remove('action-btn-show');
            }else{
                list.classList.remove('edit-show');
                list.classList.add("edit-hide");
                actionBtn.classList.add('action-btn-show');
                actionBtn.classList.remove('action-btn-hide');
            }
        },
        listAdd(){
            let form = document.fm;
            let list = document.querySelector('.todolist-edit');

            if(this.index == 0){
                let post = {
                    title:form.title.value,
                    body:form.body.value.split('\n').join('<br>'),
                    uid:this.uid,
                    udate:this.date,
                }

                fetch('/api/todoAdd',{
                    method:'post',
                    body:JSON.stringify(post),
                    headers:{
                        'Content-Type':'application/json',
                        'Accept':'application/json',
                    }
                }).then(function(response){
                    if(response.ok){
                        alert('리스트가 등록 되었습니다.');

                        list.classList.remove('edit-show');
                        list.classList.add("edit-hide");
                        this.title = null;
                        this.body = null;
                        this.udate = `${date.getFullYear()}-${lpad(date.getMonth()+1, 2, '0')}-${date.getDate()}`;
                        this.index = 0;

                        this.$emit('listUpdate');
                    }else{
                        alert('err!! 다시 시도하여 주십시오.');
                    }
                }).catch(function(){
                    alert('Err!!');
                });
            }else{
                let post = {
                    title:this.title,
                    body:this.body,
                    uid:this.uid,
                    udate:this.date,
                    id:this.index
                }

                fetch('/api/todoUpdate',{
                    method:'post',
                    body:JSON.stringify(post),
                    headers:{
                        'Content-Type':'application/json',
                        'Accept':'application/json',
                    }
                }).then((response) => {
                    if(response.ok){
                        alert('리스트가 수정 되었습니다.');

                        list.classList.remove('edit-show');
                        list.classList.add("edit-hide");
                        this.title = null;
                        this.body = null;
                        this.udate = `${date.getFullYear()}-${lpad(date.getMonth()+1, 2, '0')}-${date.getDate()}`;
                        this.index = 0;

                        this.$emit('listUpdate');
                    }else{
                        alert('err!! 다시 시도하여 주십시오.');
                    }
                }).catch(function(){
                    alert('Err!!');
                });
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
    transition: transform 0.5s;
}
.action-btn-show{
    transform: translateX(0%);
}
.action-btn-hide{
    transform: translateX(900%);
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
    text-align:center;

    .cancel-btn{
        position: absolute;
        top:-15px;
        right:-15px;
        font-size:25px;
        background-color:white;
        color:rgba($color: #000000, $alpha: 0.3);
        font-weight:900;
        width:35px;
        height:35px;
        line-height:35px;
        text-align:center;
        border-radius: 50%;

        :hover{
            color:rgba($color: #000000, $alpha: 0.5);
        }
    }

    .edit-container{
        display:inline-block;
        width: 400px;
        height:370px;
        margin-top:13px;
        font-family: sans-serif;
        text-align:left;

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

@media (max-width:670px){
    .todolist-edit{
        width:450px;
    }
}
@media (max-width:515px){
    .todolist-edit{
        width:430px;
    }
}


</style>
