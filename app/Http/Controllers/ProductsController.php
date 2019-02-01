<?php
/**
 * @SWG\Swagger(
 *   basePath="/api",
 *   @SWG\Info(
 *     title="Products info API",
 *     version="1.0.0"
 *   ),
 *   @SWG\Definition(
 *     definition="Product",
 *     required={"title", "price", "stock"},
 *     @SWG\Property(property="title", type="string", description="Product Title"),
 *     @SWG\Property(property="price", type="double", description="Product Price"),
 *     @SWG\Property(property="stock", type="double", description="Product Stock"),
 *     @SWG\Property(property="abstract", type="text"),
 *     @SWG\Property(property="description", type="text"),
 *     @SWG\Property(property="image_url", type="text"),
 *     @SWG\Property(property="created_at", type="datetime"),
 *     @SWG\Property(property="updated_at", type="datetime"),
 *  )
 * )
 */
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Products;
use App\Http\Resources\Products as ProductsResource;
use App\Http\Resources\ProductsCollection as ProductsCollection;
use App\Http\Requests\ProductsRequest;

class ProductsController extends Controller
{
    /**
     * @SWG\Get(
     *   path="/products",
     *   summary="List all products",
     *   operationId="index",
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="Bad Request"),
     *   @SWG\Response(response=422, description="Unsupported content type. Supports only application/json or Unprocessable Entity"),
     *   @SWG\Response(response=500, description="Whoops, looks like something went wrong")
     * )
     */
    /**
     * to obtain all products
     * @return json
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            return new ProductsCollection(Products::all());
        }
        
        return response()->json([
            'message' => 'Unsupported content type. Supports only application/json',
            'status' => 422
        ], 422);
    }
    
    /**
     * @SWG\Get(
     *   path="/products/{id}",
     *   summary="List product by id",
     *   operationId="show",
     *   @SWG\Parameter(
     *     name="id",
     *     in="path",
     *     description="Targeted product id.",
     *     required=true,
     *     type="string"
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="Bad Request"),
     *   @SWG\Response(response=422, description="Unsupported content type. Supports only application/json or Unprocessable Entity"),
     *   @SWG\Response(response=500, description="Whoops, looks like something went wrong")
     * )
     */
    /**
     * to obtain single product
     * 
     * @param string $id
     * @return json
     */
    public function show(Request $request, $id)
    {
        if ($request->wantsJson()) {
            $products = Products::findOrfail($id);
            return new ProductsResource($products);
        }
        
        return response()->json([
            'message' => 'Unsupported content type. Supports only application/json',
            'status' => 422
        ], 422);
    }
    
    /**
     * @SWG\Post(
     *   path="/products",
     *   summary="Save product",
     *   operationId="store",
     *   @SWG\Parameter(
     *     name="product",
     *     required=true,
     *     in="body",
     *     @SWG\Schema(ref="#/definitions/Product"),
     *   ),
     *   @SWG\Response(response=200, description="successful operation"),
     *   @SWG\Response(response=404, description="Bad Request"),
     *   @SWG\Response(response=422, description="Unsupported content type. Supports only application/json or Unprocessable Entity"),
     *   @SWG\Response(response=500, description="Whoops, looks like something went wrong")
     * )
     */
    /**
     * Save single product
     * 
     * @param Request $request
     * @return json 
     */
    public function store(ProductsRequest $request)
    {
         if ($request->wantsJson()) {
            $validated = $request->validated();
            $products = new Products;
            $products->title = $request->input('title');
            $products->price = $request->input('price');
            $products->stock =  $request->input('stock');
            $products->abstract = $request->input('abstract');
            $products->description = $request->input('description');
            $products->image_url = $request->input('image_url');
            $products->created_at = empty($request->input('created_at'))?date('Y-m-d H:i:s'):$request->input('created_at');
            $products->updated_at = empty($request->input('updated_at'))?date('Y-m-d H:i:s'):$request->input('updated_at');
            $products->save();
            
            return response()->json([
                'message' => 'Product inserted successfully.',
                'product_id' => $products->id,
                'status' => 200
            ], 200);
         }
        
        return response()->json([
            'message' => 'Unsupported content type. Supports only application/json',
            'status' => 422
        ], 422);
    }
}
