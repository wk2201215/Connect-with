$(".hoge").on("click", function() {
    // var id = document.getElementById('');
    // alert();
    // var id = $('div.hoge').attr('id');
    var post_id = $(this).data('id');
    var p = 0;
    // alert(id);
    location.href='./reply.php?post_id='+post_id+'p='+p;
	// location.href='http://yahoo.co.jp';
});