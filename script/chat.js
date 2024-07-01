$(document).ready(function () {
    $("#chatroom_input").on("click", function() {
        location.href='./chat-input.php?to=1';
    });
    $("#chatroom_invitation").on("click", function() {
        location.href='./chat-invitation.php';
    });
    $("#to").on("click", function() {
        var to = $(this).data('id');
        location.href='./chat-input.php?to='+to;
    });
});