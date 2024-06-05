<?php
//ファイルのパス
$file_pass = 'images/'.$_GET['hogeA'];
//まずファイルの存在を確認し、その後画像形式を確認する
if(file_exists($file_pass) && $type = exif_imagetype($file_pass)){
    switch($type){
        //gifの場合
        case IMAGETYPE_GIF:
            header("Content-Type: image/gif");
            // echo "IMAGETYPE_GIF";
        break;
        //jpgの場合
        case IMAGETYPE_JPEG:
            header("Content-Type: image/jpg");
            // echo "IMAGETYPE_JPEG";
        break;
        //pngの場合
        case IMAGETYPE_PNG:
            header("Content-Type: image/png");
            // echo "IMAGETYPE_PNG";
        break;
        //どれにも該当しない場合
        default:
        header("Content-Type: image/");
        // echo "gif、jpg、png以外の画像です";
    }
    readfile($file_pass);
}else{
    // echo "画像ファイルではありません（もしくはファイルが存在しません）";
}
?>
