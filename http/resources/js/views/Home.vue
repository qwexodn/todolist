<template>
    <v-layout wrap>
        <v-flex xs12>
            <Header @menuShow='menuShow()'></Header>
            <Lmenu :todos='todos' :menushow='menushow' @showList='showList' @menuHide='menuHide'></Lmenu>
            <TodoList :todos='todos' :uid='uid' :show='listshow' @listupdate='getList'></TodoList>
        </v-flex>
        <ActionBtn :uid='uid' @listUpdate='getList'></ActionBtn>
    </v-layout>
</template>
<script>
import Header from "../components/header";
import TodoList from '../components/todolist';
import ActionBtn from "../components/actionbtn";
import Lmenu from '../components/Lmenu';

export default {
    created(){
        this.getUserId();

        window.addEventListener('resize', ()=>{
            if(event.currentTarget.innerWidth > 950){
                this.menushow = false;
            }
        })
    },
    components:{
        Header,
        TodoList,
        ActionBtn,
        Lmenu,
    },
    data(){
        return{
            uid:0,
            todos:[],
            listshow:'all',
            menushow:false,
        }
    },
    methods:{
        //유저 아이디 가져오기
        getUserId(){
            fetch('/api/userGet')
            .then(function(response){
                if(response.ok){
                    return response.text();
                }
            })
            .then((data)=>{
                let res = data;
                if(res == -1){
                    alert('허용되지 않은 아이피입니다.');
                    return;
                }
                this.uid = res;

                this.getList();
            });
        },
        //리스트 가져오기
        getList(){
            let post = {
                uid:this.uid
            }

            fetch('/api/todoGet',{
                method:'post',
                body:JSON.stringify(post),
                headers:{
                    'Content-Type':'application/json',
                    'Accept':'application/json',
                }
            }).then(function(response){
                if(response.ok){
                    return response.json();
                }
            }).then((data)=>{
                this.todos = data;
            });
        },
        showList(state){
            this.listshow = state;
        },
        menuShow(){
            if(this.menushow)  this.menushow = false;
            else  this.menushow = true;
        },
        menuHide(){
            this.menushow = false;
        }
    },
}
</script>