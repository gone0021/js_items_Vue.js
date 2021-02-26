<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/data/js_items/html';
require_once($root . '/classes/model/BaseModel.php');
require_once($root . '/classes/model/ItemModel.php');

header('Content-Type: application/json');

$itemModel = new ItemModel();

$id = $_GET['id'];
// $id = $_GET['id'];

try {
  // idによる検索
  $ret = $itemModel->getItemById($id);

  // レコードない場合はエラーメッセージをJSONで出力
  if (count($ret) == 0) {
    echo json_encode(array('msg' => '該当のidが見つかりませんでした。'));
    exit;
  }

  // 取得したレコードをJSONエンコードして出力
  echo json_encode($ret);
} catch (Exception $e) {
  // 例外が発生したときは、エラーメッセージをJSONで出力
  echo json_encode(array('msg' => 'エラーが発生しました。'));
  exit;
}
