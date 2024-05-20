const app = new Vue({
  el: '#app', // Vue.jsを適用する要素のCSSセレクター 
  data() {
    return {
        image_name : "ファイルを選択...",
    }
  },
  methods: {
    onImageUploaded(e) {
      // event(=e)から画像データを取得する
      const image = e.target.files[0];
      this.image_name=image.name;
    },
    Myrecipes_dropdown(){
      document.getElementById('Myrecipes').classList.toggle("is-active");
    },
    logout(){
      var result = window.confirm('ログアウトしますか？');
      if( result ) {
      location.href = "logout.php";
      }
    else {
    }
    }
  }
})

function change(e){
  const elm = e.target.parentNode.querySelector('.contents-hide');
  e.target.classList.toggle("on-click");
  elm.classList.toggle("open"); 
  if(elm.classList.contains("open")){
     elm.style.height = elm.scrollHeight + 'px';
  }else{
     elm.style.height = "0";
  }
}

//材料テーブルjs
function deleteIngredient(element) {
    var row1 = element.closest('.ingredient_item');
    row1.parentNode.removeChild(row1);
  }
  
  function addIngredientRow() {
    var tbody1 = document.getElementById('ingredient_tbody');
    var newRow1 = document.createElement('tr');
    newRow1.className = 'ingredient_item';
    newRow1.innerHTML = `
      <td class="width55"><input type="text" class="input mb-2" name="ingredient_name[]" placeholder="材料" required></td>
      <td class="width35"><input type="text" class="input mb-2" name="ingredient_quantity[]" placeholder="分量" required></td>
      <td class="width5 clear-column pb-2"><span class="ingredient_close-icon" onclick="deleteIngredient(this)">✖</span></td>
    `;
    tbody1.appendChild(newRow1);
  }

  //作り方テーブルjs
  function deleteCooking(element) {
    var row2 = element.closest('.cooking_item');
    row2.parentNode.removeChild(row2);
  }
  
  function addCookingRow() {
    var tbody2 = document.getElementById('cooking_tbody');
    var newRow2 = document.createElement('tr');
    newRow2.className = 'cooking_item';
    newRow2.innerHTML = `
      <td class="width95 pr-2"><textarea class="textarea mb-2" name="cooking_procedure[]" placeholder="作り方" rows="2" cols="40" required></textarea></td>
      <td class="width5 clear-column pb-2"><span class="cooking_close-icon" onclick="deleteCooking(this)">✖</span></td>
    `;
    tbody2.appendChild(newRow2);
  }

  function delete_recipe(e){
    const id = e.target.childNodes[0].value;
    const name = e.target.childNodes[1].value;
    var result = window.confirm(name+'\nを削除しますか？');
    if( result ) {
      alert("レシピが削除されました！");
      location.href = "recipe-delete.php?recipe_id="+id;
  }
  else {
  }
  }

  function delete_customer(){
    const form = document.getElementById("form");
    if(form.checkValidity()){
      alert("アカウントが削除されました");
      document.customer_delete.submit();
    } 
  }

  function delete_cart_product(e){
    const id = e.target.childNodes[0].value;
    location.href = "cart-show-change-stock.php?change=delete&product_id="+id;
  }

  function cart_change(e){
    const id = e.target.nextElementSibling.value;
    const value=e.target.value;
    location.href = "cart-show-change-stock.php?change="+value+"&product_id="+id;
  }

  function onfilter(){
    const el = document.getElementById("filter")
    el.classList.toggle('is-active');
  }