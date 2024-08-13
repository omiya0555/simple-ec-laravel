<x-layout title="アカウント退会確認">
    <div style="display:flex; justify-content:center; background-color: darkgray; opacity:0.8; border-radius:10px; padding : 10px; margin:auto; margin-top:30px; width: 700px;">
        <div>
            <h1 style="display:flex; justify-content:center;">アカウント退会確認</h1>

            <p>本当にアカウントを削除してもよろしいですか？</p>

            <form action="{{ route('user.deactivate') }}" method="POST">
                @csrf
                <div>
                    <label for="password">パスワード:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button style="height:40px; width: 300px; margin: 20px;" type="submit">アカウント削除</button>
            </form>
            <a href="{{ route('profile.show') }}" style="display:flex; justify-content:end;">キャンセル</a>
        </div>
    </div>
</x-layout>
