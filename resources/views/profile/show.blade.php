<x-layout>

    <style>
        .profile-card {
            max-width: 400px;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: darkgray;
            opacity: 0.8;
        }
        .profile-card h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .profile-card p {
            font-size: 18px;
            margin: 10px 0;
        }
        .btn {
            display:flex;
            justify-content:center;
            align-items:center;
            margin:auto;
            background-color: #000;
            color: #fff;
            text-align: center;
            opacity: 0.8;
            margin-top: 20px;
            width: 430px;
            height:50px;
        }
    </style>
<body>
    <h1 class="d-flex justify-content-center m-2">PROFILE</h1>
    
    <div class="profile-card">
        <h2>プロフィール情報</h2>
        <p><strong>ID:</strong> {{ $user->id }}</p>
        <p><strong>NAME:</strong> {{ $user->name }}</p>
        <p><strong>MAIL:</strong> {{ $user->email }}</p>
    </div>

    <div class="footer">
    <form action="{{ route('user.confirm.deactivation') }}" method="GET">
            <button type="submit" class="btn">退会</button>
        </form>
    </div>

</x-layout>
