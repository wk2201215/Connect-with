// $(function(){

//     $('.ajax').on('click',function(){
   
//      $.ajax({
//       url:'./dbconnect.php', //送信先
//       type:'POST', //送信方法
//       datatype: 'json', //受け取りデータの種類
//       data:{
//     //    'id' : $('#id_number').val()
//        'id' : $(this).data('id')
//       }
//       })
//       // Ajax通信が成功した時
//       .done( function(data) {
//       $('.result#'+data[0].post_id).html("good数："+data[0].good_count);
//       console.log('通信成功');
//       console.log(data);
//       })
//       // Ajax通信が失敗した時
//       .fail( function(data) {
//       $('#result').html(data);
//       console.log('通信失敗');
//       console.log(data);
//       })
//     }); //#ajax click end
   
//    }); //END

   function readMessage() {
    $.ajax({
        url:'./dbconnect.php', //送信先
        type:'POST', //送信方法
        datatype: 'json', //受け取りデータの種類
        data:{
          'id' : $(this).data('id')
        }
      })
    .then(
        function (data) {
          $('.result#'+data[0].post_id).html("good数："+data[0].good_count);
          console.log('通信成功');
          console.log(data);
          alert("読み込成功");
        },
        function () {
          $('#result').html(data);
          console.log('通信失敗');
          console.log(data);
          alert("読み込み失敗");
        }
    );
}


function writeMessage() {
    $.ajax({
      url:'./dbconnect.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
        'id' : $(this).data('id')
      }
    })
    .then(
        function (data) {
            readMessage();
            // $("#message").val('');
        },
        function () {
            alert("書き込み失敗");
        }
    );
}


$(".ajax").on("click", function() {
  var post_id = $(this).data('id');
  readMessage();
});


$(document).ready(function() {
    readMessage();
    setInterval('readMessage()', 3000);
});