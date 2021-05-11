<template>
  <div class="card">
    <div class="card-header">検索</div>
    <div class="card-body container align-items-start">
      <div 
        v-for="(value, key) in column_for_search"
        class="form-group"
      >
        <label class="col-lg-3 col-sm-3 text-left">{{value}}</label>
        <input 
          type="text"
          class="col-lg-3 col-sm-3"
          v-model="conditions[key]"
        >
      </div>

      <button 
        class="btn block align-items-center mt-5"
        @click="$emit('search', conditions)"
      >
        <span
          style="font-size:1.5rem;"
          class="fas fa-search"
        >
          検索
        </span>
      </button>

    </div>
  </div>
</template>

<script>
export default {
  data(){
    return {
      conditions: {},
    };
  },
  props:{
    column_for_search: Object,
  },
}
</script>

<style>

</style>