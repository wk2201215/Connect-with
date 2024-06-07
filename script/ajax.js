$(function(){

    $('.ajax').on('click',function(){
   
     $.ajax({
      url:'./dbconnect.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
    //    'id' : $('#id_number').val()
       'id' : $(this).data('id')
      }
      })
      // Ajax通信が成功した時
      .done( function(data) {
      $('#result').html(data[0].good_count);
      console.log('通信成功');
      console.log(data);
      })
      // Ajax通信が失敗した時
      .fail( function(data) {
      $('#result').html(data);
      console.log('通信失敗');
      console.log(data);
      })
    }); //#ajax click end
   
   }); //END