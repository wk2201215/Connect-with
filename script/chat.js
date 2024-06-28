$(document).ready(function () {
    $("#chatroom_input").on("click", function() {
        location.href='./chat-input.php?chat=1';
    });
    $("#chatroom_invitation").on("click", function() {
        location.href='./chat-invitation.php';
    });
    $("#to").on("click", function() {
        
        location.href='./chat-input.php?chat=2';
    });
});