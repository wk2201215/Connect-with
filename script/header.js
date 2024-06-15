let start_position = 0,     //初期位置０
    window_position,
    $window = $(window),
    $header = $('header'),
    $footer = $('footer'),
    $fixbtn = $('fix-btn');
    
// スクロールイベントを設定
$window.on( 'scroll' , function(){
    // スクロール量の取得
    window_position = $(this).scrollTop();

    // スクロール量が初期位置より小さければ，
    // 上にスクロールしているのでヘッダーフッターを出現させる
    if (window_position <= start_position) {
        $header.css('top','0');
        $footer.css('bottom','0');
        $fixbtn.css('bottom','40');
        $wrapper
    } else {
        $header.css('top','-70px');
        $footer.css('bottom','-70px');
        $fixbtn.css('bottom','-70px');
    }
    // 現在の位置を更新する
    start_position = window_position;
    
});
// 中途半端なところでロードされても良いようにスクロールイベントを発生させる
$window.trigger('scroll');


// バーガーメニュー
// $(document).ready(function() {
//     $(document).delegate('.open', 'click', function(event){
//       $(this).addClass('oppenned');
//       event.stopPropagation();
//     })
//     $(document).delegate('body', 'click', function(event) {
//       $('.open').removeClass('oppenned');
//     })
//     $(document).delegate('.cls', 'click', function(event){
//       $('.open').removeClass('oppenned');
//       event.stopPropagation();
//     });
//   });