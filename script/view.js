<<<<<<< Updated upstream

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
})
=======
$(".hoge").on("click", function() {
    // var id = document.getElementById('');
    // alert();
    // var id = $('div.hoge').attr('id');
    var id = $(this).data('id');
    // alert(id);
    location.href='./reply.php?hogeA='+id;
	// location.href='http://yahoo.co.jp';
});
>>>>>>> Stashed changes
