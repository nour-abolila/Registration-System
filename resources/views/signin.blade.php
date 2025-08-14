<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>🔥Login Form</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            height: 100vh;
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #0f2027, #203a43);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
        }

        @keyframes gradientBG {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .top-right {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .btn-signup {
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            border: none;
            color: white;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 12px;
            font-size: 15px;
            box-shadow: 0 8px 20px rgba(0, 114, 255, 0.4);
            transition: all 0.3s ease-in-out;
            text-decoration: none;
            /* ده اللي يمنع الخط تحت الكلمة */
        }


        .btn-signup:hover {
            transform: scale(1.05) rotate(1deg);
            box-shadow: 0 12px 25px rgba(0, 114, 255, 0.7);
        }

        .login-container {
            perspective: 1000px;
            animation: popIn 1s ease-out;
        }

        @keyframes popIn {
            from {
                opacity: 0;
                transform: translateY(-50px) rotateX(20deg);
            }

            to {
                opacity: 1;
                transform: translateY(0) rotateX(0);
            }
        }

        .login-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            padding: 40px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.4);
            color: #fff;
            transform: rotateY(10deg);
            transition: transform 0.5s ease;
        }

        .login-box:hover {
            transform: rotateY(0);
        }

        .login-box h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            text-shadow: 1px 1px 5px #000;
        }

        .form-control {
            background-color: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-control::placeholder {
            color: #ccc;
        }

        .btn-login {
            background: linear-gradient(90deg, #00c6ff, #0072ff);
            border: none;
            border-radius: 10px;
            width: 100%;
            padding: 12px;
            color: #fff;
            font-weight: bold;
            box-shadow: 0 10px 25px rgba(0, 114, 255, 0.5);
            transition: transform 0.3s ease;
        }

        .btn-login:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(0, 114, 255, 0.8);
        }

        @media (max-width: 576px) {
            .login-box {
                padding: 25px;
                transform: none;
            }

            .top-right {
                top: 10px;
                right: 15px;
            }

            .btn-signup {
                padding: 8px 16px;
                font-size: 14px;
            }
        }
    </style>
</head>

<body>
    <!-- زرار Sign Up فوق -->
    <div class="top-right">
        <a href="/signup" class="btn-signup">Sign Up</a>
    </div>

    <div class="login-container">
        <div class="login-box">
            <h2>Welcome Back 👋</h2>
            @if (session('error'))
                <p style="color: red; background: #fdd; padding: 10px; border: 1px solid red; border-radius: 5px;">
                    {{ session('error') }}
                </p>
            @endif
            <form action="{{ route('signin') }}" method="POST" autocomplete="off">
                @csrf
                <!-- خدعة للمتصفح عشان ما يكملش -->
                {{-- <input type="text" name="fakeusernameremembered" style="display:none">
                <input type="password" name="fakepasswordremembered" style="display:none"> --}}
                <input type="text" name="username" class="form-control" placeholder="Username" autocomplete="off"
                    required>
                <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off"
                    required>
                <button type="submit" class="btn btn-login">Sign In</button>
            </form>
        </div>
    </div>
</body>

</html>
