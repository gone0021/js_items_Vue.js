(function () {
  'use strict';

  let app = new Vue({
    el: '#home',
    data: {
      // if
      modal: false,
      newMany: false,

      // child : form,modal
      tags: ['趣味', '付き合い', '仕事', 'その他'],
      // tags: {'':' --- ', 0:'趣味', 1:'付き合い', 2:'仕事', 3:'その他'},

      // child : modal
      objList: {},
      arrList: [],
      btnVal: '',
      title: '',
      start:'',
      startTime:'',
      end:'',
      endTime:'',
      tagVal:'',
      memo:'',

      // variable
      formItems: 0,
    },
    methods: {
      // 新規登録ボタン
      btnNew: function () {
        this.modal = true;
        this.btnVal = 'new';
        console.log('btnVal : '+this.btnVal);

        // child:modalの値を初期化
        this.title = '';
        this.start = '';
        this.startTime = '';
        this.end = '';
        this.endTime = '';
        this.tagVal = '';
        this.memo = '';
      },
      // モーダル背景
      onOverlay: function () {
        this.modal = false;
      },
      // +ボタン（追加）
      btnAdd: function () {
        if (this.newMany == false) {
          this.newMany = true;
        }
        this.formItems++;
      },
      // 追加の削除：$emit
      onForm: function () {
        this.formItems--;
        if(this.formItems == 0) {
          this.newMany = false;
        }
      },
      // 全キャンセル
      btnCancelAll: function () {
        this.formItems = 0;
        this.newMany = false;
      },
      // 編集ボタン
      btnEdit: function (id) {
        this.modal = true;
        this.btnVal = 'edit';
        console.log(this.btnVal);
        console.log(id);
        
        axios.get('./edit.php', {
          params: {
            id: id,
          }
        })
        .then(function (res) {
          // 取得完了したらlistリストに代入
          let data = res.data;

          this.title = data.title;
          this.start = data.start;
          this.startTime = data.start_time;
          this.end = data.end;
          this.endTime = data.end_time;
          this.tagVal = data.tag;
          this.memo = data.memo;

          // this.listObj = data;
          this.objList = {'title':data.title, 'start':data.start, 'start_time':data.startTime, 'end':data.end, 'end_time':data.endTime, 'memo':data.memo};
          
          this.arrList = [data.title, data.start, data.startTime, data.end, data.endTime, data.memo];
          

          console.log(data);
          // console.log(title);
        }
        .bind(this)).catch(function (e) {
          console.error(e)
        })

      },
      // 削除ボタン
      btnDel: function (e) {
        var message = [
          '削除してよろしいですか？'
        ].join('\n')
        if (!window.confirm(message)) {
          e.preventDefault()
        }
      },
    },
  });

})();


$(function () {

  // 編集ボタン
  $(".btnEdit").click(function () {
    // idの取得
    let mEditVal = $(this).val();

    // モーダル
    $("#overlay").show();
    $("#modal").css("display", "block"); //show()と同じ
    $("#mForm").prepend('<input type="hidden" name="id" value="' + mEditVal + '" id="mId">');
    // $("#mForm").append('<input type="submit" name="_post" value="edit" id="mbtEdit">');

    // 確認用
    // let val = $(this).val();
    // $("#mForm").append(mEditVal);

    // 非同期post
    $.ajax({
      type: "GET",
      url: "./edit.php",
      data: {
        id: $(this).val()
      },
      //Ajax通信が成功した場合に呼び出されるメソッド
    }).done(function (data) {
        // $('#mTitle').val(data.title);
        // $('#mStart').val(data.start);
        // $('#mEnd').val(data.end);
        // $('#mStartTime').val(data.start_time);
        // $('#mEndTime').val(data.end_time);
        // $('#mTag').val(data.tag);
        // $('#mMemo').val(data.memo);
      //処理がエラーであれば
    }).fail(function () {
        // alert('なんかおかしい');
    });
  });





});