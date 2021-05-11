<template>
  <layout_index 
    :init_url="init_url"
    :submit_url="submit_url"
    :search_url="search_url"
  />
</template>

<script>
import layout_index from '../layouts/layout_index.vue';
export default {
  components: {
    layout_index,
  },
  data(){
    return{
    };
  },
  computed: {
    init_url() {
      return '/api/tasks/index';
    },
    submit_url() {
      return '/api/tasks/update';
    },
    submit_url() {
      return '/api/tasks/search';
    },
  },
}
</script>

<style>
</style>