<?php

namespace App\Http\Controllers;

use App\Models\WishList;
use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class WishListController extends Controller
{

    /**
     *  Obtencion de todos las listas de deseos.
     */
    public function index(Request $request)
    {

        $useridFK = $request->get('userIdFK');
        $wishlist = WishList::join('products', 'products.id', '=', 'wish_lists.productIdFK')
            ->join('users', 'users.id', '=', 'wish_lists.userIdFK')
            ->where('wish_lists.userIdFK', $useridFK)
            ->where('products.isAvailable', '=', 1)
            ->where('products.isBanned', '=', 0 )
            ->select(
                'products.id',
                'products.name',
                'products.price',
                'products.photos',
                'users.id as userIdFK',
                'users.firstName as userFirstName',
                'users.lastName as userLastName'

            )->get();

        if($wishlist->isEmpty()){
            return response()->json(['message' => 'No hay productos en la Wishlist'], 500);
        }else{
            return response()->json($wishlist, 200);
        }
    }


    /**
     * guardar un producto en la lista a la vez.
     */
    public function store(Request $request)
    {
        $request->merge(['addedDate' => date('Y-m-d')]);
        $values =  $request->all();
        WishList::insert($values);

        return response()->json(['success' => true], 200);
    }



    /**
     * eliminar un producto de la lista.
     */
    public function delete(Request $request)
    {
        $userIdFK = $request->only('userIdFK');
        $productIdFK = $request->only('productIdFK');

        $wishListObject = WishList::where('userIdFK', '=', $userIdFK)->where('productIdFK', '=', $productIdFK)->first();

        if(!$wishListObject){
            return response()->json(['message' => 'No se procesó la operación.'], 500);
        }else{
            $wishListObject->delete();
            return response()->json(['message' => 'Se eliminó de la Lista de Deseos.'], 200);
        }
    }


    /******************************************************************/
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }




    /**
     * Display the specified resource.
     */
    public function show(WishList $wishList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(WishList $wishList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, WishList $wishList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(WishList $wishList)
    {
        //
    }
}
