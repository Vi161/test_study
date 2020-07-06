<template>
  <div class="container">
    <a href="/" class="h1">My films</a>
    <div class="row">
      <div class="col-12 mx-auto pt-4 text-left">
        <p class="mb-5 mt-3">For get saved user films push params to url "user='username_DD_MM_YYY'"</p>

        <label for="name" class="pr-3">User Name: </label>
        <input type="text"
               class="form-group"
               name="name"
               id="name"
               v-model="name"
        >
        <button @click="saveName()">
          Save
        </button>
        <div class="col-12 mx-auto pt-4 text-left border-top mt-4">
          <h5 class="pl-2">My Selectrd Films:</h5>
          <ul class="d-flex flex-wrap"
          >
            <li class="card custom-card d-flex justify-content-center align-items-center p-2 mb-2"
                v-for="(el, i) in myFilms"
                :key="i"
            >
              <a href="javascript:void(0)"
                 class="w-100 h-100 d-flex justify-content-center align-items-center"
                 @click="unselectFilm(el.id)"
              >
                {{el.name}}
              </a>
            </li>
          </ul>
        </div>
        <div class="col-12 mx-auto pt-4 text-left border-top mt-4">
          <h5 class="pl-2">Films</h5>

          <label for="filter" class="ml-2">Find Film: </label>
          <input type="text"
                 class="form-group"
                 name="filter"
                 id="filter"
                 v-model="search"
          >
          <button type="submit"
                  @click="sortByName()"
          >
            Sort by name
          </button>
          <ul class="d-flex flex-wrap"
          >
            <li class="card custom-card d-flex justify-content-center align-items-center p-2 mb-2"
                v-for="(el, i) in filteredFilms"
                :key="i"
            >
              <a href="javascript:void(0)"
                 class="w-100 h-100 d-flex justify-content-center align-items-center"
                  @click="selectFilm(el.id)"
              >
                {{el.name}}
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

  export default {
    name: "main",
    data() {
      return {
        path: '',
        name: '',
        users: [
          {
            id: 1,
            name: 'Вова'
          }
        ],
        myFilms: [],
        films: [
        ],
        myJson: '',
        search: '',
      }
    },
    mounted() {
      this.getFilms();
      this.getUrlPar();
      this.path = process.env.VUE_APP_URL
    },
    computed: {
      filteredFilms(){
        if (this.films) {
          return this.films.filter(film => {
            return film.name.toLowerCase().includes(this.search.toLowerCase())
          });
        }
      }
    },
    methods: {
      getFilms() {
        window.axios.get(`../../resources/films.json`,)
        .then((response) => {
          this.films = (Object.values(response.data))
        }).catch(e => {
          console.log('err', e.response);
        })

        // get films list from php file

        // window.axios.get(`http://${this.path}/films.php`)
        // .then((response) => {
        //   this.films = (Object.values(response.data))
        // }).catch(e => {
        //   console.log('err', e.response.data.message);
        // })
      },
      sortByName() {
        this.films.sort((a, b) => (a.name > b.name) ? 1 : -1);
      },
      selectFilm(id) {
        let films = this.films;
        let selectedFilm = films.filter(el => el.id == id);
        let filmInList = this.myFilms.filter(el => el.id == id);
        if (filmInList.length == 0) {
          this.myFilms.push(selectedFilm[0])
        }
      },
      unselectFilm(id) {
        let unselected = this.myFilms.filter(el => el.id !== id);
        this.myFilms = unselected;
      },
      saveName() {
        if (this.name) {
          window.axios.post(`http://${this.path}/usersfilms.php`,
            {
              date: this.todayDate('_'),
              name: this.name.toLowerCase(),
              myFilms: this.myFilms
            })
          .then((response) => {
            let fileName = JSON.stringify(response.data).split('/')[1];
            let fileNameClear = fileName.split('.')[0]
            alert('Film saved to file: ' + fileName)

            window.history.pushState({}, document.title, "/?user=" + fileNameClear );
          }).catch(e => {
            console.log('err', e);
          })
        }
      },
      getUrlPar() {
        const queryString = window.location.search;
        const urlParams = new URLSearchParams(queryString);
        const user = urlParams.get('user')
        if (user) {
          let fileName = `${user}.json`
          window.axios.get(`../../public/saved/${fileName}`,)
          .then((response) => {
            this.name = response.data.name.charAt(0).toUpperCase() + response.data.name.slice(1);
            this.myFilms=response.data.myFilms;
          }).catch(e => {
            console.log('err', e.response.data.message);
          })
        }

      },
      todayDate(sp) {
        let today = new Date();
        let dd = today.getDate(),
          mm = today.getMonth() + 1,
          yyyy = today.getFullYear();

        if (dd < 10) dd = '0' + dd;
        if (mm < 10) mm = '0' + mm;
        return (mm + sp + dd + sp + yyyy);
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
