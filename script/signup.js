function inputCheck () {
    var form = document.getElementById("id");
    var form_value = form.value;
    
    if (form_value.match(/[0-9]{1,1}/g) != form_value ) {
      form.value = '';
    }
  }