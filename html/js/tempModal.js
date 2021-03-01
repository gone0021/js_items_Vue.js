(function () {
  'use strict';

  Vue.component('temp-modal', {
    // v-bind:nameでmodal-btnの値をクリックするボタンごとに変えている
    props: ['btnVal', 'tags', 'title', 'start', 'startTime', 'end', 'endTime', 'tagVal', 'memo', 'arrList', 'objList'],
    template: `<div id="modal">
    <form action="./" method="post" id="mForm">`
      + `<div class="mForm">
        <label for="mTitle" class="mr-2">タイトル</label>
        <input type="text" name="title" id="mTitle" :value="arrList[0]" required>
      </div>`

      + `<div class="mForm">
        <label for="mStart" class="mr-2">開始日時</label>
        <input type="date" name="start" id="mStart" :value="objList.start" required>
        <input type="time" name="start_time" id="mStartTime" :value="startTime" required>
      </div>`

      + `<div class="mForm">
        <label for="mEnd" class="mr-2">終了日時</label>
        <input type="date" name="end" id="mEnd" :value="end" required>
        <input type="time" name="end_time" id="mEndTime" :value="endTime" required>
      </div>`

      + `<div class="mForm">
        <label for="mTag" class="mr-2">タグ</label>
        <select name="tag" id="mTag" :value="tagVal" @change.once="mSelect">
        <option value="" id="op0"> ----- </option>
        <option v-for="(tag,i) in tags" :value="i">{{ tag }}</option>
        </select>
      </div>`

      + `<div class="mForm">
        <label for="mMemo" class="mr-2">メモ</label>
        <textarea name="memo" id="mMemo" cols="30" rows="3">{{ memo }}</textarea>
      </div>`
      // 親コンポーネントのv-bindでmbValの値を取得（props）
      + `<input type="submit" name="_post" :value="btnVal" id="mbId">
    </form>
    </div>`,
    data: function () {
      return {
        mVal: this.tagVal,
      }
    },
    methods: {
      mSelect: function () {
        let select = document.querySelector('#mTag');
        let option0 = document.querySelector('#op0');
        select.removeChild(option0);
        // document.querySelector('#mTag').removeChild(option0);
      }
      //
    }
  });
})();
