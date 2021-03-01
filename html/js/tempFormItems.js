(function () {
  'use strict';
  Vue.component('temp-form-items', {
    props:['tags'],
    template: `<div class="mb-2 add">
      <input type="text" name="title[]" class="mr-2" placeholder="title" reqwuired />
      <input type="date" name="end[]" class="mr-2" id="" required="required" />
      <input type="time" name="start_time[]" class="mr-2" id="" required="required" />
      <input type="date" name="statTime[]" class="mr-2" id="" required="required" />
      <input type="time" name="end_time[]" class="mr-2" id="" required="required" />
      <select class="mr-2" name="tag[]">
        <option v-for="(tag, i) in tags" :value="i">{{ tags[i] }}</option>
      </select>`
      // 注意：ボタンにv-on入ってる：$emit（form-item-btn）
      + `<button type="button" class="btnCancel" @click="btnCancel" >削除</button>
    </div>`,

    data: function () {
      return {
        //
      }
    },
    methods: {
      btnCancel: function () {
        this.$emit('form-item-btn');
      },
    }
  });

  Vue.component('temp-new-many', {
    template: `
      <input type="submit" name="_post_meny" value="new_meny" id="newMany" class="mb-2">
    `,
    data: function () {
      return {
        //
      }
    },
  });
})();
