<template>
<div class='box'>
    <div class='content'>
        <div  class='item con-shadow' v-for="item in todos" :key='item.id'>
            <div class='title'>{{ item.title }}</div>
            <div class='udate'>{{ item.udate }}</div>
            <div class='update'>작성일 : {{ item.update }}</div>
            <div class='body' v-html='item.body'></div>
        </div>
    </div>
</div>
</template>

<script>
export default {
    props:['todos'],
}
</script>


<style lang="scss" scoped>
.box{
    display: flex;
    justify-content: center;
}
.content{
    width:600px;
    border:none;
    margin:10px 0;
    
    .item{
        height:200px;
        background-color:white;
        border-radius: 0.5em;
        margin:5px 0;
        padding:10px;
        box-sizing:border-box;

        .title, .udate, .update, .body{
            all:unset;
            font-family:sans-serif;
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
        }
    }
}

</style>
