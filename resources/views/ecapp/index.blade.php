<x-layout title="ECapp">
    <h1 class="d-flex justify-content-center m-2">商品一覧</h1>

    @if (session('success'))
        <div class="d-flex justify-content-center text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="d-flex justify-content-center text-center m-4 p-4">
        <table class="table">
        <thead>
            <tr>
            <th scope="col">画像</th>
            <th scope="col">商品名</th>
            <th scope="col">説明</th>
            <th scope="col">価格</th>
            <th scope="col">#</th>
            <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
        @foreach($products as $product)
            <tr>
            <td><img src="{{ $product->image_path }}" alt="{{ $product->title }}" style="width:200px; height: 200px;"></td>
            <td style="font-size:18px;">{{ $product->title }}</td>
            <td style="width: 30%">{{ $product->description }}</td>
            <td>¥{{ $product->price }}</td>
            <td>
                <form action="{{ route('cart.add') }}" method="POST">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    @csrf
                    <button type="submit" class="btn btn-secondary">カートに追加</button>
                </form>
            </td>
            <td>
                <form action="{{ route('cart.index') }}" method="GET" class="
                    d-flex justify-content-center mb-2">
                    @csrf
                    <button type="submit" class="btn btn-secondary">カートを見る</button>
                </form>
            </td>
            </tr>
        @endforeach
        </tbody>
        </table>
    </div>

</x-layout>