Vue.use(VueScrollTo);


const vm = new Vue({

    data:{
      isBurger: true,
      isSearch: true,
      
      query: '',


    },

    methods:{
      toggleBurger: function(){
        this.isBurger = !this.isBurger;
        console.log('burger');
      },

      openSearch: function(){
        this.isSearch = !this.isSearch;
      },


      

    },
  }).$mount("#app");




  