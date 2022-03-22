<?php

namespace App\Http\Controllers\Pages;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Products = Product::paginate(6);
        return view('pages.products.index', compact('Products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $Categories = Category::all();
        return view('pages.products.create', compact('Categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // Validate the request...
        $request->validate([
            'name' => 'required|string|min:5|max:50|unique:products,name',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            // 'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            "description" => "required|string|min:5|max:150",
            'category_id' => 'required|integer',
        ]);



/*
        if ($request->hasFile('image')) {
            //Store the image extension in a variable
            $extension  = $request->image->getClientOriginalExtension();
            //Store the image name in a variable
            $ImageName = time() . "." . $extension;
            //Save the Image in products file
            $request->file('image')->move(public_path('images/product'), $ImageName);

            //Convert name to slug
            $slugName = Str::slug($request->name, '-');

            //insert data by model
            $product = new Product;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->qty = $request->qty;
            $product->image = $ImageName;
            $product->slug = $slugName;
            $product->description = $request->description;
            $product->category_id = $request->category_id;
            $product->save();
        }
*/

        //redirect with message
        return response()->json(['message' => 'Product Added Successfully']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $Product = Product::where('slug', $slug)->first();
        //return view with variable Product
        return view('pages.products.show', compact('Product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get items by id
        $Product = Product::where('id', $id)->first();

        $Categories = Category::all();

        //return view with variable Product
        return view('pages.products.edit', compact('Product', 'Categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validate the request...
        $request->validate([
            'name' => 'required|string|min:5|max:50',
            'price' => 'required|numeric',
            'qty' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10000',
            "description" => "required|string|min:5|max:150",
            'category_id' => 'required|integer',
        ]);

        //get item image by id
        $Product = Product::where('id', $id)->first();

        //Convert name to slug
        $slugName = Str::slug($request->name, '-');

        if ($request->has('image')) {

            //Storing the image path in a variable imagePath
            $imagePath = public_path('images/product/' . $Product->image);
            //Delete old photos from the file
            if (File::exists($imagePath)) {
                unlink($imagePath);
            }

            //Save the New image extension in a variable
            $extension  = $request->image->getClientOriginalExtension();
            //Save the New image name in a variable
            $NewImageName = time() . "." . $extension;
            //Store the New Image in products file
            $request->file('image')->move(public_path('images/product'), $NewImageName);

            //Update data
            $Product->name = $request->name;
            $Product->price = $request->price;
            $Product->qty = $request->qty;
            $Product->image = $NewImageName;
            $Product->slug = $slugName;
            $Product->description = $request->description;
            $Product->category_id = $request->category_id;
            $Product->save();
        } else {
            //Update data
            $Product->name = $request->name;
            $Product->price = $request->price;
            $Product->qty = $request->qty;
            $Product->image = $Product->image;
            $Product->slug = $slugName;
            $Product->description = $request->description;
            $Product->category_id = $request->category_id;
            $Product->save();
        }
        //redirect with message
        return redirect()->back()->with('message', 'Product Update Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //laravel eloquent remove from db
        Product::where('id', $id)->delete();

        //redirect with message
        return response()->json(['message' => 'Product update successfully']);
    }
}
