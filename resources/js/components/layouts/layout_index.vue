<template>
  <div class="container text-center m-5 mx-auto">
    <card_search 
      :column_for_search="columnForSearch"
      @search="search($event)"
    />
    <div 
      v-if="!checkIfExist"
      class="mt-4"
    >
      <h5>データがありません</h5>
    </div>

    <div 
      v-else
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
          class="fas fa-trash-alt col" 
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
import card_search from '../parts/card_search.vue';


export default {
  mixins:[mark_new],
  components:{
    modal_memo,
    card_search,
  },
  data(){
    return{
      modal: false,
      items: [],
      column_info: [],
      format: [],
      delete_items: [],
      new_items: [],
      user_id: '',
    };
  },
  props:{
    init_url: String,
    submit_url: String,
    search_url: String,
  },
  created(){
    this.init();
    this.user_id = localStorage.getItem('user_id');
  },
  computed:{
    checkIfExist(){
      if(this.items.length > 0){
        return true;
      }

      return false;
    },
    columnForSearch(){
      return this.format.search ? this.format.search: [];
    },
  },
  methods:{
    init(){
      axios
        .get(this.init_url)
        .then((response) => {
          this.items = response.data.all_items;
          this.column_info = response.data.column_info;
          this.format = response.data.format;
        });
    },
    submit(){
      const [exists, new_items] = this.checkNewItems();
      const delete_items = this.delete_items;
      axios
        .post(this.submit_url,{exists, new_items, delete_items})
        .then((response) => {
          this.$toast.show('保存しました');
          this.items = response.data.all_items;
          this.column_info = response.data.column_info;
        })
        .catch((error) => {
          this.$toast.error('保存出来ませんでした');
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
      Object.keys(this.column_info).forEach((a_column) => {
        new_empty_item[a_column.column] = null;
      })

      // 新規追加のフラグを追加
      let new_empty_item_with_new_flag = this.addNewFlag(new_empty_item);
      new_empty_item_with_new_flag['user_id']= this.user_id;

      this.items.push(new_empty_item_with_new_flag);
    },
    deleteItem(delete_item, delete_item_index){
      if(!this.isNew(delete_item)){
        this.delete_items.push(delete_item);
      }
      this.items.splice(delete_item_index, 1);
    },
    changeValue(change_item){
      this.items[this.item_index] = change_item;
      this.closeModal();
    },
    search(conditions){
      axios
        .get('/api/tasks/search', 
          {
            params: {
              conditions
            }
          }
        )
        .then((response) => {
          this.items = response.data.items;
        })
        .catch((errors) => {
          this.$toast.error('検索が出来ませんでした')
          console.log(errors)
        });
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