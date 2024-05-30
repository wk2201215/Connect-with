<?php
// header関数でコンテンツの形式が画像であると宣言
header("Content-Type: image/png");
readfile($_GET['hogeA']);
?>