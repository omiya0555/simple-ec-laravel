<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;

            background-color: #3b3b3b;
            color: white;
            padding: 0px 20px;
            opacity: 1;
            height: 70px;
            z-index: 1000; /
        }
        /* ヘッダーのスタイル */
        .header {
* ヘッダーが他のコンテンツの上に表示されるようにする */
        }
        .left, .center, .right {
            display: flex;
            align-items: center;
        }
        .center {
            flex: 1;
            justify-content: center;
        }
        .right {
            justify-content: flex-end;
        }
        .nav-item {
            margin: 0 10px;
            color: white;
            font-weight: bold; /* 太字 */
            text-decoration: none; /* 下線なし */
        }
        .nav-item:hover {
            color: #00ff00; /* ホバー時の色 */
        }
    </style>
</head>
<body>
    <header class="header">
        <!-- Left Section -->
        <div class="left">
            <h1>EC app</h1>
        </div>

        <!-- Center Section -->
        <div class="center">
            <a href="{{ route('ecapp.index') }}" class="nav-item">商品一覧</a>
            <a href="{{ route('cart.index') }}" class="nav-item">カート：{{ $cartItemCount }}</a>
            <a href="{{ route('purchase_details.index') }}" class="nav-item">購入一覧</a>
            <!-- <a href="{{ route('profile.show') }}" class="nav-item">プロフィール</a> -->
        </div>

        <!-- Right Section -->
        <div class="right">
            @auth
                <a href="{{ route('logout') }}" class="nav-item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @endauth
        </div>
    </header>
</body>
</html>
