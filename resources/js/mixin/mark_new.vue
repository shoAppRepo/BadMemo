<script>
export default {
  methods:{
    addNewFlag(new_empty_item){
      new_empty_item['new'] = true;
      return new_empty_item;
    },
    isNew(delete_item){
      if(delete_item['new']){
        return true;
      }else{
        return false;
      }
    }
  },
}
</script>