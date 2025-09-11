@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <h4 class="mb-5" style="max-width: 550px; margin: 0 auto;">商品情報詳細画面</h4>

    <div class="mx-auto p-4 border rounded" style="max-width: 550px; background-color: #fff;">

        <div class="row mb-3">
            <label class="col-3 col-form-label col-form-label-lg fw-bold fst-italic">ID.</label>
            <div class="col-8 pt-2">
                {{ $product->id }}.
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-3 col-form-label col-form-label-lg fw-bold">商品画像</label>
            <div class="col-8">
                @if($product->img_path)
                    <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-width: 50px; border: 1px solid #ccc;">
                @else
                    <div style="border: 1px solid #ccc; padding: 5px 10px; display: inline-block;">画像</div>
                @endif
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-3 col-form-label col-form-label-lg fw-bold">商品名</label>
            <div class="col-8 pt-2">
                {{ $product->product_name }}
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-3 col-form-label col-form-label-lg fw-bold">メーカー</label>
            <div class="col-8 pt-2">
                {{ $product->company->company_name }}
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-3 col-form-label col-form-label-lg fw-bold">価格</label>
            <div class="col-8 pt-2">
                ¥{{ number_format($product->price) }}
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-3 col-form-label col-form-label-lg fw-bold">在庫数</label>
            <div class="col-8 pt-2">
                {{ $product->stock }}
            </div>
        </div>

        <div class="row mb-3">
            <label class="col-3 col-form-label col-form-label-lg fw-bold">コメント</label>
            <div class="col-8">
                <textarea class="form-control" rows="2" readonly>{{ $product->comment ?? '' }}</textarea>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12">
                <a href="{{ route('products.edit', $product->id) }}" class="btn btn-warning btn-sm px-3 me-3">編集</a>
                <a href="{{ route('products.index') }}" class="btn btn-info btn-sm px-3">戻る</a>
            </div>
        </div>
    </div>
</div>
@endsection
