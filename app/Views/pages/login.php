<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #052261 0%, #1a73e8 100%);
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            width: 320px;
            transition: transform 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
        }

        .login-container h2 {
            margin: 0 0 25px;
            text-align: center;
            color: #052261;
            font-size: 28px;
            font-weight: 600;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e1e1e1;
            border-radius: 8px;
            font-size: 15px;
            transition: all 0.3s ease;
            box-sizing: border-box;
        }

        .form-group input:focus {
            border-color: #1a73e8;
            outline: none;
            box-shadow: 0 0 0 3px rgba(26, 115, 232, 0.2);
        }

        .btn {
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 12px;
        }

        .btn-primary {
            background: #052261;
            color: white;
        }

        .btn-primary:hover {
            background: #041b4d;
            transform: translateY(-2px);
        }

        .btn-guest {
            background: #ffffff;
            color: #052261;
            border: 2px solid #052261;
        }

        .btn-guest:hover {
            background: #f8f9fa;
            transform: translateY(-2px);
        }

        .error-message {
            color: #dc3545;
            font-size: 14px;
            margin-bottom: 15px;
            text-align: center;
            padding: 10px;
            background: #fff5f5;
            border-radius: 5px;
            border: 1px solid #ffa7a7;
        }

        .divider {
            margin: 15px 0;
            text-align: center;
            position: relative;
        }

        .divider::before,
        .divider::after {
            content: "";
            position: absolute;
            top: 50%;
            width: 45%;
            height: 1px;
            background-color: #e1e1e1;
        }

        .divider::before {
            left: 0;
        }

        .divider::after {
            right: 0;
        }

        .divider span {
            background-color: white;
            padding: 0 10px;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h2>Welcome Back</h2>

        <?php if (session()->getFlashdata('error')) : ?>
            <div class="error-message">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <form action="/auth/loginProcess" method="post">
            <?= csrf_field() ?>
            <div class="form-group">
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>

        <div class="divider">
            <span>or</span>
        </div>

        <form action="/diklatguest" method="get">
            <button type="submit" class="btn btn-guest">Continue as Guest</button>
        </form>
    </div>
</body>

</html>