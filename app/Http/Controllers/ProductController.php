<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index(){
        $currentUser = Auth::user();
        $companyCurrentUser = $currentUser->company;
        $companyId = $companyCurrentUser->id;
        $productData= new Collection;
        $totalitems = 0;
        $totalstockvalue = 0;
        if (!$currentUser) {
            return redirect()->route('login');
        }

        $filteredProducts = Product::with(['companies' => function ($query) use ($companyId) {
            $query->where('company_id', $companyId);
        }])->get();

        foreach ($filteredProducts as $product) {

            if(!empty($product->companies->first()->id)){
                $company=$product->companies->first();
                $price=$company->pivot->price;
                $category=$product->category;
                $stock=$company->pivot->stock;
                $productData->push([
                    'company_id' => $company->id,
                    'product_id'=> $product->id,
                    'product_name'=> $product->product_name,
                    'price'=>$price,
                    'category'=>$category,
                    'stock'=>$stock,
                    'stock_value'=> $stock * $price
                ]);
                $totalitems+=$stock;
                $totalstockvalue+=($stock*$price);
            }

        }

        return view("product", compact('productData' , 'totalitems', 'totalstockvalue'));
    }

    public function store(Request $request){
        $currentUser = Auth::user();
        $company=$currentUser->company;
        $product=Product::create([
            'product_name'=> $request->input('product_name'),
            'category' => $request->input('category')
        ]);
        $product->companies()->attach($company->id, ['stock'=> $request->input('stock'), 'price'=> $request->input('price')]);
        return redirect()->route('product');
    }

    public function update(Request $request){
        $currentUser = Auth::user();
        $company = $currentUser->company;
        $product = Product::find($request->input('product_id'));

        $product->companies()->updateExistingPivot($company->id, ['stock'=> $request->input('stock'), 'price'=> $request->input('price')]);
        return redirect()->route('product');
    }

    public function destroy(Request $request){
        $product = Product::find($request->input('product_id'));
        $currentUser = Auth::user();

        $product->transactions()->wherePivot('company_id', $currentUser->company_id)->detach();

        $currentUser->company->products()->detach($product);


        return redirect()->route('product');
    }
}
