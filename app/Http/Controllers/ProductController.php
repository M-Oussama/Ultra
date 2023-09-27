<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\product;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $products = product::all();

        return view('dashboard.products.index')->with('products',$products);
    }

    public function create()
    {
        $types = AccountType::all();
        return view('dashboard.products.create')->with('types',$types);
    }

    public function store(Request $request)
    {

        $product = new product();
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->stackable = $request->stackable == "on" ? true : false;
        $product->type_id = 1;
        $product->save();

        $stock = new Stock();
        $stock->product_id = $product->id;
        $stock->quantity = $request->quantity;
        $stock->save();

        $product->stock_id = $stock->id;
        $product->save();

        if (!empty($request->avatar)) {
            $product->addMediaFromRequest('avatar')
                ->toMediaCollection('avatars');
        }

        session()->flash('type', 'success');
        session()->flash('message', 'Product created successfully.');

        return redirect('dash/products');
    }
//
//    /**
//     * Display the specified resource.
//     *
//     * @param  \App\Models\User  $user
//     * @return \Illuminate\Http\Response
//     */
//    public function show(User $user)
//    {
//        //
//    }
//
    public function edit(product $product)
    {
        $types = AccountType::all();
        return view('dashboard.products.edit')
            ->with('product',$product)->with('types',$types);

    }

    public function update(Request $request, product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'barcode' => 'required',
            'price' => 'required',
            'quantity' => 'required',

        ]);

        if ($validator->fails()) {
            session()->flash('type', "error");
            session()->flash('message', "Please verify your form");
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $products = product::where('barcode', $request->input('barcode'))->get();

        if (count($products) > 0 && $product->barcode != $request->barcode) {
            session()->flash('type', "warning");
            session()->flash('message', "A product with the same barcode already exists");

            return redirect('dash/products');
        } else {

            $product->name = $request->name;
            $product->barcode = $request->barcode;
            $product->price = $request->price;
            $product->quantity = $request->quantity;
            $product->stackable = $request->stackable == "on" ? true : false;
            $product->type_id = 1;
            $product->save();

            if (!empty($request->avatar)) {
                if (!empty($product->getFirstMedia('avatars'))) {
                    $product->getFirstMedia('avatars')->delete();
                }
                $product->addMediaFromRequest('avatar')
                    ->toMediaCollection('avatars');
            }

            if (!empty($request->avatar_remove)){
                $product->getFirstMedia('avatars')->delete();
            }

            session()->flash('type', 'success');
            session()->flash('message', 'Product updated successfully.');

            return redirect('dash/products');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  product  $product
     */
    public function destroy(product $product)
    {
            // Check if the product is referenced in any other tables.
        if ($product->sells()->count() > 0) {
            // Handle the case where the product is still referenced in the sells table.
            session()->flash('type', 'error');
            session()->flash('message', 'Cannot delete. Product is referenced in sales.');
            return redirect()->back();
        }

        if ($product->stock()->count() > 0) {
            $stock = Stock::where('product_id',$product->id)->get()->first();
            $stock->delete();

        }

        if ($product->commandProduct()->count() > 0) {
            // Handle the case where the product is still referenced in the sells table.
            session()->flash('type', 'error');
            session()->flash('message', 'Cannot delete. Product is referenced in commands.');
            return redirect()->back();
        }

        $product->delete();
        session()->flash('type', 'success');
        session()->flash('message', 'Product deleted successfully.');
        return redirect()->back();
    }

//    public function deleteMulti(Request $request){
//        $ids = $request->input('ids');
//        foreach ($ids as $id){
//            User::find($id)->delete();
//        }
//        session()->flash('type', 'success');
//        session()->flash('message', 'Users deleted successfully.');
//        return redirect()->back();
//    }
//
//    public function export()
//    {
//        return Excel::download(new UsersExport, 'users-'.Carbon::now()->toDateString().'.xlsx');
//    }
//
//    public function generatePdf(User $user){
//        $data = [
//            'user' => $user,
//        ];
//        $pdf = PDF::loadView('dashboard.people.users.pdf.pdf', $data);
//        return $pdf->download($user->name.' '.$user->surname.' file.pdf');
//    }
}
