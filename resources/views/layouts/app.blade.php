<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tech News</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            background: linear-gradient(135deg, #06052a, #232026);
            color: #1f2937;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            padding: 60px 20px;
        }

        .card {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .btn {
            background: linear-gradient(135deg, #6366f1, #8b5cf6);
            color: white;
            padding: 10px 18px;
            border-radius: 10px;
            text-decoration: none;
            display: inline-block;
            border: none;
            cursor: pointer;
        }

        .btn:hover {
            opacity: 0.9;
        }

        .btn-danger {
            background: #ef4444;
        }

        .btn-success {
            background: #10b981;
        }

        .input {
            width: 100%;
            padding: 12px;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin-bottom: 15px;
        }

        h1 {
            color: white;
            text-align: center;
            margin-bottom: 30px;
        }

        .top-bar {
            position: absolute;
            top: 20px;
            right: 30px;
        }

        .top-bar span {
            color: white;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <!-- 🔐 AUTH NAVBAR -->
    <div class="top-bar">

        @auth
            <span>{{ auth()->user()->name }}</span>

            <form method="POST" action="/logout" style="display:inline;">
                @csrf
                <button class="btn">Logout</button>
            </form>
        @endauth

        @guest
            <a href="/login" class="btn">Login</a>
            <a href="/register" class="btn" style="margin-left:10px;">Register</a>
        @endguest

    </div>

    <div class="container">
        <h1>Tech News 🚀</h1>

        <div class="card">
            @yield('content')
        </div>
    </div>

</body>
</html>