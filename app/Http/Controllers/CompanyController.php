<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use App\Models\Product;
use App\Models\Sale;
use App\Http\Requests\CompanyRequest;
use Illuminate\Support\Facades\DB;



class CompanyController extends Controller
{

    public function ProductInfoList()
    {
        $sales = Sale::with(['product','company'])->get();
        return view('product_info_list', ['sales' => $sales]);
    }

    public function ProductInfoDetail($id)
    {
        $model = new Sale();
        $sale = $model::find($id);
        return view('product_info_detail', compact('sale'));
    }

    public function ProductInfoEditor()
    {
        $model = new Company();
        $companies = $model->getCompanyList();
        return view('product_info_editor', ['companies' => $companies]);
    }



    public function ProductRegister()
    {
        $model = new Company();
        $companies = $model->getCompanyList();
        return view('product_register', ['companies' => $companies]);
    }




    public function RegistSubmit(CompanyRequest $request)
    {

        // トランザクション開始
        DB::beginTransaction();

        try {
            // 登録処理呼び出し
            $model = new Company();
            $model->registCompany($request);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return back();
        }

        // 処理が完了したらregistにリダイレクト
        return redirect(route('product_register'));
    }
}
