

// // 初期の labels 配列
// var d=[0,0,0,0,0,0,0,0,0,0,
//        0,0,0,0,0,0,0,0,0,0,
//        0,0,0,0,0];
// function drawChart() {
//     var ctx = document.getElementById('myChart').getContext('2d');
//     window.myChart = new Chart(ctx, {
//     type: 'line',//線の種類
//     data: {
//         // labels: ['0時','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'],//横軸のラベル
//         labels: ['24分前','23','22','21','20','19','18','17','16','15','14','13','12','11','10','9','8','7','6','5','4','3','2','1','0'],//横軸のラベル
//         datasets: [{
//             label: 'ログイン数',
//             lineTension: 0, //グラフの曲がり度合い(デフォルトは0.5)
//             fill: false, //グラフの線より下側を塗りつぶさないようにする
//             data: d,　　//縦軸の値
//             borderColor: "#0066FF", //線の色
//             backgroundColor: "#0066FF" //塗りつぶしの色
//         }]
//     },
//     options: {
//         title: {
//             display: true, //タイトルの表示可否
//             text: 'ログイン数推移' //タイトル
//         },
//         scales: {
//             yAxes: [{//縦軸のスケールを指定
//                 ticks: {
//                     suggestedMax: 10,//縦軸の最大値
//                     suggestedMin: 1,//縦軸の最小値（最小値以下の値があれば自動で変更）
//                     stepSize: 1,//縦軸の間隔
//                     callback: function(value, index, values) {
//                         return value
//                     }
//                 }
//             }]
//         },
//     }
// });
// }
$(document).ready(function() {
    login();
    setInterval('login()', 1000);
});
function login() {
    $.ajax({
      url:'./login_management3.php', //送信先
      type:'POST', //送信方法
      datatype: 'json', //受け取りデータの種類
      data:{
      }
    })
    .then(
        function (data1) {
            console.log(data1);
            // データを更新
            myChart.data.datasets[0].data = data1;
            // チャートを更新
            myChart.update();
        },
        function () {
        }
    );
  }





// キャンバスを取得
const canvas = document.getElementById('myChart');

// チャートのコンテキストを取得
const ctx = canvas.getContext('2d');

// チャートのデータ
const data = {
  labels: ['0分前','1','2','3','4','5','6','7','8','9','10','11','12','13','14','15','16','17','18','19','20','21','22','23','24'],
  datasets: [{
    label: 'ログイン数',
    data: [0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0,0,0,0,0,0,
           0,0,0,0,0],
    backgroundColor: 'rgba(54, 162, 235, 0.2)',
    borderColor: 'rgba(54, 162, 235, 1)',
    borderWidth: 1
  }]
};

// チャートのオプション
const options = {
  responsive: true,
  scales: {
    y: {
      beginAtZero: true
    },
    yAxes: [{//縦軸のスケールを指定
                        ticks: {
                            suggestedMax: 10,//縦軸の最大値
                            suggestedMin: 1,//縦軸の最小値（最小値以下の値があれば自動で変更）
                            stepSize: 1,//縦軸の間隔
                            callback: function(value, index, values) {
                                return value
                            }
                        }
                    }]
  }
};

// 折れ線グラフを作成
const myChart = new Chart(ctx, {
  type: 'line',
  data: data,
  options: options
});