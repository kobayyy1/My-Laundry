<?php

namespace App\Http\Controllers\admin;

use App\Models\product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class productAdminController extends Controller
{
    public function data()
    {
        return view('admin.product.data');
    }

    public function create()
    {
        return view('admin.product.create');
    }
    
    public function createPost(Request $request)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required:max:255',
            'price' => 'required:number',
            'status' => 'required',
            'description' => 'required',
            'image' => 'required|file|max:12288|mimes:jpg,jpeg,png,sgv',
        ], [
            'title.required' => 'nama product tidak boleh kosong!',
            'price.required' => 'harga tidak boleh kosong!',
            'price.integer' => 'harga bukan number!',
            'status.required' => 'status tidak boleh kosong!',
            'description.required' => 'description tidak boleh kosong!',
            'image.required' => 'Image tidak boleh kosong!',
            'image.file' => 'File upload harus berupa file image',
            'image.mimes' => 'File upload format tidak sah!',
            'image.max' => 'File upload melebihi kapasitas!',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withInput()->withErrors($valid)->with('error', 'Sorry somthing wrong with data!');
        } else {
            try {
                // CHANGE_FILE_NAME
                $filename = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
                $image = 'IMG-' . date('YmdHis') . $filename . "." . $request->image->getClientOriginalExtension();
                $request->image->storeAs('/images/product', $image, 's4');

                // SAVE_PRODUCT
                $product = new product();
                $product->title = $request->title;
                $product->slug = Str::slug($request->title);
                $product->price = $request->price;
                $product->status = $request->status;
                $product->discount = $request->discount;
                $product->dateDiscountStart = $request->dateDiscountStart;
                $product->dateDiscountEnd = $request->dateDiscountEnd;
                $product->dateProduct = date('Y-m-d');
                $product->description = $request->description;
                $product->descriptionList = array_filter($request->descriptionOther);
                $product->price_other = $request->price - (($request->price * $request->discount) / 100);
                $product->image = $image;
                $product->save();

                return redirect()->back()->with('success', 'Your data saved!');
            } catch (\Throwable $th) {
                dd($th);
                return redirect()->back()->withInput()->with('error', 'Sorry something with save data!');
            }
        }
    }


    public function update($id)
    {
        $data = product::find($id);
        return view('admin.product.update', [
            'data' => $data
        ]);
    }

    public function detail($id)
    {
        $data = product::find($id);
        return view('admin.product.detail',[
            'data' => $data
        ]);
    }

    public function updatePost($id, Request $request)
    {
        $valid = Validator::make($request->all(), [
            'title' => 'required:max:255',
            'price' => 'required:number',
            'status' => 'required',
            'description' => 'required',
        ], [
            'title.required' => 'nama product tidak boleh kosong!',
            'price.required' => 'harga tidak boleh kosong!',
            'price.integer' => 'harga bukan number!',
            'status.required' => 'status tidak boleh kosong!',
            'description.required' => 'description tidak boleh kosong!',
        ]);

        if ($valid->fails()) {
            return redirect()->back()->withInput()->withErrors($valid)->with('error', 'Sorry somthing wrong with data!');
        } else {
            try {
                // SAVE_PRODUCT
                $product = product::find($id);
                $product->title = $request->title;
                $product->slug = Str::slug($request->title);
                $product->price = $request->price;
                $product->status = $request->status;
                $product->discount = $request->discount;
                $product->dateDiscountStart = $request->dateDiscountStart;
                $product->dateDiscountEnd = $request->dateDiscountEnd;
                $product->dateProduct = date('Y-m-d');
                $product->description = $request->description;
                $product->descriptionList = array_filter($request->descriptionOther);
                $product->price_other = $request->price - (($request->price * $request->discount) / 100);

                if ($request->hasFile('image')) {
                    $validImage = Validator::make($request->all(), [
                        'image' => 'required|file|max:12288|mimes:jpg,jpeg,png,sgv',
                    ], [
                        'image.required' => 'Image tidak boleh kosong!',
                        'image.file' => 'File upload harus berupa file image',
                        'image.mimes' => 'File upload format tidak sah!',
                        'image.max' => 'File upload melebihi kapasitas!',
                    ]);
                    if ($validImage->fails()) {
                        return redirect()->back()->withInput()->withErrors($valid)->with('error', 'Sorry somthing wrong with data!');
                    } else {
                        // CHANGE_FILE_NAME
                        $filename = pathinfo($request->image->getClientOriginalName(), PATHINFO_FILENAME);
                        $image = 'IMG-' . date('YmdHis') . $filename . "." . $request->image->getClientOriginalExtension();
                        $request->image->storeAs('/images/product', $image, 's4');
                        $product->image = $image;
                    }
                }

                $product->save();

                return redirect()->back()->with('success', 'Your data updated!');
            } catch (\Throwable $th) {
                dd($th);
                return redirect()->back()->withInput()->with('error', 'Sorry something with update data!');
            }
        }
    }
}
