<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body> -->
<?php include '../app/assets/layout/header.php'; ?>
<div class="container">
    <div id="name-input">
        <input type="text" id="username-input" placeholder="Enter your name">
        <button id="join-button">Join Chat</button>
    </div>

    <div id="chat-box" style="display: none;">
        <div id="chat-messages"></div>
        <input type="text" id="message-input">
        <button id="send-button">Send</button>
    </div>
</div>

<script>
    var conn;
    var username;

    $('#join-button').click(function () {
        var name = $('#username-input').val().trim();
        if (name !== '') {
            username = name;
            $('#name-input').hide();
            $('#chat-box').show();
            conn = new WebSocket('ws://localhost:8080');
            conn.onopen = function (e) {
                console.log("Connection established!");
                // Gửi tên người dùng lên server khi kết nối được thiết lập
                conn.send(JSON.stringify({ action: 'setName', name: username }));
            };

            conn.onmessage = function (e) {
                var data = JSON.parse(e.data);
                if (data.action === 'message') {
                    // Hiển thị tin nhắn cùng với tên người gửi
                    $('#chat-messages').append('<div><strong>' + data.sender + ':</strong> ' + data.message + '</div>');
                }
            };
        }
    });

    $('#send-button').click(function () {
        var message = $('#message-input').val();
        if (message.trim() !== '') {
            // Gửi tin nhắn cùng với username lên server
            conn.send(JSON.stringify({ action: 'message', sender: username, message: message }));
            $('#message-input').val('');
            // Hiển thị tin nhắn của chính người gửi
            $('#chat-messages').append('<div><strong>You:</strong> ' + message + '</div>');
        }
    });
</script>
<?php include '../app/assets/layout/footer.php'; ?>
<!-- </body>
</html> -->