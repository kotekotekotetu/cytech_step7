<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\Company;
use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $query = Product::with('company');

        if ($request->filled('keyword')) {
            $query->where('product_name', 'like', '%' . $request->keyword . '%');
        }

        if ($request->filled('company_id')) {
            $query->where('company_id', $request->company_id);
        }

        $products = $query->paginate(10);
        $companies = Company::all();

        return view('products.index', compact('products', 'companies'));
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::all();
        return view('products.create', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $path = null;
                if ($request->hasFile('img_path')) {
                    // storage/app/public/products に保存
                    $path = $request->file('img_path')->store('products', 'public');
                }

                Product::create([
                    'product_name' => $request->product_name,
                    'company_id'   => $request->company_id,
                    'price'        => $request->price,
                    'stock'        => $request->stock,
                    'comment'      => $request->comment,
                    'img_path'     => $path,
                ]);
            });
        } catch (\Exception $e) {
            return back()->with('error', '登録に失敗しました');
        }

        return redirect()->route('products.create')->with('success', '商品を登録しました。');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('company')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('products.edit', compact('product', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $product = Product::findOrFail($id);

        try {
            DB::transaction(function () use ($request, $product) {
                $product->product_name = $request->product_name;
                $product->company_id   = $request->company_id;
                $product->price        = $request->price;
                $product->stock        = $request->stock;
                $product->comment      = $request->comment;

                // 新しい画像がアップロードされた場合
                if ($request->hasFile('img_path')) {
                    // 古い画像を削除
                    if ($product->img_path) {
                        Storage::disk('public')->delete($product->img_path);
                    }
                    // 新しい画像を保存
                    $product->img_path = $request->file('img_path')->store('products', 'public');
                }

                // DBに保存
                $product->save();
            });
        } catch (\Exception $e) {
            return back()->with('error', '更新に失敗しました');
        }

        return redirect()->route('products.edit', $id)->with('success', '商品情報を更新しました');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $product = Product::findOrFail($id);

                if ($product->img_path && Storage::disk('public')->exists($product->img_path)) {
                    Storage::disk('public')->delete($product->img_path);
                }

                $product->delete();
            });
        } catch (\Exception $e) {
            return back()->with('error', '削除に失敗しました');
        }

        return redirect()->route('products.index')->with('success', '商品を削除しました');
    }
}
