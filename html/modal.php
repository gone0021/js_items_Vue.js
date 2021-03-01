<div id="modal" v-if="modal">
  <form action="./" method="post" id="mForm">

    <div class="mForm">
      <label for="mTitle" class="mr-2">タイトル</label>
      <input type="text" name="title" id="mTitle" value="" required>
    </div>

    <div class="mForm">
      <label for="mStart" class="mr-2">開始日時</label>
      <input type="date" name="start" id="mStart" value="" required>
      <input type="time" name="start_time" id="mStartTime" value="<?php if(isset($_POST['start_time'])) echo$_POST['start_time']; ?>" required>
    </div>

    <div class="mForm">
      <label for="mEnd" class="mr-2">終了日時</label>
      <input type="date" name="end" id="mEnd" value="" required>
      <input type="time" name="end_time" id="mEndTime" value="" required>
    </div>

    <div class="mForm">
      <label for="mTag" class="mr-2">タグ</label>
      <select name="tag" id="mTag">
        <?php foreach ($tags as $k => $v) : ?>
          <option value="<?= $k ?>" 
          <?php if(isset($_POST['tag']) && $_POST['tag'] == $k) echo " selected"; ?>>
          <?= $v ?>
        </option>
        <?php endforeach ?>
      </select>
    </div>

    <div class="mForm">
      <label for="mMemo" class="mr-2">メモ</label>
      <textarea name="memo" id="mMemo" cols="30" rows="3">
      <?php if(isset($_POST['memo'])) echo $_POST['memo']; ?>
      </textarea>
    </div>

  </form>
</div>
