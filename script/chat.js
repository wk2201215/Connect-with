$(document).ready(function () {
    $("#chatroom_input").on("click", function() {
        location.href='./chat-input.php?to=1';
    });
    $("#chatroom_invitation").on("click", function() {
        location.href='./chat-invitation.php';
    });
    $("#to").on("click", function() {
        var to = $(this).data('id');
        location.href='./chat-input.php?to='+to;
    });
    $(".consent").on("click", function() {
        var chatroom_id = $(this).data('roomid');
        var account_id = $(this).data('accountid');
        var invitation_id = $(this).data('id');
        consent(chatroom_id,account_id,invitation_id);
    });
    var count = $('div.mail').data('count');
    $("#pura").on("click", function() {
        // var count = $('div.mail').data('count');
        count += 1;
        $('div.mail').attr('data-count', count);
        $('div.mail').append(
            '<div id="'+count+'"><input type="text" name="mail[]" required><br></div>'
        );
    });
    $("#mai").on("click", function() {
        // var count = $('div.mail').data('count');
        $('#'+count).remove();
        if(count != 0){
            count -= 1;
        }
        $('div.mail').attr('data-count', count);
    });
    $(".chatroom").on("click", function() {
        var chatroom_id = $(this).data('id');
        location.href='./chat-room.php?chatroom_id='+chatroom_id;
    });
});

function consent(chatroom_id, account_id, invitation_id) {
    $.ajax({
      url:'./dbconnect4.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
        'chatroom_id' : chatroom_id,
        'account_id' : account_id,
        'invitation_id' : invitation_id
      }
    })
    .then(
        function (data) {
          location.reload();
          console.log(data);
        },
        function () {
            alert("削除失敗");
        }
    );
}



// $(function(){
//     '<div class="'+this[1]+'" id="'+this[2]+'"><div class="'+this[1]+'">'+this[0]+'</div><br></div>'
//     var $img = $('');
//     var bottom = $img.offset().top + $img.height();
//     var height = $(window).height();
//     if (bottom > height)
//       $(document).scrollTop(bottom - height);
//   });