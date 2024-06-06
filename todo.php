<?php
private function _create(){
    if(!isset($_POST['post_id'])|| isset($_POST['title']) === ''){
      throw new \Exception('[create] title not set!');
    }

    // $sql = "insert into todos (title) values (:title)";
    $sql = "UPDATE post SET good_count = good_count+1;"
    $stmt = $this->_db->prepare($sql);
    $stmt->execute([':post_id' => $_POST['post_id']]);

    return ['id' => $this->_db->lastInsertId()];
  }
  ?>