<?php
// リファラーを取得
$referer = @$_SERVER['HTTP_REFERER'];

// リファラーが存在しない場合、直接アクセスとみなしエラーメッセージを表示
if (empty($referer)) {
    die('このページへの直接アクセスは禁止されています。');
}
?>