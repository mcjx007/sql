<!DOCTYPE html>
<html lang="zh-Hant">
<head>
    <meta charset="UTF-8">
    <title>註冊</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .register-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            width: 320px;
            text-align: center;
            animation: fadeIn 1s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-container h2 {
            margin-bottom: 20px;
            color: #333;
            animation: bounceIn 1s ease-out;
            animation-delay: 0.5s;
        }

        @keyframes bounceIn {
            from {
                opacity: 0;
                transform: scale(0.5);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .register-form div {
            margin-bottom: 15px;
            text-align: left;
            opacity: 0;
            transform: translateY(20px);
            animation: formItems 1s forwards ease-out;
            animation-delay: 0.8s;
        }

        @keyframes formItems {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .register-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .register-form input[type="text"],
        .register-form input[type="password"] {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .register-form input[type="submit"] {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 4px;
            background-color: #007bff;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            font-size: 16px;
            animation: buttonPulse 1s infinite alternate ease-in-out;
            animation-delay: 1s;
        }

        @keyframes buttonPulse {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.05);
            }
        }

        .register-link {
            margin-top: 15px;
            font-size: 14px;
            animation: linkFadeIn 1s forwards ease-out;
            animation-delay: 1.2s;
        }

        @keyframes linkFadeIn {
            to {
                opacity: 1;
            }
        }

        .register-link a {
            color: #007bff;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .register-link a:hover {
            text-decoration: underline;
            color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>註冊</h2>
        <form class="register-form" action="register.php" method="post">
            <div>
                <label for="username">帳號:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">密碼:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="註冊">
            </div>
        </form>
        <div class="register-link">
            <p>已有帳號<a href="index.php">登入</a></p>
        </div>
    </div>
    <?php
    // 這是 register.php 中進行註冊操作的程式碼
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $host = "127.0.0.1";
        $dbuser = "root";
        $dbpassword = "";
        $dbname = "dbsql";
    
        $conn = new mysqli($host, $dbuser, $dbpassword, $dbname);
    
        if ($conn->connect_error) {
            die("連線失敗: " . $conn->connect_error);
        }
    
        $username = $_POST["username"];
        $password = $_POST["password"];

        $stmt = $conn->prepare("INSERT INTO username (username, password) VALUES (?, ?)");
        $stmt->bind_param("ss", $username, $password);
    
        if ($stmt->execute()) {
            // 註冊成功時顯示成功訊息
            echo "<script>alert('註冊成功！您現在可以使用您的帳號登入。'); window.location.href = 'index.php';</script>";
            exit(); // 確保後續代碼不會執行
        } else {
            echo "<p>註冊失敗。請稍後重試。</p>";
        }
    
        $stmt->close();
        $conn->close();
    }
    ?>


</body>
</html>
