<template>
  <div class="card-body">
    <form autocomplete="off" class="form" id="formLogin" name="formLogin" role="form">
      <div class="form-group">
        <input class="form-control col-md-8" id="name" name="name" v-model="name" type="text" placeholder="Pizza's name">
        <h4 class="card-title mt-2 pt-1 col-md-2">{{ pizza.price }} $</h4>
      </div>
      <div class="d-flex">
		<div class="alert alert-success alert-dismissible fade show p-0 pr-4 pl-2 mr-2" role="alert" v-for="item in pizza.ingredients"> 
	    	<span>{{ item.name }}</span>
			<span v-on:click="deleteIngredient(item.id)" aria-hidden="true" class="btn close p-0 mr-1 text-danger" data-dismiss="alert" aria-label="Close">×</span> 
		</div> 
      </div>
      <div class="col-md-12 pb-3">
        <h4 class="mt-2">Choose the ingredients</h4>
        <div data-toggle="buttons" class="d-flex flex-wrap justify-content-start box">
          <label :for="ingredient.id" 
          		  class="btn m-2 btn-light border border-dark" 
            	  v-for="ingredient in ingredients" 
            	 :key="ingredient.id"
            	 :class="(ingredient.id == findExistingTopics()) ? 'disabled' : ''"
            	 >
            <input type="checkbox"
				  :value="ingredient" 
              	  :id="ingredient.id"
                   v-model="selectedIngredients"
            >
              {{ ingredient.name }}
              <span class="badge badge-secondary">{{ ingredient.price }}$</span>
          </label>  
        </div>
      </div>
      <button class="btn btn-info btn-lg float-right" type="button" @click.prevent="updatePizza">Update Pizza</button>
    </form>
  </div>
</template>

<script>
  export default {
  	data(){
      return {
        name: this.pizza.name,
        selectedIngredients: []
      }
    },
  	props: ['pizza', 'ingredients'],
  	mounted() {
        console.log('Component mounted.');
    },
    methods:{
    	deleteIngredient(ingredient_id){
    		const url = '/pizza/'+this.pizza.id;
    		axios.delete(url, {
    			data: { id: ingredient_id } 
    		}).then(response => console.log(response));
    	},
    	findExistingTopics(){
    		const b = this.pizza.ingredients;
    		var r2=Object.keys(b).map((key) => [b[key].id]);
    		r2 = r2.flat();
    		return r2;
    	},
		updatePizza(){
	      	const url = '/pizza/'+this.pizza.id;
	      	axios.put(url, {
	      		name: this.name,
	      		selectedIngredients: this.selectedIngredients
	      	})
	      	.then(function(result){window.location.href = '/pizza/';});
	      	//.then(response => console.log(response));

	      	// todo attaching style 'active' if spicies exists for pizza
			//const a = this.ingredients;
			//const b = this.pizza.ingredients;
			
			// var r=Object.keys(a).map((key) => [a[key].id]);
			// var r2=Object.keys(b).map((key) => [b[key].id]);
			// // r.forEach(function(entry) {
			// //     console.log(entry);
			// // });
			// console.log(r.flat());
			// console.log(r2.flat());
			// const c = r2.flat().filter(item => r.flat().includes(item));
			// console.log(c.flat());

			// return c;
	    }
    }
  }
</script>