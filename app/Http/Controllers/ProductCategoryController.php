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
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UpsertCategoryRequest  $request
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
     * @param  int  $id
     * @return View
     */
    public function show($id): View
    {
        $productCategory=ProductCategory::find($id);
        return view("categories.show", [
            'productCategory' => $productCategory
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return View
     */
    public function edit($id): View
    {
        $productCategory=ProductCategory::find($id);
        return view("categories.edit", [
            'productCategory' => $productCategory,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UpsertCategoryRequest  $request
     * @param  int  $id
     * @return RedirectResponse
     */
    public function update(UpsertCategoryRequest $request, $id): RedirectResponse
    {
        $productCategory=ProductCategory::find($id);
        $productCategory->fill($request->validated());

        $productCategory->save();
        return redirect(route('categories.index'))->with('status', __('shop.product.status.updated'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id): JsonResponse
    {
        $productCategory=ProductCategory::find($id);
        /*dump($id);*/
        try {
            $productCategory->delete();
            Session::flash('status',__('shop.product.status.deleted') );
            return response()->json([
                'status' => 'success'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Wystąpił błąd! '
            ])->setStatusCode(500);
        }
    }
}
