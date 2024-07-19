//ポップアップ
// const clickBtn = document.getElementById('click-btn');
const clickBtn = document.getElementById('cs');
const popupWrapper = document.getElementById('popup-wrapper');
const close = document.getElementById('close');

// ボタンをクリックしたときにポップアップを表示させる
clickBtn.addEventListener('click', () => {
  popupWrapper.style.display = "block";
});

// ポップアップの外側又は「x」のマークをクリックしたときポップアップを閉じる
popupWrapper.addEventListener('click', e => {
  if (e.target.id === popupWrapper.id || e.target.id === close.id) {
    popupWrapper.style.display = 'none';
  }
});

function theme(theme_id) {
    $.ajax({
      url:'./chat-theme-db.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
        'theme_id' : theme_id
      }
    })
    .then(
        function (data) {
          theme2(data['body'],data['header'],data['moji']);
          console.log(data);
          console.log("変更成功");
        },
        function () {
            alert("変更失敗");
        }
    );
}

$(".color").on("click", function() {
    var theme_id = $(this).data('id');
    console.log(theme_id);
    theme(theme_id);
});

let $b = $('body'),
    $h = $('header'),
    $f = $('footer'),
    $n = $('#nav li a');
function theme2(body_c, header_footer_c, n_c) {
    $b.css('background-color',body_c);
    $b.css('color',n_c);
    $h.css('background-color',header_footer_c);
    $h.css('color',n_c);
    $f.css('background-color',header_footer_c);
    $n.css('color',n_c);
    console.log(body_c);
    console.log("変更");
}
$(document).ready(function() {
    var theme_id1 = $('#t').data('idb');
    var theme_id2 = $('#t').data('idhf');
    var theme_id3 = $('#t').data('idn');
	theme2(theme_id1,theme_id2,theme_id3);
});
