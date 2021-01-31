<template>
  <div class="d-flex flex-wrap justify-content-start">
    <div class="col-md-4 card border border-success shadow-0 mb-3 mr-auto ml-auto" style="max-width: 18rem"
      v-for="pizza in pizzas" :key="pizza.id">
      <div class="card-header bg-transparent border-success"><h5>{{ pizza.name }}</h5></div>
        <div class="card-body text-success">
          <h4 class="card-title">{{ pizza.price }}$</h4>
          <p class="card-text d-flex row justify-content-start">
            <span 
            class="badge bg-warning text-dark m-1" v-for="topic in pizza.ingredients">{{topic.name}}</span>
          </p>
        </div>
      <div class="card-footer bg-transparent border-success">
        <h6 v-for="link in links">
          <a :href="'/pizza/'+pizza.id+'/edit'">Change Ingredients</a>
        </h6>
      </div>
    </div>
  </div>
</template>

<script>
  export default {
    data(){
      return {
        links: [
          {
            title: 'this is link',
            href: '/pizza'
          }
        ]
      }
    },
    props: ['pizzas'],

    mounted() {
        console.log('Component mounted.')
    }
    // methods: {
    //   editlink(id){
    //     axios.get('/pizza').then(response => console.log(response.data));
    //   }
    // }
  }
</script>