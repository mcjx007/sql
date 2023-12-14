<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>登入</title>
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

        .login-container {
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

        .login-container h2 {
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

        .login-form div {
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

        .login-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }

        .login-form input[type="text"],
        .login-form input[type="password"] {
            width: calc(100% - 10px);
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .login-form input[type="submit"] {
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
    <div class="login-container">
        <h2>登入</h2>
        <form class="login-form" action="login.php" method="post">
            <div>
                <label for="username">帳號:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">密碼:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <input type="submit" value="登入">
            </div>
        </form>
        <div class="register-link">
            <p>建立帳號 <a href="register.php">註冊</a></p>
        </div>
    </div>
</body>
</html>
