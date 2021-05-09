<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">バドメモ</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" >
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <p 
              class="button"
              @click="logout()"
            >
              ログアウト
            </p>
          </li>
        </ul>
      </div>
    </nav>

    <router-view />
  </div>
</template>

<script>
export default {
  created(){
    this.setTokenInHeader();
    this.storeAuthInfo();
  },
  methods:{
    setTokenInHeader(){
      const token = localStorage.getItem('token');

      window.axios.defaults.headers.common['Authentication'] = `Bearer ${token}`
    },
    storeAuthInfo(){
      axios
        .get('/api/auth/info')
        .then((response) => {
          console.log(response);
          localStorage.setItem('user_name', response.data.user_name);
          localStorage.setItem('user_id', response.data.user_id);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    logout(){
      axios
        .post('/api/logout')
        .then((response) => {
          this.$toast.show('Logged out successfully');
          this.$router.replace('/original-login');
        })
        .catch((error) => {
          this.$toast.error('Logout failed');
          console.log(error);
        });
    }
  },
}
</script>

<style>
.button{
  cursor: pointer;
}
</style>