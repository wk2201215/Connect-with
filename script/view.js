
$(document).ready(function () {
    
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
        var category_name = $(this).data('c');
        location.href='./post-reply-input.php?post_id='+post_id+'&category_name='+category_name;
    });
    $(".post").on("click", function() {
        location.href='./post-reply-input.php';
    });
})
