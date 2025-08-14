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
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark px-4">
        <a class="navbar-brand" href="#">🚀 Dashboard</a>
        <div class="ms-auto d-flex align-items-center justify-content-between gap-3">
            <span class="text-white me-3">Welcome, {{ $user->username }}</span>
            <form action="{{ route('user.logout') }}" method="post">
                @csrf
                <button type="submit" class="btn btn-logout">Logout <i class="bi bi-box-arrow-right ms-1"></i></button>
            </form>
        </div>
    </nav>
    <!-- Dashboard Content -->
    <div class="container dashboard-container">
        <div class="glass-card">
           <div class="info-title d-flex align-items-center">
            <img src="{{ asset('storage/' . $user->photo) }}" 
                 alt="User Photo" 
                 style="width:50px; height:50px; object-fit:cover; border-radius:50%; margin-right:10px; border: 2px solid #fff;">
            <span>{{ $user->username }} Data</span>
        </div>
            <div class="info-text"><strong>Id : </strong> {{ $user->id }}</div>
            <div class="info-text"><strong>Username :</strong> {{ $user->username }}</div>
            <div class="info-text"><strong>Email :</strong> {{ $user->email }}</div>
            <div class="info-text"><strong>phone :</strong> {{ $user->phone }}</div>
            <div class="info-text"><strong>City :</strong> {{ $user->city }}</div>
            <div class="info-text"><strong>Date of Birth :</strong> {{ $user->date_of_birth }}</div>
            <div class="action-buttons mt-4">
                <a href="{{ route('user.edit', $user->id) }}" type="submit" class="btn btn-edit me-2"><i
                        class="bi bi-pencil-square me-1"></i>Edit</a>
            </div>
        </div>
    </div>
</body>

</html>
<div class="game-container">
    <h4 style="text-align: center;">🎮 Game Area</h4>
    <style>
        .tic-tac-toe {
            display: grid;
            grid-template-columns: repeat(3, 100px);
            grid-gap: 10px;
            margin: 30px auto;
            width: max-content;
        }

        .cell {
            width: 100px;
            height: 100px;
            background-color: #f2f2f2;
            font-size: 36px;
            font-weight: bold;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            border-radius: 10px;
            box-shadow: 0 0 8px #ccc;
        }

        .cell:hover {
            background-color: #3e50a0;
        }

        .status {
            text-align: center;
            font-size: 24px;
            margin-top: 20px;
            font-weight: bold;
        }

        .reset-btn {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 6px;
        }

        .reset-btn:hover {
            background-color: #2980b9;
        }
    </style>

    <div class="tic-tac-toe" id="board">
        <div class="cell" onclick="makeMove(0)"></div>
        <div class="cell" onclick="makeMove(1)"></div>
        <div class="cell" onclick="makeMove(2)"></div>
        <div class="cell" onclick="makeMove(3)"></div>
        <div class="cell" onclick="makeMove(4)"></div>
        <div class="cell" onclick="makeMove(5)"></div>
        <div class="cell" onclick="makeMove(6)"></div>
        <div class="cell" onclick="makeMove(7)"></div>
        <div class="cell" onclick="makeMove(8)"></div>
    </div>

    <div class="status" id="status">Player X's turn</div>
    <button class="reset-btn" onclick="resetGame()">Restart Game</button>

    <script>
        let board = ["", "", "", "", "", "", "", "", ""];
        let currentPlayer = "X";
        let gameActive = true;

        function makeMove(index) {
            if (board[index] === "" && gameActive) {
                board[index] = currentPlayer;
                document.getElementsByClassName('cell')[index].textContent = currentPlayer;

                if (checkWinner()) {
                    document.getElementById('status').textContent = `🎉 Player ${currentPlayer} wins!`;
                    gameActive = false;
                } else if (board.every(cell => cell !== "")) {
                    document.getElementById('status').textContent = "😐 It's a draw!";
                    gameActive = false;
                } else {
                    currentPlayer = currentPlayer === "X" ? "O" : "X";
                    document.getElementById('status').textContent = `Player ${currentPlayer}'s turn`;
                }
            }
        }

        function checkWinner() {
            const wins = [
                [0, 1, 2],
                [3, 4, 5],
                [6, 7, 8], // rows
                [0, 3, 6],
                [1, 4, 7],
                [2, 5, 8], // columns
                [0, 4, 8],
                [2, 4, 6] // diagonals
            ];

            return wins.some(comb => {
                return board[comb[0]] !== "" &&
                    board[comb[0]] === board[comb[1]] &&
                    board[comb[1]] === board[comb[2]];
            });
        }

        function resetGame() {
            board = ["", "", "", "", "", "", "", "", ""];
            gameActive = true;
            currentPlayer = "X";
            document.getElementById('status').textContent = `Player ${currentPlayer}'s turn`;
            [...document.getElementsByClassName('cell')].forEach(cell => cell.textContent = "");
        }
    </script>

</div>
</div>

</body>

</html>
