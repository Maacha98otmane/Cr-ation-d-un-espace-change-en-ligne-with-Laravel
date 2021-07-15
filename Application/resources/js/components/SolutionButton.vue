<template>
    <div>
      <button class="btn btn-success" @click="markassolution">Marquer comme solution</button>
    </div>
</template>

<script>
    export default {
        props:['sujetId','commentId'],
        methods:{
          markassolution(){
            axios.post('/addassolution/'+ this.sujetId+'/'+ this.commentId)
            .then(Response =>{
              if(Response.status === 200){
                window.location='/sujets/'+this.sujetId
              }
            })
            .catch(errors=>{
              console.log(errors.status)
            })
          }
        }
    }
</script>
