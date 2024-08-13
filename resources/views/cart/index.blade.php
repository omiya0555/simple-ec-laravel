<x-layout title="ECapp">
    <h1 class="d-flex justify-content-center m-2">カート</h1>

    @if (session('error'))
        <div class="d-flex justify-content-center text-center alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="d-flex justify-content-center text-center alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($message))
        <div class="alert alert-info" style="color: white;font-weight: bold;font-size: large;background: black;padding: 1em;border-radius: 10px;opacity: 0.6;display: flex;justify-content: center;width: 80%;margin: auto;">
            {{ $message }}
        </div>
    @endif

    @if (!isset($message))
        <form action="{{ route('purchase_details.index') }}" method="POST" class="
            d-flex justify-content-center mb-2">
            @csrf
            <button type="submit" class="btn btn-secondary" style="width:170px; height:65px; font-size:large;opacity: 0.8;">購入</button>
        </form>

        <div class="d-flex justify-content-center m-4">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">画像</th>
                        <th scope="col">商品名</th>
                        <th scope="col">説明</th>
                        <th scope="col">価格</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($cartItems as $cart)
                <tr>
                    <td><img src="{{$cart->product->image_path}}" alt="{{$cart->product->title}}" style="width:150px; height: 150px;"></td>
                    <td>{{$cart->product->title}}</td>
                    <td>{{$cart->product->description}}</td>
                    <td>¥{{$cart->product->price}}</td>
                    <td>
                    <form action="{{ route('cart.delete') }}" method="POST">
                        @csrf
                        <input type="hidden" name="cart_id" value="{{ $cart->id }}">
                        <button type="submit" class="btn btn-secondary">戻す</button>
                    </form>
                    </td>
                </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>