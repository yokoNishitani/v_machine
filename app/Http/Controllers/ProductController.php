<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Http\Requests\RegistRequest;
use Illuminate\Support\Facades\DB;
use RecursiveIterator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['company'])->get();
        return view('index', ['products' => $products]);
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword');
        $companyName = $request->input('company_name');

        $query = Product::query();

        if ($keyword) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }

        if ($companyName) {
            $query->whereHas('company', function ($query) use ($companyName) {
                $query->where('company_name', $companyName);
            });
        }

        $products = $query->get();

        return view('index', ['products' => $products]);
    }

    public function getId($id)
    {
        $model = new Product();
        $product = $model::find($id);
        return view('product_info_detail', compact('product'));
    }

    public function add(Request $request)
    {
        $products = Product::with(['company'])->get();
        $companies = Company::all();
        return view('product_regist', compact('products', 'companies'));
    }

    public function store(RegistRequest $request)
    {
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
        return redirect(route('add'));
    }

    public function show($id)
    {
        $model = new Product();
        $product = $model::find($id);
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    public function update(RegistRequest $request, $id)
    {
        // 更新対象の商品を取得
        $product = Product::find($id);

        // 商品情報を更新
        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->img_path = $request->img_path;

        // メーカーの情報を取得または作成して関連付ける
        $company = Company::firstOrCreate(['company_name' => $request->company_name]);
        $product->company()->associate($company);

        // 商品を保存
        $product->save();

        // 更新後の商品詳細ページにリダイレクト
        return redirect()->route('products.details', $product->id);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('index');
    }
}
