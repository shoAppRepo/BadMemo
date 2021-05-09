<template>
  
</template>

<script>
export default {
	methods:{
		login(){
      console.log(this.formData);
      axios
        .post('api/login', this.formData)
        .then((response) =>{
          this.$toast.success('Logged in successfully')
          localStorage.setItem('token', response.data.token);
          this.$router.push('/')
        })
        .catch((errors) => {
          this.$toast.error('Login failed')
          this.errors = errors.response.data.errors
          console.log(errors);
        })
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

</style>