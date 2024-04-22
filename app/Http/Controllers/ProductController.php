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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with(['company'])->paginate(10);
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


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(RegistRequest $request)
    {
        $product = new Product();

        $product->product_name = $request->product_name;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->comment = $request->comment;
        $product->img_path = $request->img_path;

        $company = Company::where('company_name', $request->company_name)->first();

        $product->company_id = $company->id;

        $product->save();

        return redirect(route('create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = new Product();
        $product = $model::find($id);
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $companies = Company::all();
        return view('edit', compact('product', 'companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();
        return redirect('index');
    }
}
