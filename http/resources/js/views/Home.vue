<template>
    <v-layout wrap>
        <MainLoading v-if="loading"></MainLoading>
        <v-flex xs12 v-else>
            <Header :userIp='userIp' @menuShow='menuShow()'></Header>
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
import MainLoading from '../components/MainLoading';

export default {
    created(){

        //모바일 크기를 벗어나면 메뉴 초기화
        window.addEventListener('resize', ()=>{
            if(event.currentTarget.innerWidth > 950){
                this.menushow = false;
            }
        })

        // 유저 아이피 get
        fetch('/api/userIp')
        .then( response => {
            if(response.ok){
                return response.text();
            }
        })
        .then( data => {
            this.userIp = data;
        });

        // 유저 아이디 get
        this.getUserId();
    },
    components:{
        Header,
        TodoList,
        ActionBtn,
        Lmenu,
        MainLoading,
    },
    data(){
        return{
            uid:0,
            todos:[],
            listshow:'all',
            menushow:false,
            loading:true,
            userIp:null,
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
                this.loading = false;
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