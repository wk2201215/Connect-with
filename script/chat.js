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
        consent(chatroom_id,account_id);
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

function consent(chatroom_id, account_id) {
    $.ajax({
      url:'./dbconnect4.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
        'chatroom_id' : chatroom_id,
        'account_id' : account_id
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

function readMessage() {
	// location.reload();
    $.ajax({
		type: 'post',
		url: './chat-room-db.php',
		data: {
            chatroom_id : $('div#messageTextBox').data('chatroom_id'),
            chatmessage_id : $('div#messageTextBox').data('id'),
            flag : 2
		}
	})
	.then(
		function (data) {
			console.log('チャット読み込み成功');
		},
		function () {
            console.log('チャット読み込み失敗');
			alert("書き込み失敗");
		}
	);
}


function writeMessage() {
	$.ajax({
		type: 'post',
		url: './chat-room-db.php',
		data: {
			'message' : $("#message").val(),
            chatroom_id : $('div#messageTextBox').data('chatroom_id'),
            flag : 1
		}
	})
	.then(
		function (data) {
			readMessage();
			$("#message").val('');
		},
		function () {
			alert("書き込み失敗");
		}
	);
}


$(document).ready(function() {
	readMessage();
	setInterval('readMessage()', 100);
});
