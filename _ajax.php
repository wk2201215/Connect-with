<?php
$todoApp = new \MyApp\Todo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  try {
    $res = $todoApp->post();
    header('Content-Type: application/json');
    echo json_encode($res);
    exit;
  } catch (Exception $e) {
    header($_SERVER['SERVER_PROTOCOL'] . ' 500 Internal Server Error', true, 500);
    echo $e->getMessage();
    exit;
  }
}
?>