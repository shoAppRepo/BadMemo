<template>
  <div class="container text-center">
    <div 
      v-for="(item, index) in items"
      class="row mt-4 mx-auto"
    >
      <span 
        class="col topic px-1"
        @click="openModal(index)"
      >
        {{ item.title }}
      </span>
      <button 
        @click="deleteItem(item,index)"
        class="btn align-items-center"
      >
        <span 
          style="font-size:1.5rem;"
          class="fas fa-trash-alt" 
        />
      </button>
    </div>

    <div class="bottom-buttons">
      <button 
      class="btn block align-items-center mt-5"
      @click="addItem()"
    >
      <span
        style="font-size:1.5rem;"
        class="fas fa-plus-circle"
      >
        追加
      </span>
    </button>

    <button 
      class="btn block align-items-center mt-5"
      @click="submit()"
    >
      <span
        style="font-size:1.5rem;"
        class="fas fa-cloud-upload-alt"
      >
        保存
      </span>
    </button>
    </div>

    <!-- メモ系のモーダル -->
    <modal_memo
      v-if="modal"
      :original_item="items[item_index]"
      :column_info="column_info"
      @changeValue="changeValue($event)"
      @close="closeModal"
    />

  </div>
</template>

<script>
import modal_memo from '../parts/modal_memo.vue';
import mark_new from '../../mixin/mark_new.vue';
export default {
  mixins:[mark_new],
  components:{
    modal_memo,
  },
  data(){
    return{
      modal: false,
      items: [],
      column_info: [],
      delete_items: [],
      new_items: [],
    };
  },
  props:{
    init_url: String,
    submit_url: String,
  },
  created(){
    this.init();
  },
  methods:{
    init(){
      axios
        .get(this.init_url)
        .then((response) => {
          this.items = response.data.all_items;
          this.column_info = response.data.column_info;
        });
    },
    submit(){
      const [exists, new_items] = this.checkNewItems();
      const delete_items = this.delete_items;
      axios
        .post(this.submit_url,{exists, new_items, delete_items})
        .then((response) => {
          this.$toasted.show('保存しました');
          this.items = response.data.all_items;
          this.column_info = response.data.column_info;
        })
        .catch((error) => {
          this.$toasted.error('保存出来ませんでした');
        });
    },
    checkNewItems(){
      var exists = [];
      var new_items = [];
      this.items.forEach((an_item) => {
        if(this.isNew(an_item)){
          new_items.push(an_item);
        }else{
          exists.push(an_item);
        }
      });
      return [exists, new_items];
    },
    addItem(){
      var new_empty_item = {};
      //column_info内のカラムをキーとして挿入
      this.column_info.forEach( function(a_column_info) {
        new_empty_item[a_column_info.column_name] = null;
      });
      const new_index = this.items.length; 
      // 新規追加のフラグを追加
      const new_empty_item_with_new_flag = this.addNewFlag(new_empty_item);
      this.$set(this.items, new_index, new_empty_item_with_new_flag);
    },
    deleteItem(delete_item, delete_item_index){
      if(!this.isNew(delete_item)){
        this.delete_items.push(delete_item);
      }
      this.$delete(this.items, delete_item_index);
    },
    changeValue(change_item){
      this.$set(this.items, this.item_index, change_item);
      this.closeModal();
    },
    /**
     * モーダル系
     */
    openModal(item_index){
      this.item_index = item_index;
      this.modal = true;
    },
    closeModal(){
      this.modal = false;
    }
  },
}
</script>

<style>
.topic {
  width: 100%;
}
</style>