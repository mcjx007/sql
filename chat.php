<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>聊天室</title>
    <style>
        /* 外觀樣式 */
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            height: 100vh;
            overflow: hidden;
            background-color: #f5f5f5;
        }

        header {
            background-color: #007bff;
            color: #fff;
            padding: 10px;
            text-align: center;
        }

        main {
            flex: 1;
            overflow-y: auto;
            padding: 20px;
        }

        footer {
            background-color: #fff;
            padding: 10px;
            display: flex;
            align-items: center;
            box-shadow: 0 -2px 5px rgba(0, 0, 0, 0.1);
        }

        input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            font-size: 14px;
            outline: none;
        }

        button {
            padding: 8px 16px;
            border: none;
            background-color: #007bff;
            color: #fff;
            border-radius: 0 4px 4px 0;
            cursor: pointer;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #0056b3;
        }

        .message {
            display: flex;
            justify-content: flex-start;
            margin-bottom: 10px;
        }

        .message.sent {
            justify-content: flex-end;
        }

        .message-bubble {
            background-color: #d3d3d3;
            padding: 10px;
            border-radius: 8px;
            max-width: 70%;
            word-wrap: break-word;
            position: relative;
        }

        .message-text {
            margin: 0;
            word-break: break-all;
        }

        /* 新增的時間和使用者名稱顯示樣式 */
        .message-meta {
            font-size: 12px;
            color: #666;
            margin-top: 3px; /* 調整時間與文字之間的距離 */
        }

        .message-username {
            font-weight: bold;
            margin-bottom: 3px; /* 調整使用者名稱與文字之間的距離 */
        }
    </style>
</head>
<body>
    <header>
        <h1>聊天室</h1>
    </header>

    <main id="chat-box"></main>

    <footer>
        <input type="text" id="input-box" placeholder="輸入訊息...">
        <button id="send-button" onclick="sendMessage()">發送</button>
    </footer>

    <script>
        function sendMessage() {
            var message = document.getElementById('input-box').value.trim();
            if (message !== '') {
                var username = "使用者名稱"; // 將此處替換為您的用戶名稱

                // AJAX 请求发送消息到 PHP 后端
                var xhr = new XMLHttpRequest();
                xhr.open("POST", "chat.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            console.log("Message sent successfully");
                            // 在此添加任何其他操作（例如，更新聊天窗口）
                        } else {
                            console.error("Error:", xhr.status);
                        }
                    }
                };
                xhr.send("username=" + encodeURIComponent(username) + "&message=" + encodeURIComponent(message));
                
                // ...其余的创建消息元素并显示在聊天窗口的代码（与你之前的代码相同）
                var chatBox = document.getElementById('chat-box');
                var newMessage = document.createElement('div');
                newMessage.classList.add('message');
                newMessage.classList.add('sent');

                var newMessageBubble = document.createElement('div');
                newMessageBubble.classList.add('message-bubble');

                var messageUsername = document.createElement('div');
                messageUsername.classList.add('message-username');
                messageUsername.textContent = username;
                newMessageBubble.appendChild(messageUsername);

                var newMessageText = document.createElement('p');
                newMessageText.classList.add('message-text');
                newMessageText.textContent = message;
                newMessageBubble.appendChild(newMessageText);

                var currentTime = new Date();
                var hours = currentTime.getHours();
                var minutes = currentTime.getMinutes();
                var timeString = hours + ':' + (minutes < 10 ? '0' + minutes : minutes);

                var messageMeta = document.createElement('div');
                messageMeta.classList.add('message-meta');
                messageMeta.textContent = timeString;
                newMessageBubble.appendChild(messageMeta);

                newMessage.appendChild(newMessageBubble);
                chatBox.appendChild(newMessage);
                document.getElementById('input-box').value = '';
                chatBox.scrollTop = chatBox.scrollHeight;
            }
        }

        document.getElementById('input-box').addEventListener('keypress', function (e) {
            if (e.key === 'Enter') {
                sendMessage();
            }
        });
    </script>
    
    <?php
    // 连接到数据库并保存消息
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "";
        $dbname = "dbsql";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $message = $_POST['message'];
        $username = $_POST['username'];

        $sql = "INSERT INTO chat (username, message) VALUES ('$username', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo "Message sent successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }

        $conn->close();
    }
    ?>
</body>
</html>
