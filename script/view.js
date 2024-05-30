$(".hoge").on("click", function() {
    // var id = document.getElementById('');
    // alert();
    // var id = $('div.hoge').attr('id');
    var id = $(this).data('id');
    // alert(id);
    location.href='./reply.php?hogeA='+id;
	// location.href='http://yahoo.co.jp';
});