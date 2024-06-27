
$(document).ready(function () {
    
    // $(".account-info").on("click", function() {
    //     var account_id = $(this).data('id');
    //     location.href='./reply.php?post_id='+account_id;
    // });
    $(".view").on("click", function() {
        // var id = document.getElementById('');
        // alert();
        // var id = $('div.hoge').attr('id');
        var post_id = $(this).data('id');
        // alert(id);
        location.href='./reply.php?post_id='+post_id;
        // location.href='http://yahoo.co.jp';
    });
    
    $(".reply").on("click", function() {
        var post_id = $(this).data('id');
        var category_name = $(this).data('cn');
        var category_id = $(this).data('ci');
        location.href='./post-reply-input.php?post_id='+post_id+'&category_name='+category_name+'&category_id='+category_id;
    });
    $(".fix-btn").on("click", function() {
        location.href='./post-reply-input.php';
    });

    
})

$(document).ready(function() {
    var spinnerOverlay = $('#spinnerOverlay'); // スピナーオーバーレイ

    // スクロールイベントを監視
    $(window).scroll(function() {
        // 現在のスクロール位置を取得
        var scrollPos = $(this).scrollTop();

        // ページの一番上にスクロールしたときにリロードする
        if (scrollPos === 0) {
            showSpinner(); // スピナーを表示
            location.reload(); // ページをリロード
        }
    });

    // スピナーを表示する関数
    function showSpinner() {
        spinnerOverlay.fadeIn();
    }
});