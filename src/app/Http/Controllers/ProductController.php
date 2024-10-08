<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\ProductSeason;
use App\Models\Season;

class ProductController extends Controller
{
    // 商品一覧ページ表示
    public function index()
    {
        $p = '';
        $products = Product::select('id', 'name', 'price', 'image')
            ->paginate(6);

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

        $products = $products->get();

        return view('index', compact('products', 'p'));
    }

    // 商品登録ページ表示
    public function create()
    {
        $seasons = Season::select('id', 'name')->get();

        return view('create', compact('seasons'));
    }

    // 商品登録
    public function store(ProductRequest $request)
    {
        $product = product::create([
            'name' => $request->name,
            'price' => $request->price,
            'image' => $request->image,
            'description' => $request->description,
        ]);

        return redirect('index');
    }

    // 商品詳細ページ表示
    public function detail($id)
    {
        $product = Product::findOrFail($id);
        $seasons = Season::select('id', 'name')->get();

        return view('detail', compact('product', 'seasons'));
    }

    // 商品更新
    public function update(ProductRequest $request, $id)
    {
        $file_name = $request->file('image')->getClientOriginalName();
        // 取得したファイル名で保存
        // storage/app/public/任意のディレクトリ名/
        $request->file('image')->storeAs('public/sample', $file_name);

        $form = $request->all();

        $item = Product::find($id)->update([
            'name' => $request->name,
            'price' => $request->price,
            'image' => asset("storage/sample/{$file_name}"),
            'description' => $request->description,
        ]);

        if ($item) {
            return redirect('/products');
        } else {
            return redirect('/products/update');
        }
    }

    // 店舗情報削除
    public function delete($id)
    {
        var_dump('hi');

        $item = Product::where('id', $id)->delete();
        if ($item) {
            return redirect('/products');
        } else {
            return redirect('/products/delete');
        }
    }











    // $product = Product::findOrFail($id);

    // $imageFile = $request->image;
    // if (!is_null($imageFile) && $imageFile->isValid()) {
    //     $fileName = uniqid(rand() . '_') . '.' . $imageFile->extension();
    //     $dirName = 'images/product/';
    //     $fileNameToStore = $dirName . $fileName;
    //     Storage::putFileAs('public/' . $dirName, $imageFile, $fileName);
    // }

    // try {
    //     DB::transaction(function () use ($request, $product, $fileNameToStore) {
    //         $product->name = $request->name;
    //         $product->price = $request->price;
    //         $product->image = $fileNameToStore;
    //         $product->description = $request->description;
    //         $product->save();

    //         ProductSeason::where('product_id', $product->id)->delete();

    //         foreach ($request->seasons as $season) {
    //             ProductSeason::create([
    //                 'product_id' => $product->id,
    //                 'season_id' => $season,
    //             ]);
    //         }
    //     }, 2);
    // } catch (Throwable $e) {
    //     Log::error($e);
    //     throw $e;
    // }

    // return redirect()->route('products.index');
}

        // 商品削除
        // public function destroy($id)
        // {
        //     Product::findOrFail($id)->delete();

        //     return redirect()->route('products.index');
        // }












// use App\Models\Product;
// use Illuminate\Http\Request;

// class ProductController extends Controller
// {
//     public function index(Request $request)
//     {
//         $products = Product::get();
// var_dump($products);
    //     return view('index', compact('products'));
    // }

    // 店舗詳細表示
//     public function detail(Request $request, $shop_id)
//     {
//         $shop = Shop::find($shop_id);
//         $tomorrow = now()->addDay()->format('Y-m-d');
//         if ($request->has('date')) {
//             $reserve_date = $request->date;
//         } else {
//             $reserve_date = session()->has('date') ? session('date') : $tomorrow;
//         }
//         session(['date' => $reserve_date]);

//         $time_array = [];
//         $num_array = [];
//         $my_review = null;
//         if (Auth::check()) {
//             $tmp_review = Review::select()->UserSearch(Auth::id())->ShopSearch($shop_id)->get();
//             $my_review = $tmp_review->isEmpty() ? null : $tmp_review->toArray()[0];
//         }
//         return view('shop_detail', compact('shop', 'tomorrow', 'reserve_date', 'time_array', 'num_array', 'my_review'));
//     }
// }

    // 管理者・店舗代表者変更フォーム表示
    // public function edit(Request $request)
    // {
    //     return view('index');
    // }

    // 管理者・店舗代表者変更
    // public function update(Request $request)
    // {
    //     return view('index');
    // }

    // 管理者・店舗代表者削除
    // public function delete(Request $request)
    // {
    //     return view('index');
    // }
