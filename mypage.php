<?php session_start(); ?>
<?php require 'default/header.php'; ?>
 
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.9.3/css/bulma.min.css">
 

    <style>
        p{
          text-align:center;
        }
       .human {
          text-align:center;
        }
        .link{
          text-align:center;
   
          margin-left:120px
        }
        .button {
          text-align:center;
       margin-top: 5%;
    margin-bottom: 5%;
    width: 100px;
    border: 0;
    background-color: lightgray;
    padding-top: 16px;
    padding-bottom: 40px;
        }
        .fa-user-circle{
       
        }
    </style>
<form action="purchase_history.php">
    <p><?= $_SESSION['account']['mail_address'] ?></p>
 <div class="human">
      <i class="fas fa-user-circle fa-10x"></i>
</div>
    <p><?= $_SESSION['account']['account_name'] ?></p>
<div class="link">
    <a href="profile.php">プロフィール編集</a>
</div>  
    <p><input type="submit" class="button_de button is-success is-outlined is-rounded" value="購入履歴" class="button"></p>
     
  </form>
   
<?php require 'modules/navigation.php'; ?>
<?php require 'modules/footer.php'; ?>
