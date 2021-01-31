<template>
  <div class="card-body">
    <form autocomplete="off" class="form" id="formLogin" name="formLogin" role="form">
      <div class="form-group">
        <input class="form-control" id="name" name="name" v-model="name" type="text" placeholder="Pizza's name">
      </div>
      <div class="col-md-12 pb-3">
        <label for="exampleAccount">Preferred Ingredients</label>
        <div data-toggle="buttons" class="row d-flex box">
          <label 
            :for="ingredient.id" 
            class="btn btn-light m-2 flex-fill" 
            v-for="ingredient in ingredients" 
            :key="ingredient.id"
          >
            <input 
              type="checkbox"
              :value="ingredient" 
              :id="ingredient.id"
              v-model="selectedIngredients"
            >
              {{ ingredient.name }}
              <span class="badge badge-secondary">{{ ingredient.price }}$</span>
          </label>  
        </div>
      </div>
      <button class="btn btn-success btn-lg float-right" type="button" @click.prevent="storePizza">Add Pizza</button>
    </form>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        name: '',
        selectedIngredients: []
      }
    },
    props:{
      ingredients: {
        type: Array
      }
    },
    mounted() {
        console.log('Component mounted.')
    },
    methods:{
      storePizza(){
        axios.post('/pizza', {
          name: this.name,
          selectedIngredients: this.selectedIngredients
        })
        .then(function(result){window.location.href = '/pizza';});
      }
    }
  }
</script>