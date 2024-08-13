<x-layout title="ECapp">
    <h1 class="d-flex justify-content-center m-2">購入履歴</h1>

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


        <div class="d-flex justify-content-center m-4">
        <table class="table">
        <thead>
            <tr style="background: gray; color: white;">
            <th scope="col">日時</th>
            <th scope="col">合計金額</th>
            <th scope="col" style="width:70%;">購入商品</th>
            </tr>
        </thead>
            <tbody>



        @foreach($purchaseDetails as $purchaseDetail)
                <tr>
                    <td style="font-size: 18px;">{{ $purchaseDetail->created_at }}</td>
                    <td style="font-size: 22px;">{{ $purchaseDetail->total_amount }}円</td>
                    <td>
                        <table class="table" style="background-color:whitesmoke; border-radius:5px;">
                            <thead>
                                <tr>
                                <th scope="col">画像</th>
                                <th scope="col">商品名</th>
                                <th scope="col">価格</th>
                                <th scope="col">配送状況</th>
                                </tr>
                            </thead>
                            <tbody>
                        @foreach ($purchaseDetail->purchaseItems as $purchaseItem)
                                <tr>
                                    <td><img src="{{ $purchaseItem->product_image_path }}" alt="{{ $purchaseItem->product_title }}" style="width:100px; height: 100px;"></td>
                                    <td style="width:200px;">{{ $purchaseItem->product_title }}</td>
                                    <td>{{ $purchaseItem->product_price }}</td>
                                    <td>
                                    @php
                                        $userRole = $purchaseItem->status;
                                    @endphp

                                    @switch($userRole)
                                        @case(1)
                                            <p>未配送</p>
                                            @break
                                        @case(2)
                                            <p>配送中</p>
                                            @break
                                        @case(3)
                                            <p>配送済</p>
                                            @break
                                        @case(4)
                                            <p>キャンセル</p>
                                            @break
                                        @default
                                            <p>不明</p>
                                    @endswitch
                                </td>
                                </tr>
                        @endforeach
                            </tbody>
                        </table>
                    </td>
                </tr>
        @endforeach
            </tbody>
        </table>
    </div>

    @endif
</x-layout>