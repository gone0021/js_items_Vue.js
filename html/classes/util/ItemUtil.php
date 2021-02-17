<?php
$root = $_SERVER['DOCUMENT_ROOT'];
$root .= "/data/js_items_vue/html";
require_once($root . "/classes/util/SessionUtil.php");
require_once($root . "/classes/model/ItemModel.php");

class Itemutil
{
    public function database()
    {
        $itemModel = new ItemModel();
        $data = array();
        if (isset($_POST['_post_meny'])) {
            // insert
            if ($_POST['_post_meny'] == 'new_meny') {
                for ($i = 0; $i < count($_POST['title']); $i++) {
                    var_dump($_POST);
                    echo '<br><hr>';
                    $data = array(
                        'title' => $_POST['title'][$i],
                        'start' => $_POST['start'][$i],
                        'end' => $_POST['end'][$i],
                        'start_time' => $_POST['start_time'][$i],
                        'end_time' => $_POST['end_time'][$i],
                        'tag' => $_POST['tag'][$i],
                        // 'memo' => $_POST['memo'][$i],
                    );
                    // var_dump($data);
                    // echo '<br><hr>';
                    // die;

                    try {
                        $itemModel->insert($data);
                        header('Location: ./');
                    } catch (Exception $e) {
                        // var_dump($e);exit;
                        header('Location: ./error.php');
                    }
                }
            }
            // die;
        } else if (isset($_POST['_post'])) {
            $data = array(
                'title' => $_POST['title'],
                'start' => $_POST['start'],
                'end' => $_POST['end'],
                'start_time' => $_POST['start_time'],
                'end_time' => $_POST['end_time'],
                'tag' => $_POST['tag'],
                'memo' => $_POST['memo'],
            );
            // insert
            if ($_POST['_post'] == 'new') {

                try {
                    $itemModel->insert($data);
                    header('Location: ./');
                } catch (Exception $e) {
                    // var_dump($e);exit;
                    header('Location: ./error.php');
                }
                // update
            } elseif ($_POST['_post'] == 'edit') {
                $data['id'] = $_POST['id'];

                try {
                    $itemModel->update($data);
                    header('Location: ./');
                } catch (Exception $e) {
                    // var_dump($e);exit;
                    header('Location: ./error.php');
                }
                // delete
            } elseif ($_POST['_post'] == 'delete') {
                try {
                    $itemModel->delete($_POST['id']);
                    // var_dump($_POST['id']);
                    header('Location: ./');
                } catch (Exception $e) {
                    // var_dump($e);exit;
                    header('Location: ./error.php');
                }
            }
        }
    }
}
