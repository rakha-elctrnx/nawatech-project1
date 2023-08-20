<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;

class AdminController extends Controller
{
    public function index()
    {
        return Inertia::render('Dashboard');
    }

    public function brand(): Response
    {
        $data = Brand::all();

        return Inertia::render('Admin/Brand', [
            'data' => $data
        ]);
    }

    public function addBrand(): Response
    {
        return Inertia::render('Admin/BrandAdd');
    }

    public function storeBrand(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string',
            'company_name' => 'required|string',
            'logo' => 'required|image|max:800',
        ]);

        if($request->hasFile('logo')){
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('logo') , $imageName);

            $validatedData['logo'] = $imageName;
        }

        Brand::create($validatedData);

        return Redirect::route('admin.brand')->with('success', 'Data added successfully');
    }

    public function editBrand($brand_id): Response
    {
        $data = Brand::find($brand_id);

        return Inertia::render('Admin/BrandEdit', [
            'data' => $data
        ]);
    }

    public function updateBrand(Request $request, $brand_id): RedirectResponse
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|string',
            'company_name' => 'required|string',
            'logo' => 'nullable|image|max:800',
        ]);

        $brand = Brand::find($brand_id);

        if($request->hasFile('logo')){
            if(!empty($brand->logo)){
                $imagePath = public_path('logo/'. $brand->logo);

                if(file_exists($imagePath)){
                    unlink($imagePath);
                }
            }
            
            $image = $request->file('logo');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('logo') , $imageName);

            $validatedData['logo'] = $imageName;
        } else {
            $validatedData['logo'] = $brand->logo;
        }

        $brand->update($validatedData);

        return Redirect::route('admin.brand')->with('success', 'Data has been edited');
    }

    public function deleteBrand($brand_id): RedirectResponse
    {
        $brand = Brand::find($brand_id);

        if(!empty($brand->logo)){
            $imagePath = public_path('logo/'. $brand->logo);
            if(file_exists($imagePath)){
                unlink($imagePath);
            }
        }

        $brand->delete();

        return Redirect::route('admin.brand')->with('success', 'Data deleted successfully');
    }
}
