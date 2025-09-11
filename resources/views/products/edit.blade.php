@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">
  {{ session('success') }}
</div>
@endif

<div class="container mt-5 mb-5">
  <h4 class="mb-5" style="max-width: 550px; margin: 0 auto;">商品情報編集画面</h4>

  <div class="mx-auto p-4 border rounded" style="max-width: 550px; background-color: #fff;">
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
      @csrf
      @method('PUT')

      <div class="row mb-3">
        <label class="col-3 col-form-label col-form-label-lg fw-bold fst-italic">ID.</label>
        <div class="col-8 pt-2">
          {{ $product->id }}.
        </div>
      </div>

      <div class="row mb-3">
        <label for="product_name" class="col-3 col-form-label col-form-label-lg fw-bold">
          商品名 <span class="text-danger">*</span>
        </label>
        <div class="col-8">
          <input type="text" class="form-control" id="product_name" name="product_name"
            value="{{ old('product_name', $product->product_name) }}">
          @error('product_name')
          <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row mb-3">
        <label for="company_id" class="col-3 col-form-label col-form-label-lg fw-bold">
          メーカー名 <span class="text-danger">*</span>
        </label>
        <div class="col-8">
          <select id="company_id" class="form-control" name="company_id">
            <option value="">選択してください</option>
            @foreach($companies as $company)
            <option value="{{ $company->id }}" {{ old('company_id', $product->company_id) == $company->id ? 'selected' : '' }}>
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
        <label for="price" class="col-3 col-form-label col-form-label-lg fw-bold">
          価格 <span class="text-danger">*</span>
        </label>
        <div class="col-8">
          <input type="number" class="form-control" id="price" name="price"
            value="{{ old('price', $product->price) }}">
          @error('price')
          <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row mb-3">
        <label for="stock" class="col-3 col-form-label col-form-label-lg fw-bold">
          在庫数 <span class="text-danger">*</span>
        </label>
        <div class="col-8">
          <input type="number" class="form-control" id="stock" name="stock"
            value="{{ old('stock', $product->stock) }}">
          @error('stock')
          <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row mb-3">
        <label for="comment" class="col-3 col-form-label col-form-label-lg fw-bold">
          コメント
        </label>
        <div class="col-8">
          <textarea class="form-control" id="comment" name="comment">{{ old('comment', $product->comment) }}</textarea>
          @error('comment')
          <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row mb-4">
        <label for="image" class="col-3 col-form-label col-form-label-lg fw-bold">
          商品画像
        </label>
        <div class="col-8">
          <input class="form-control" type="file" id="img_path" name="img_path">
          @if($product->img_path)
          <div class="mt-2">
            <img src="{{ asset('storage/' . $product->img_path) }}" alt="商品画像" style="max-width: 50px; border: 1px solid #ccc;">
          </div>
          @endif
          @error('image')
          <div class="text-danger small">{{ $message }}</div>
          @enderror
        </div>
      </div>

      <div class="row mt-4">
        <div class="col-12">
          <button type="submit" class="btn btn-warning btn-sm px-3 me-3">更新</button>
          <a href="{{ route('products.show',$product->id) }}" class="btn btn-info btn-sm px-3">戻る</a>
        </div>
      </div>
    </form>
  </div>
</div>
@endsection