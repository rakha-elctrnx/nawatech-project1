<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Specification;
use App\Models\Type;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function index()
    {
        $data = Product::with(['brand' => function ($query) {
                    $query->select('id', 'brand_name');
                }])
                ->withCount('types')
                ->paginate(10);

        return Inertia::render('Admin/Product/Index', [
            'data' => $data
        ]);
    }

    public function create(): Response
    {
        $data = Brand::all();
        return Inertia::render('Admin/Product/Create', [
            'data'  => $data
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'brand_id' => 'required|integer',
            'product_name' => 'required|string',
        ]);

        Product::create($validatedData);

        return Redirect::route('admin.product')->with('success', 'Data added successfully');
    }

    public function edit($product_id): Response
    {
        $data = Product::with('brand', 'types.specs')->where('id', $product_id)->first();
        $brands = Brand::select('id', 'brand_name')->get();

        $data->types->each(function ($type) {
            $type->grouped_specs = $type->specs->groupBy('spec');
        });

        return Inertia::render('Admin/Product/Edit', [
            'data' => $data,
            'brands' => $brands
        ]);
    }

    public function update(Request $request, $product_id):RedirectResponse
    {
        $validatedData = $request->validate([
            'brand_id' => 'required|integer',
            'product_name' => 'required|string',
        ]);

        $product = Product::find($product_id);

        $product->update($validatedData);

        return Redirect::route('admin.product')->with('success', 'Data edited successfully');
    }

    public function storeType(Request $request, $product_id): RedirectResponse
    {
        $validatedData = $request->validate([
            'type_name' => 'required|string',
            'price'     => 'required|numeric',
            'image'     => 'required|image'
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image') , $imageName);

            $validatedData['image'] = $imageName;
        }

        $validatedData['product_id'] = $product_id;
        Type::create($validatedData);

        return Redirect::back()->with('success', 'Data added successfully');
    }

    public function updateType(Request $request, $type_id): RedirectResponse
    {
        $validatedData = $request->validate([
            'type_name' => 'required|string',
            'price'     => 'required|numeric',
            'image'     => 'nullable|image'
        ]);

        foreach ($request->spec as $value) {
            foreach ($value as $item) {
                $spec = Specification::find($item['id']);
                if ($item['name']) {
                    $spec->name = $item['name'];
                }
                if ($item['value']) {
                    $spec->value = $item['value'];
                }
                $spec->save();
            }
        }

        $type = Type::find($type_id);

        if($request->hasFile('image')){
            if(!empty($type->image)){
                $imagePath = public_path('image/'. $type->image);
                if(file_exists($imagePath)){
                    unlink($imagePath);
                }
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('image') , $imageName);

            $validatedData['image'] = $imageName;
        } else {
            $validatedData['image'] = $type->image;
        }

        $type->update($validatedData);

        return Redirect::route('admin.product')->with('success', 'Data edited successfully');
    }

    public function storeSpec(Request $request, $type_id): RedirectResponse
    {
        $validatedData = $request->validate([
            'name'      => 'required|string',
            'value'     => 'required|string',
        ]);

        $validatedData['type_id'] = $type_id;
        $validatedData['spec'] = $request->spec;

        Specification::create($validatedData);
        return Redirect::back()->with('success', 'Data added successfully');
    }

    public function deleteSpec($spec_id): RedirectResponse
    {
        $spec = Specification::find($spec_id);
        $spec->delete();
        return Redirect::back()->with('success', 'Data deleted successfully');
    }
}

