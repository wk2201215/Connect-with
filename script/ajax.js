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
function readMessage2() {
        
  // 同じクラス名を持つ要素の値を取得して配列に追加する
  $('.result').each(function() {
    // var value = $(this).data('id');
    var postId = $(this).attr('id'); // div要素のID属性を取得
    // alert(postId);
    readMessage(postId);
  });
}

   function readMessage(post_id) {
    $.ajax({
        url:'./dbconnect.php', //送信先
        type:'POST', //送信方法
        datatype: 'json', //受け取りデータの種類
        data:{
          // 'id' : $('.ajax').data('id'),
          'post_id' : post_id
          // 'gj' : 1
        }
      })
    .then(
        function (data) {
          $('.result#'+data[0].post_id).html("good数："+data[0].good_count);
          console.log('通信成功');
          console.log(data);
        },
        function () {
          $('.result').html(data);
          console.log('通信失敗');
          console.log(data);
          alert("読み込み失敗");
        }
    );
}


function writeMessage(post_id) {
    $.ajax({
      url:'./dbconnect2.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
        'post_id' : post_id
        // 'gj' : gj
      }
    })
    .then(
        function (data) {

          // readPost(data[0].post_id);
          console.log(data);
          // $("#message").val('');
        },
        function () {
            alert("書き込み失敗");
        }
    );
}



$(".ajax").on("click", function() {
  var post_g = $(this).attr('data-g');
  if (post_g == "0") {
      $(this).html('<i class="fas fa-thumbs-up"></i>');
      $(this).attr('data-g', "1");
  } else {
      $(this).html('<i class="far fa-thumbs-up"></i>');
      $(this).attr('data-g', "0");
  }
  writeMessage($(this).attr('id'));
});
//delete_post
$(".delete").on("click", function() {
  var post_id = $(this).data('id');
  deletePost(post_id);
});

function deletePost(post_id) {
  $.ajax({
    url:'./dbconnect3.php', //送信先
    type:'POST', //送信方法
    datatype: 'json', //受け取りデータの種類
    data:{
      'post_id' : post_id
    }
  })
  .then(
      function (data) {
        readPost();
        console.log(data);
      },
      function () {
          alert("削除失敗");
      }
  );
}

function readPost() {
  location.reload();
}

$(document).ready(function() {
    readMessage();
    setInterval('readMessage2()', 1000);
});
