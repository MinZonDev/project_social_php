<!-- chat_view.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chat</title>
    <style>
        #chat-box {
            width: 300px;
            height: 300px;
            border: 1px solid #ccc;
            overflow-y: scroll;
        }
    </style>
</head>
<body>
    <div id="chat-box"></div>
    <input type="text" id="message" placeholder="Type your message...">
    <button onclick="sendMessage()">Send</button>

    <script>
        var chatBox = document.getElementById('chat-box');
        var messageInput = document.getElementById('message');

        function sendMessage() {
            var message = messageInput.value.trim();
            if (message !== '') {
                // Send message to server via AJAX or WebSocket
                // Example using AJAX:
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'send_message.php', true);
                xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                xhr.onreadystatechange = function () {
                    if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                        // Handle response
                    }
                };
                xhr.send('message=' + encodeURIComponent(message));
                
                messageInput.value = ''; // Clear input after sending message
            }
        }

        function receiveMessages() {
            // Receive messages from server via AJAX or WebSocket
            // Example using AJAX:
            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'receive_messages.php', true);
            xhr.onreadystatechange = function () {
                if (xhr.readyState == XMLHttpRequest.DONE && xhr.status == 200) {
                    // Update chat box with received messages
                    chatBox.innerHTML = xhr.responseText;
                    chatBox.scrollTop = chatBox.scrollHeight; // Scroll to bottom
                }
            };
            xhr.send();
        }

        // Update chat every second (you may adjust this interval as needed)
        setInterval(receiveMessages, 1000);
    </script>
</body>
</html>
