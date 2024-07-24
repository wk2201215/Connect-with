function inputCheck () {
    var form1 = document.getElementById("pas1");
    var form_value1 = form1.value;
    
    if (form_value1.match(/[0-9]{1,1}/g) != form_value1 ) {
      form1.value = '';
    }

    var form2 = document.getElementById("pas2");
    var form_value2 = form2.value;
    
    if (form_value2.match(/[0-9]{1,1}/g) != form_value2 ) {
      form2.value = '';
    }

    var form3 = document.getElementById("pas3");
    var form_value3 = form3.value;
    
    if (form_value3.match(/[0-9]{1,1}/g) != form_value3 ) {
      form3.value = '';
    }

    var form4 = document.getElementById("pas4");
    var form_value4 = form4.value;
    
    if (form_value4.match(/[0-9]{1,1}/g) != form_value4 ) {
      form4.value = '';
    }
  }