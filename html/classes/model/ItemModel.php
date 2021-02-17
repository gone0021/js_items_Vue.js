<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= '/data/js_items_vue/html';
require_once($root . '/classes/model/BaseModel.php');

/**
 * 作業項目モデルクラスです。
 */
class ItemModel extends BaseModel
{
  /**
   * コンストラクタ
   */
  public function __construct()
  {
    // 親クラスのコンストラクタを呼び出す
    parent::__construct();
  }

  /**
   * IDの整合性チェック
   *
   * @return bool
   */
  public function checkId($id)
  {
    // $data['id']が存在しなかったらfalse
    if (!isset($id)) {
      return false;
    }
    // $idが数字でなかったらfalse
    elseif (!is_numeric($id)) {
      return false;
    }
    // $idが0以下はfalse
    elseif ($id <= 0) {
      return false;
    }
  }

  /**
   * 項目の全件取得
   */
  public function getAll(): array
  {
    $sql = 'SELECT ';
    $sql .= 'id, ';
    $sql .= 'title, ';
    $sql .= 'start, ';
    $sql .= 'end, ';
    $sql .= 'start_time, ';
    $sql .= 'end_time, ';
    $sql .= 'tag, ';
    $sql .= 'memo ';
    $sql .= 'FROM items ';
    $sql .= 'WHERE ';
    $sql .= 'deleted_at is null ';
    $sql .= 'order by id';

    $stmt = $this->dbh->prepare($sql);
    $stmt->execute();
    $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $ret;
  }

  /**
   * 指定IDの項目を1件取得
   * @param int
   */
  public function getItemById($id): array
  {
    // $idが数字でなかったらfalseを返却する。
    $this->checkId($id);

    $sql = 'SELECT ';
    $sql .= 'id, ';
    $sql .= 'title, ';
    $sql .= 'start, ';
    $sql .= 'end, ';
    $sql .= 'start_time, ';
    $sql .= 'end_time, ';
    $sql .= 'tag, ';
    $sql .= 'memo ';
    $sql .= 'FROM items ';
    $sql .= 'WHERE ';
    $sql .= 'id =:id ';
    $sql .= 'AND deleted_at is null';
    
    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $ret = $stmt->fetch(PDO::FETCH_ASSOC);

    return $ret;
  }

  /**
   * 項目を登録
   *
   * @param array $data 作業項目の連想配列
   */
  public function insert($data): bool
  {
    // テーブルの構造でデフォルト値が設定されているカラムをinsert文で指定する必要はありません（特に理由がない限り）。
    $sql = 'INSERT into items (';
    $sql .= 'title, ';
    $sql .= 'start, ';
    $sql .= 'end, ';
    $sql .= 'start_time, ';
    $sql .= 'end_time, ';
    $sql .= 'tag, ';
    $sql .= 'memo ';
    $sql .= ') values (';
    $sql .= ':title,';
    $sql .= ':start,';
    $sql .= ':end,';
    $sql .= ':start_time, ';
    $sql .= ':end_time, ';
    $sql .= ':tag,';
    $sql .= ':memo';
    $sql .= ')';

    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
    $stmt->bindParam(':start', $data['start'], PDO::PARAM_STR);
    $stmt->bindParam(':end', $data['end'], PDO::PARAM_STR);
    $stmt->bindParam(':start_time', $data['start_time'], PDO::PARAM_STR);
    $stmt->bindParam(':end_time', $data['end_time'], PDO::PARAM_STR);
    $stmt->bindParam(':tag', $data['tag'], PDO::PARAM_INT);
    $stmt->bindParam(':memo', $data['memo'], PDO::PARAM_STR);
    $ret = $stmt->execute();

    return $ret;
  }

  /**
   * 指定IDの項目を更新
   *
   * @param array $data 更新する作業項目の連想配列
   */
  public function update($data): bool
  {
    $this->checkId($data['id']);

    $sql = 'UPDATE items set ';
    $sql .= 'id =:id,';
    $sql .= 'title =:title, ';
    $sql .= 'start =:start,';
    $sql .= 'end =:end,';
    $sql .= 'start_time =:start_time, ';
    $sql .= 'end_time =:end_time, ';
    $sql .= 'tag =:tag,';
    $sql .= 'memo =:memo,';
    $sql .= 'updated_at = current_timestamp()';
    $sql .= 'WHERE id = :id';

    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':id', $data['id'], PDO::PARAM_INT);
    $stmt->bindParam(':title', $data['title'], PDO::PARAM_STR);
    $stmt->bindParam(':start', $data['start'], PDO::PARAM_STR);
    $stmt->bindParam(':end', $data['end'], PDO::PARAM_STR);
    $stmt->bindParam(':start_time', $data['start_time'], PDO::PARAM_STR);
    $stmt->bindParam(':end_time', $data['end_time'], PDO::PARAM_STR);
    $stmt->bindParam(':tag', $data['tag'], PDO::PARAM_INT);
    $stmt->bindParam(':memo', $data['memo'], PDO::PARAM_STR);
    $ret = $stmt->execute();

    return $ret;
  }

  /**
   * 指定IDの項目を論理削除
   *
   * @param int
   */
  public function delete($id): bool
  {
    $this->checkId($id);
    
    $sql = 'UPDATE items set ';
    $sql .= 'deleted_at = current_timestamp()';
    $sql .= 'WHERE id =:id'; // where

    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $ret = $stmt->execute();

    return $ret;
  }

/**
 * 最後のidを取得
 */
  public function getLastId(): string
  {
    $ret = $this->dbh->lastInsertId();
    return $ret;
  }

  /**
   * 項目を検索
   *
   * @param mixed $search 検索キーワード
   */
  public function Search($search): array
  {
    $sql = '';
    $sql .= 'SELECT ';
    $sql .= 't.id,';
    $sql .= 't.user_id,';
    $sql .= 'u.name,';
    $sql .= 't.area,';
    $sql .= 't.point,';
    $sql .= 't.date,';
    $sql .= 't.is_went,';
    $sql .= 't.map_item,';
    $sql .= 't.comment ';
    $sql .= 'from trip_items as t ';
    $sql .= 'inner join users as u '; // inner join
    $sql .= 'on t.user_id =u.id ';
    $sql .= 'where t.is_deleted =0 '; // where
    $sql .= "and (";
    $sql .= "u.name like :name ";
    $sql .= "or t.area like :area ";
    $sql .= "or t.point like :point ";
    $sql .= "or t.date =:date ";
    // $sql .= "or t.is_went like :is_went ";
    $sql .= ") ";
    $sql .= 'order by t.date asc'; // dateの順番に並べる

    // bindParam()の第2引数には値を直接入れることができないので
    // 下記のようにして、検索ワードを変数に入れる。
    $likeWord = "%$search%";

    $stmt = $this->dbh->prepare($sql);
    $stmt->bindParam(':name', $likeWord, PDO::PARAM_STR);
    $stmt->bindParam(':area', $likeWord, PDO::PARAM_STR);
    $stmt->bindParam(':point', $likeWord, PDO::PARAM_STR);
    $stmt->bindParam(':date', $search, PDO::PARAM_STR);
    // $stmt->bindParam(':is_went', $is_swent, PDO::PARAM_INT);
    $stmt->execute();
    $ret = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $ret;
  }

}

