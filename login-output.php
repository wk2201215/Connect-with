<?php
session_start(); // Start the session
unset($_SESSION['account']); // Unset any existing session data

require 'function/not-access.php';
require 'db/db-connect.php';

try {
    $pdo = new PDO($connect, USER, PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare and execute the SQL statement to fetch account details
    $sql = $pdo->prepare('SELECT * FROM account WHERE mail_address = ?');
    $sql->execute([$_POST['mail_address']]);

    // Loop through the results
    foreach ($sql as $row) {
        // Verify the password
        if (password_verify($_POST['password'], $row['account_password'])) {
            // Check if the delete_flag is not set to 1
            if ($row['delete_flag'] != 1) {
                // Set the session variables
                $_SESSION['account'] = [
                    'account_id' => $row['account_id'],
                    'mail_address' => $row['mail_address'],
                    'account_password' => $row['account_password'],
                    'account_name' => $row['account_name'],
                    'photograph_id' => $row['photograph_id'],
                    'self_introduction' => $row['self_introduction'],
                    'authority' => $row['authority'],
                    'delete_flag' => $row['delete_flag']
                ];
                $sql2 = $pdo->prepare('SELECT * FROM photograph WHERE photograph_id = ?');
                $sql2->execute([$_SESSION['account']['photograph_id']]);
                $path=$sql2->fetch();
                $_SESSION['account']['photograph_path'] = $path['photograph_path'];
            }
        }
    }
    // var_dump($_SESSION);
    // Check if the account session is set
    if (isset($_SESSION['account'])) {
        // Redirect based on user authority
        if ($_SESSION['account']['authority'] == 1) {
            header('Location:administrator-userList.php');
        } else {
            header('Location:top.php');
        }
        exit();
    } else {
        // Redirect to the login page with an error message
        header('Location:login-input.php?hogeA=※ログイン名またはパスワードが違います');
        exit();
    }
} catch (PDOException $e) {
    echo "Database error: " . $e->getMessage();
}
?>
