<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Models\ProductSeason;
use App\Models\Season;
use App\Http\Requests\StoreProductRequest;

class ProductController extends Controller
{
    // 商品一覧ページ表示
    public function index()
    {
        $p = '';
        $products = Product::select('id', 'name', 'price', 'image')->paginate(6);

        return view('index', compact('products', 'p'));
    }

    // 商品検索
    public function search(Request $request)
    {
        $products = Product::query();
        $p = $request->input('p');

        if ($p !== null) {
            $products->where('products.name', 'LIKE BINARY', '%' . $p . '%');
        }
        $products = $products->SortOrder($request->sort_order)->paginate(6);

        return view('index', compact('products', 'p'));
    }

    // 商品登録ページ表示
    public function create()
    {
        $seasons = Season::select('id', 'name')->get();

        return view('create', compact('seasons'));
    }

    // 商品登録
    public function store(StoreProductRequest $request)
    {
        $file_name = $request->file('image')->getClientOriginalName();
        $request->file('image')->storeAs('public/sample', $file_name);

        $product = product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => asset("storage/sample/{$file_name}"),
            'description' => $request->description,
        ]);

        foreach ($request->seasons as $season) {
            ProductSeason::create([
                'product_id' => $product->id,
                'season_id' => $season,
            ]);
        }

        return redirect('/products');
    }

    // 商品詳細ページ表示
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::select('id', 'name')->get();

        return view('detail', compact('product', 'seasons'));
    }

    // 商品更新
    public function update(UpdateProductRequest $request, $id)
    {
        $item = Product::find($id);

        if ($request->image == null) {
            $item->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
            ]);
        } else {
            $file_name = $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public/sample', $file_name);
            $item->update([
                'name' => $request->name,
                'price' => $request->price,
                'image' => asset("storage/sample/{$file_name}"),
                'description' => $request->description,
            ]);
        }

        $item->productSeason()->delete();

        foreach ($request->seasons as $season) {
            ProductSeason::create([
                'product_id' => $item->id,
                'season_id' => $season,
            ]);
        }

        if ($item) {
            return redirect('/products');
        } else {
            return redirect('/products/update');
        }
    }

    // 店舗情報削除
    public function delete($id)
    {
        $item = Product::where('id', $id)->delete();
        if ($item) {
            return redirect('/products');
        } else {
            return redirect('/products/delete');
        }
    }
}


