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
        $products = Product::with(['company'])->get();
        return view('index', ['products' => $products]);
    }

    public function search(Request $request)
    {
        // キーワードとメーカー名を取得
        $keyword = $request->input('keyword');
        $companyName = $request->input('company_name');

        // クエリを組み立てて検索
        $query = Product::query();

        if ($keyword) {
            $query->where('product_name', 'like', '%' . $keyword . '%');
        }

        if ($companyName) {
            $query->whereHas('company', function ($query) use ($companyName) {
                $query->where('company_name', $companyName);
            });
        }

        // 検索結果を取得
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
        $product->img_url = $request->img_url;

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
    public function store(RegistRequest $request)
{
    // 画像を取得
    $image = $request->file('images');

    // 画像をストレージに保存し、そのパスを取得
    $img_path = $image->store('public/images');

    // 画像のURLを生成
    $img_url = asset('storage/' . $img_path);

    // Productモデルを作成し、データベースに保存
    Product::create([
        'img_path' => $img_path,
        'img_url' => $img_url,
    ]);

    // リダイレクトなどの適切なレスポンスを返す
    return redirect()->route('index');
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
        $product->img_url = $request->img_url;

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
