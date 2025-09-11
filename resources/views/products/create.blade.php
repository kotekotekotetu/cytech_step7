@extends('layouts.app')

@section('content')

<div class="container mt-5 mb-5">
    <h4 class="mb-5" style="max-width: 550px; margin: 0 auto;">商品新規登録画面</h4>

    <div class="mx-auto p-4 border rounded" style="max-width: 550px; background-color: #fff;">
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf


            <div class="row mb-3">
                <label for="product_name" class="col-3 col-form-label col-form-label-lg fw-semibold">
                    商品名 <span class="text-danger">*</span>
                </label>
                <div class="col-8">
                    <input type="text" class="form-control" id="product_name" name="product_name" value="{{ old('product_name') }}">
                    @error('product_name')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="company_id" class="col-3 col-form-label col-form-label-lg fw-semibold">
                    メーカー名 <span class="text-danger">*</span>
                </label>
                <div class="col-8">
                    <select id="company_id" class="form-control" name="company_id">
                        <option value="">選択してください</option>
                        @foreach($companies as $company)
                        <option value="{{ $company->id }}" {{ old('company_id') == $company->id ? 'selected' : '' }}>
                            {{ $company->company_name }}
                        </option>
                        @endforeach
                    </select>
                    @error('company_id')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="price" class="col-3 col-form-label col-form-label-lg fw-semibold">
                    価格 <span class="text-danger">*</span>
                </label>
                <div class="col-8">
                    <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
                    @error('price')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="stock" class="col-3 col-form-label col-form-label-lg fw-semibold">
                    在庫数 <span class="text-danger">*</span>
                </label>
                <div class="col-8">
                    <input type="number" class="form-control" id="stock" name="stock" value="{{ old('stock') }}">
                    @error('stock')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="comment" class="col-3 col-form-label col-form-label-lg fw-semibold">
                    コメント
                </label>
                <div class="col-8">
                    <textarea class="form-control" id="comment" name="comment">{{ old('comment') }}</textarea>
                    @error('comment')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row mb-4">
                <label for="img_path" class="col-3 col-form-label col-form-label-lg fw-semibold">
                    商品画像
                </label>
                <div class="col-8">
                    <input class="form-control" type="file" id="img_path" name="img_path">
                    @error('image')
                    <div class="text-danger small">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-warning btn-sm px-1 me-5 mt-5">新規登録</button>
                    <a href="{{ url('/products') }}" class="btn btn-info btn-sm px-3 mt-5">戻る</a>
                </div>
            </div>
        </form>
    </div>
</div

    @endsection