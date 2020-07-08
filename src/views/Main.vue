<template>
  <div class="container">
    <div class="row">
      <div class="col-12 mx-auto pt-4 text-left">
        <label for="name" class="pr-3">Product Name: </label>
        <input type="text"
               class="form-group"
               name="name"
               id="name"
               v-model="productName"
        >
      </div>
      <div class="col-12 mx-auto pt-4 text-left">
        <label for="price" class="pr-3">Product price: </label>
        <input type="number"
               class="form-group"
               name="price"
               id="price"
               v-model="price"
        >
        <button @click="addProduct()">
          Add product
        </button>

      </div>
      <div class="col-12 mx-auto pt-4 text-left border-top mt-4">
        <h5 class="pl-2">Products</h5>

        <label for="filter" class="ml-2">Find product: </label>
        <input type="text"
               class="form-group"
               name="filter"
               id="filter"
               v-model="search"
        >
        <ul class="d-flex flex-wrap"
        >
          <li class="card custom-card d-flex justify-content-center align-items-center p-2 mb-2"
              v-for="(el, i) in filteredProducts"
              :key="i"
          >
            <a href="javascript:void(0)"
               class="w-100 h-100 d-flex justify-content-center align-items-center"
            >
              {{el.name}}
            </a>
          </li>
        </ul>
      </div>

    </div>
  </div>
</template>

<script>

  export default {
    name: "main",
    data() {
      return {
        productName: '',
        path: '',
        products: [],
        price: 0,
        search: '',
      }
    },
    mounted() {
      this.path = process.env.VUE_APP_URL
    },
    computed: {
      filteredProducts(){
        if (this.products) {
          return this.products.filter(prod => {
            return prod.name.toLowerCase().includes(this.search.toLowerCase())
          });
        }
      }
    },
    methods: {
      getProducts() {
        window.axios.get(`../../resources/films.json`,)
        .then((response) => {
          this.products = (Object.values(response.data))
        }).catch(e => {
          console.log('err', e.response);
        })
      },
      addProduct() {
        window.axios.post(`http://${this.path}/getDB.php`, {name: this.productName, price: this.price} )
        .then((response) => {
          console.log(response.data)
        }).catch(e => {
          console.log('err', e.response);
        })
      }
    }
  }
</script>

<style scoped>
.custom-card {
  display: block;
  width: 150px;
  height: 150px;
  pointer-events: visible;
}
</style>
