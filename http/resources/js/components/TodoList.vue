<template>
<div>
    {{ todos }}
</div>
</template>

<script>
export default {
    created(){
    },
    data(){
        return{
            todos:{
                id:0,
                title:null,
                body:null,
                udate:null,
                state:null,
                update:null
            }
        }
    }
}
</script>


<style lang="scss" scoped>


</style>
