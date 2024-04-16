<!DOCTYPE html>
<html>
<head>
    <title>Chat Page</title>
    <style>
        #messages {
            height: 300px;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <h1>Chat Page</h1>
    <div id="messages"></div>
    <input type="text" id="messageInput" placeholder="Type your message">
    <button onclick="sendMessage()">Send</button>

    <script>
        var conn = new WebSocket('ws://localhost:8080');
        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            var message = JSON.parse(e.data);
            var messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML += message.sender + ': ' + message.content + '<br>';
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        };

        function sendMessage() {
            var messageInput = document.getElementById('messageInput');
            var message = messageInput.value;
            var senderID = <?php echo $loggedInUserID; ?>;
            var receiverID = <?php echo $otherUserID; ?>;
            var data = {
                senderID: senderID,
                receiverID: receiverID,
                message: message
            };
            conn.send(JSON.stringify(data));
            messageInput.value = '';
        }
    </script>
</body>
</html>
