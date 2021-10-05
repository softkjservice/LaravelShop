<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

use App\Http\Requests\UpsertProductRequest;
use App\Http\Requests\UpsertCategoryRequest;
use App\Models\Product;

use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\JsonResponse;

class ProductCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        return view("categories.index", [
            'productCategories' => ProductCategory::paginate(5)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view("categories.create", [
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UpsertProductRequest  $request
     * @return RedirectResponse
     */
    public function store(UpsertCategoryRequest $request): RedirectResponse
    {
        $productCategory = new ProductCategory($request->validated());

        $productCategory->save();
        return redirect(route('categories.index'))->with('status', __('shop.product.status.stored'));
    }

    /**
     * Display the specified resource.
     *
     * @param  Product  $product
     * @return View
     */
    public function show(Product $product): View
    {
        return view("products.show", [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Product  $product
     * @return View
     */
    public function edit(Product $product): View
    {
        return view("products.edit", [
            'product' => $product,
            'categories' => ProductCategory::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpsertProductRequest  $request
     * @param  Product  $product
     * @return RedirectResponse
     */
    public function update(UpsertProductRequest $request, Product $product): RedirectResponse
    {
        $product->fill($request->validated());
        if ($request->hasFile('image')) {
            $product->image_path = $request->file('image')->store('products');
        }
        $product->save();
        return redirect(route('products.index'))->with('status', __('shop.product.status.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Product  $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            $product->delete();
            Session::flash('status',__('shop.product.status.deleted') );
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd!'
            ])->setStatusCode(500);
        }
    }
}
