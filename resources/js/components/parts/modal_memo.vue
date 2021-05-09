<template>
  <transition name="modal" appear>
    <div 
      class="modal modal-overlay"
      @click.self="$emit('close')"
    >
      <div class="modal-window">
        <div class="container">
          <div class="title align-items-center">
            <span class="d-block">タイトル</span>
            <input
              type="text"
              v-model="change_item.title"
            >
          </div>

          <div class="tag align-items-center">
            <span class="d-block">タグ</span>
            <input 
              type="text"
              v-model="change_item.tag"
            >
          </div>

          <div class="status align-items-center">
            <span class="d-block">ステータス</span>
            <input 
              type="text"
              v-model="change_item.status"
            >
          </div>

          <div class="content align-items-center">
            <span class="d-block">本文</span>
            <textarea 
              v-model="change_item.content"
            />
          </div>

          <div class="how-to-improve align-items-center">
            <span class="d-block">改善案</span>
            <input 
              type="text"
              v-model="change_item.how_to_improve"
            >
          </div>

          <div class="bottom-buttons row justify-content-around mt-4">
            <button 
              class="col-4 border btn bg-primary"
              @click="$emit('close')"
            >
              <span style="color:white;">キャンセル</span>
            </button>

            <button 
              class="col-4 border btn bg-primary"
              @click="changeValue()"
            >
              <span style="color:white;">保存</span>
            </button>
          </div>

        </div>
      </div>
    </div>
  </transition>
</template>

<script>
export default {
  data(){
    return {
      change_item: {},
    };
  },
  props:{
    original_item: Object,
    column_info: Array,
  },
  created(){
    // propsの配列とオブジェクトは参照渡しのため、ディープコピー
    this.change_item = { ...this.original_item};
  },
  methods:{
    changeValue(){
      this.$emit('changeValue', this.change_item);
    }
  },
}
</script>

<style>
/* モーダルの背景 */
.modal-overlay {
  display: flex;
  align-items: center;
  justify-content: center;
  position: fixed;
  z-index: 30;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
}
.modal-enter-active, .modal-leave-active {
  transition: opacity 0.4s;
}
.modal-leave-active {
  transition: opacity 0.6s ease 0.4s;
}
.modal-enter, .modal-leave-to {
  opacity: 0;
}
/* モーダルの中身 */
.modal-window {
  z-index: 2;
  width: 70%;
  margin: 1.5em auto 0;
  padding: 10px 20px;
  border: 2px solid #aaa;
  background: #fff;
  max-height: 90%;
  overflow-y: auto;
}
</style>