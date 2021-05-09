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
    }
	},
}
</script>

<style>

</style>