<template>
  <div class="container text-center">
    <div 
      v-for="topic in topics"
      class="topic mt-4 mx-auto"
      @click="goToTopic(topic.key)"
    >
      <span>{{ topic.name }}</span>
     
    </div>
  </div>
</template>

<script>
export default ({
  data(){
    return{
      topics: [
        {'name':'課題', 'key':'tasks'},
        {'name':'ショット', 'key':'shots'},
        {'name':'メモ', 'key':'memos'},
        {'name':'カレンダー', 'key':'calender'},
        {'name':'練習', 'key':'practices'},
        {'name':'試合', 'key':'games'},
      ],
    };
  },
  methods:{
    goToTopic(key){
      this.$router.push('/tasks');
    }
  },
})
</script>

<style>
.topic {
  font-size: 30px;
  border: 1px solid;
  width:40%;
  cursor: pointer;
}
</style>