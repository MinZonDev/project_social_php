<!DOCTYPE html>
<html>
<head>
    <title>Chat Page</title>
</head>
<body>
    <h1>Chat Page</h1>
    <form id="userForm" onsubmit="startChat(); return false;">
        <label for="username">Enter username to chat:</label>
        <input type="text" id="username" name="username">
        <input type="submit" value="Start Chat">
    </form>

    <div id="chatBox" style="display: none;">
        <div id="messages"></div>
        <input type="text" id="messageInput" placeholder="Type your message">
        <button onclick="sendMessage()">Send</button>
    </div>

    <script>
        var conn = new WebSocket('ws://localhost:8080');
        var currentChatUser = '';

        conn.onopen = function(e) {
            console.log("Connection established!");
        };

        conn.onmessage = function(e) {
            var message = JSON.parse(e.data);
            var messagesDiv = document.getElementById('messages');
            messagesDiv.innerHTML += message.sender + ': ' + message.content + '<br>';
            messagesDiv.scrollTop = messagesDiv.scrollHeight;
        };

        function startChat() {
            var usernameInput = document.getElementById('username');
            currentChatUser = usernameInput.value;
            document.getElementById('userForm').style.display = 'none';
            document.getElementById('chatBox').style.display = 'block';
        }

        function sendMessage() {
            var messageInput = document.getElementById('messageInput');
            var message = messageInput.value;
            var data = {
                sender: '<?php echo $loggedInUserID; ?>', // Replace with actual logged in user ID
                receiver: currentChatUser,
                content: message
            };
            conn.send(JSON.stringify(data));
            messageInput.value = '';
        }
    </script>
</body>
</html>
