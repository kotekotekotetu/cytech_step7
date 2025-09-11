@extends('layouts.app')

@section('content')
<div class="table-wrapper mx-auto mt-5">
    <h4 class="mb-4">商品一覧画面</h4>

    {{-- 検索フォーム --}}
    <form method="GET" action="{{ route('products.index') }}" class="row mb-4">
        <div class="col-5">
            <input type="text" name="keyword" class="form-control" placeholder="検索キーワード" value="{{ request('keyword') }}">
        </div>
        <div class="col-5">
            <select name="company_id" class="form-control">
                <option value="">メーカー名</option>
                @foreach ($companies as $company)
                    <option value="{{ $company->id }}" {{ request('company_id') == $company->id ? 'selected' : '' }}>
                        {{ $company->company_name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-2">
            <button type="submit" class="btn btn-light btn-sm">検索</button>
        </div>
    </form>

    {{-- 一覧テーブル --}}
    <table class="table border table-striped text-center align-middle">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>商品画像</th>
                <th>商品名</th>
                <th>価格</th>
                <th>在庫数</th>
                <th>メーカー名</th>
                <th>
                    <a href="{{ route('products.create') }}" class="btn btn-warning btn-sm">新規登録</a>
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        @if($product->img_path)
                            <img src="{{ asset('storage/' . $product->img_path) }}" width="10">
                        @else
                            画像なし
                        @endif
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>¥{{ $product->price }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->company->company_name }}</td>
                    <td>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info btn-sm">詳細</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline-block;">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('削除してもよろしいですか？')">削除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- ページネーション --}}
    <div class="d-flex justify-content-center mt-5">
        {{ $products->links('pagination::bootstrap-4') }}
    </div>
</div>
@endsection
