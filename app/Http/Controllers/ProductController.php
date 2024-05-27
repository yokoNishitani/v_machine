<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\RegistRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use RecursiveIterator;

class ProductController extends Controller
{
    // 一覧画面
    public function index() {
        $products = Product::with('company')->whereNull('deleted_at')->get();
        return view('index', compact('products'));
    }

    // 検索
    public function search(Request $request) {
        $keyword = $request->input('keyword');
        $companyName = $request->input('company_name');
        $priceMin = $request->input('price_min'); // 価格の下限を取得
        $priceMax = $request->input('price_max'); // 価格の上限を取得
        $stockMin = $request->input('stock_min'); // 在庫数の下限を取得
        $stockMax = $request->input('stock_max'); // 在庫数の上限を取得
    
        $query = Product::query();
    
        if ($keyword) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }
    
        if ($companyName) {
            $query->whereHas('company', function ($query) use ($companyName) {
                $query->where('company_name', $companyName);
            });
        }
    
        if ($priceMin) {
            $query->where('price', '>=', $priceMin);
        }
    
        if ($priceMax) {
            $query->where('price', '<=', $priceMax);
        }
    
        if ($stockMin) {
            $query->where('stock', '>=', $stockMin);
        }
    
        if ($stockMax) {
            $query->where('stock', '<=', $stockMax);
        }
    
        $products = $query->with('company')->get();
    
        return response()->json(['products' => $products]);
    }
    

    // 詳細画面
    public function getId($id) {
        $model = new Product();
        $product = $model::find($id);
        return view('detail', compact('product'));
    }

    // 新規登録画面
    public function add(Request $request) {
        $products = Product::with(['company'])->get();
        $companies = Company::all();
        return view('product_regist', compact('products', 'companies'));
    }

    // 新規登録
    public function store(RegistRequest $request) {
        DB::beginTransaction();
        try {
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $image_path = 'storage/images/' . $file_name;
            } else {
                $image_path = null;
            }

            $product = new Product();
            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->img_path = $image_path;

            $company = Company::where('company_name', $request->company_name)->first();
            $product->company()->associate($company);

            $product->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }

        return redirect(route('products.add'));
    }

    // 編集画面（商品情報の取得）
    public function show($id) {
        $model = new Product();
        $product = $model::find($id);
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    // 編集画面（表示）
    public function edit($id) {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    // 更新
    public function update(RegistRequest $request, $id) {
        DB::beginTransaction();
        try {
            // 更新対象の製品を検索
            $product = Product::find($id);

            // 画像の処理
            if ($request->hasFile('images')) {
                $image = $request->file('images');
                $file_name = $image->getClientOriginalName();
                $image->storeAs('public/images', $file_name);
                $image_path = 'storage/images/' . $file_name;

                // 古い画像を削除
                if ($product->img_path) {
                    Storage::delete($product->img_path);
                }
            } else {
                // 画像がアップロードされなかった場合は、既存の画像を使用する
                $image_path = $product->img_path;
            }

            $product->product_name = $request->product_name;
            $product->price = $request->price;
            $product->stock = $request->stock;
            $product->comment = $request->comment;
            $product->img_path = $image_path;

            $company = Company::where('company_name', $request->company_name)->first();
            $product->company()->associate($company);

            $product->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return back();
        }

        return redirect()->route('products.details', $product->id);
    }

    // 削除
    public function destroy($id) {
        try {
            $product = Product::findOrFail($id);
            $product->delete();
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
