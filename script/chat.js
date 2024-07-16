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
            if(data[0]['text'] != '通信正常'){
                //ループ対象の配列
                $.each(data, function() {
                    console.log("名称：" + this);
                    if(this['flag'] == 'my'){
                        $('div#messageTextBox').append(
                            '<div class="m" id="'+this['message_id']+'"><div class="'+this['flag']+'"><p>'+this['text']+'</p><div class="time">'+this['time']+'</div></div></div>'
                        );
                    }else{
                        $('div#messageTextBox').append(
                            '<div class="m" id="'+this['message_id']+'"><div class="'+this['flag']+'"><div class="faceion"><img src="Image-display.php?hogeA='+this['photograph_path']+'" alt="ルームアイコン"/></div><div class="name">'+this['name']+'</div><div class="chatting"><div class="says"><p>'+this['text']+'</p></div></div><div class="time">'+this['time']+'</div></div></div>'
                        );
                    }
                })
                var lastData = data[data.length - 1];
                // $('div#messageTextBox').attr('data-id', lastData[2]);
                $('div#messageTextBox').data('id', lastData['message_id']);
                console.log($('div#messageTextBox').data('id'));
            }else{
                console.log('新しいチャットなし');
            }
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
			// readMessage();
			$("#message").val('');
		},
		function () {
			alert("書き込み失敗");
		}
	);
}


$(document).ready(function() {
	readMessage();
    var id = $('div#messageTextBox').data('id');
    var iti = $('div.m#'+id).offset().top;
    $(window).scrollTop(iti);
	setInterval('readMessage()', 500);
});


// $(function(){
//     '<div class="'+this[1]+'" id="'+this[2]+'"><div class="'+this[1]+'">'+this[0]+'</div><br></div>'
//     var $img = $('');
//     var bottom = $img.offset().top + $img.height();
//     var height = $(window).height();
//     if (bottom > height)
//       $(document).scrollTop(bottom - height);
//   });