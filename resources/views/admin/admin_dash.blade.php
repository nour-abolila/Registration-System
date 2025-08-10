<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>📊 Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(-45deg, #1e3c72, #2a5298, #0f2027, #203a43);
            background-size: 400% 400%;
            animation: gradientBG 10s ease infinite;
            font-family: 'Segoe UI', sans-serif;
            color: #fff;
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

        .navbar {
            background-color: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(8px);
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .navbar-brand {
            font-weight: bold;
        }

        .btn-logout {
            background: linear-gradient(90deg, #ff416c, #ff4b2b);
            border: none;
            padding: 8px 18px;
            border-radius: 30px;
            color: white;
            font-weight: bold;
            transition: 0.3s ease;
        }

        .btn-logout:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(255, 75, 43, 0.6);
        }

        .dashboard-container {
            padding: 50px 15px;
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 30px;
            backdrop-filter: blur(15px);
            box-shadow: 0 20px 30px rgba(0, 0, 0, 0.4);
            transition: all 0.4s ease;
        }

        .glass-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.5);
        }

        .info-title {
            font-weight: bold;
            font-size: 22px;
            margin-bottom: 10px;
        }

        .info-text {
            margin-bottom: 6px;
        }

        .action-buttons .btn {
            border-radius: 10px;
            padding: 8px 16px;
            font-weight: bold;
        }

        .btn-edit {
            background-color: #00c6ff;
            border: none;
            color: #fff;
        }

        .btn-edit:hover {
            background-color: #009fc2;
        }

        .btn-delete {
            background-color: #ff4d4d;
            border: none;
            color: #fff;
        }

        .btn-delete:hover {
            background-color: #d63031;
        }

        @media (max-width: 576px) {
            .glass-card {
                padding: 20px;
            }
        }

        .create-post-btn {
            background-color: white;
            color: black;
            font-weight: bold;
            border: 2px solid black;
            transition: all 0.3s ease;
        }

        .create-post-btn:active {
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark px-4">
        <a class="navbar-brand" href="#">🚀 Dashboard</a>
        <div class="ms-auto">
            <span class="text-white me-3">Welcome {{ Auth::user()->username }}</span>
            <form action="{{ route('admin.logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-logout">Logout <i class="bi bi-box-arrow-right ms-1"></i></button>
            </form>
        </div>
    </nav>

    <!-- Content -->
    <div class="container my-5 animate__animated animate__fadeIn">
        <div class="text-center mb-3">
            <a class="btn create-post-btn">User Registration</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered text-center align-middle">
                <thead style="background-color: #ffeeba;">
                    <tr>
                        <th>Id</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>phone</th>
                        <th>City</th>
                        <th>date_of_birth</th>
                        <th>created_at</th>
                        <th>updated_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- هنا خزنت المتغير بتاعى فى متغير جديد --}}
                    @foreach ($data as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->city }}</td>
                            <td>{{ $item->date_of_birth }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>{{ $item->updated_at }}</td>
                            <td>
                                <div class="d-flex flex-wrap justify-content-center gap-1">
                                    <a class="btn btn-info">View</a>
                                    <a class="btn btn-primary">Edit</a>
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="d-flex justify-content-center mt-3">
            {{ $data->links('pagination::bootstrap-5') }}
        </div>


    </div>
</body>

</html>
