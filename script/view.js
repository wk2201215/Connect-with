
$(document).ready(function () {
    
    $(".post").on("click", function() {
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
        location.href='./post-reply.php?post_id='+post_id;
    });

    $(".good").on("click", function() {
        var post_id = $(this).data('id');
        $.post('_ajax.php',{
            post_id: post_id
          },function(res){
          /*3の処理*/
          });
    });
})
