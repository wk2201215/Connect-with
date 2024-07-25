$(document).ready(function() {
    setInterval('session()', 1000);
});


function session() {
    $.ajax({
      url:'./session-db.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
      }
    })
    .then(
        function (data) {
          console.log(data);
        },
        function () {
            // alert("ログイン管理失敗");
        }
    );
  }