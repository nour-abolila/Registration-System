<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>✨ Sign Up</title>
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

        .signup-container {
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

        .signup-box {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            backdrop-filter: blur(15px);
            padding: 40px;
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.4);
            color: #fff;
            transform: rotateY(10deg);
            transition: transform 0.5s ease;
        }

        .signup-box:hover {
            transform: rotateY(0);
        }

        .signup-box h2 {
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

        .btn-signup {
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

        .btn-signup:hover {
            transform: scale(1.05);
            box-shadow: 0 15px 35px rgba(0, 114, 255, 0.8);
        }

        @media (max-width: 576px) {
            .signup-box {
                padding: 25px;
                transform: none;
            }
        }
    </style>
</head>

<body>
    <div class="signup-container">
        <div class="signup-box">
            <h2>Create Your Account 🚀</h2>
            <form action="{{ route('store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')

                @error('username')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="text" name="username" class="form-control" placeholder="Username"
                    value="{{ old('username') }}" required>

                @error('email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="email" name="email" class="form-control" placeholder="Email"
                    value="{{ old('email') }}" required>

                @error('password')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="password" name="password" class="form-control" placeholder="Password"
                    value="{{ old('password') }}" required>

                <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password"
                    required>

                @error('phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="tel" name="phone" class="form-control" placeholder="phone"
                    value="{{ old('phone') }}" required>

                @error('city')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="text" name="city" class="form-control" placeholder="City"
                    value="{{ old('city') }}" required>

                @error('date_of_birth')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="date" name="date_of_birth" class="form-control" placeholder="Date of Birth"
                    value="{{ old('date_of_birth') }}" required>

                @error('photo')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                <input type="file" name="photo" id="photo" class="form-control" placeholder="photo"
                    value="{{ old('photo') }}" required>

                <button type="submit" class="btn btn-signup">Sign Up</button>
            </form>
        </div>
    </div>
</body>

</html>
