<template>
    <v-layout row wrap>
        <v-flex xs12>
            <Header></Header>
        </v-flex>
        <v-flex xs12>
            <TodoList></TodoList>
        </v-flex>
        <ActionBtn></ActionBtn>
    </v-layout>
</template>
<script>
import Header from "../components/header";
import TodoList from '../components/todolist';
import ActionBtn from "../components/actionbtn";

export default {
    components:{
        Header,
        TodoList,
        ActionBtn,
    }
}
</script>

<style lang="scss">
@import '../../sass/common.scss';
@import url('https://fonts.googleapis.com/css?family=Nanum+Gothic');

.content{
    width:10px;
    height:10000px;
}
</style>

