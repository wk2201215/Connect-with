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
                        ).trigger('create');
                    }else{
                        $('div#messageTextBox').append(
                            '<div class="m" id="'+this['message_id']+'"><div class="'+this['flag']+'"><div class="faceion"><img src="Image-display.php?hogeA='+this['photograph_path']+'" alt="ルームアイコン"/></div><div class="name">'+this['name']+'</div><div class="chatting"><div class="says"><p>'+this['text']+'</p></div></div><div class="time">'+this['time']+'</div></div></div>'
                        ).trigger('create');
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
