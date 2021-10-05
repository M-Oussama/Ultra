<?php

namespace App\Http\Controllers;

use App\Models\AccountType;
use App\Models\product;
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
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'barcode' => 'required',
            'price' => 'required',
            'quantity' => 'required',

        ]);

        if ($validator->fails()) {
            session()->flash('type', "error");
            session()->flash('message', "Please verify your form");
            return redirect('dash/products/create')
                ->withErrors($validator)
                ->withInput();
        }


        $product = new product();
        $product->name = $request->name;
        $product->barcode = $request->barcode;
        $product->price = $request->price;
        $product->quantity = $request->quantity;
        $product->type_id = $request->type;
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
            $product->type_id = $request->type;
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
//
//    /**
//     * Remove the specified resource from storage.
//     *
//     * @param  \App\Models\User  $user
//     */
//    public function destroy(User $user)
//    {
//        $user->delete();
//        session()->flash('type', 'success');
//        session()->flash('message', 'User deleted successfully.');
//        return redirect()->back();
//    }
//
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
