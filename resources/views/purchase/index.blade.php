<x-layout title="ECapp">
    <h1 class="d-flex justify-content-center m-2">PURCHASE</h1>

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (isset($message))
        <div class="alert alert-info" style="color: white;font-weight: bold;font-size: large;background: black;padding: 1em;border-radius: 10px;opacity: 0.6;display: flex;justify-content: center;width: 80%;margin: auto;">
            {{ $message }}
        </div>
    @endif

    @if (!isset($message))

        
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Image</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
            @foreach($purchases as $purchase)
                    <tr>
                        <td><img src="{{$purchase->image_path}}" alt="{{$purchase->title}}" style="width:100px;height:100px;"></td>
                        <td>{{$purchase->title}}</td>
                        <td style="width: min(300px, 900px);">{{$purchase->description}}</td>
                        <td>¥{{$purchase->price}}</td>
                        <td>
                            <form action="{{ route('purchase.cancel') }}" method="POST">
                            @csrf
                                <div>【発送状況】<br/>
                                @switch($purchase->status)
                                    @case(1)
                                        未配送<br/>
                                        <input type="hidden" name="product_id" value="{{ $purchase->product_id }}">
                                        <button type="submit" style="text-align:center;width:120px;height:40px;">キャンセル</button>

                                        @break
                                    @case(2)
                                        配送中
                                        @break
                                    @case(3)
                                        配送済み
                                        @break
                                    @case(4)
                                        キャンセル
                                        @break
                                    @default
                                        不明
                                @endswitch
                                </div>
                            </form>
                        </td>
                    </tr>
            @endforeach
                </tbody>
            </table>
        </div>
    @endif
</x-layout>