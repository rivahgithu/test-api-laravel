<?php

namespace App\Http\Controllers;

use App\Models\Produit;
use Illuminate\Http\Request;

class ProduitController extends Controller
{
    public function save(Request $request){
        $donne = $request->validate([
            "product_name" => "required",
            "product_price" => "required",
            "category_id" => "required",
        ]);

        $insert = Produit::create([
           "product_name" => $donne["product_name"],
           "product_price" => $donne["product_price"],
           "category_id" => $donne["category_id"],
        ]);

        return response([
            "code" => 200,
            "message" => " succes code",
            "description" => "nouveau produit inseré avec succès",
            "data" => $insert,
        ]);
    }

    public function listproduit(){
      $list = Produit::all();

       return response([
            "code" => 200,
            "message" => " succes",
            "data" => $list,
        ]);
    }

    public function deleteproduct($id){
       // Chercher le produit dans le base de donnée 
       $produit = Produit::find($id);
    //    var_dump($produit);
       if ($produit){
        // code pour supprimer le produit
          $produit->delete();
        return response([
            "code" => 200,
            "message" => "succes code",
            "description" => "le produit a été suprimé avec succès !",
        ], 200);
       }else{
        // renvoie un produit d'erreur
        return response([
            "code" => 400,
            "message" => "error code",
            "description" => "le id passé en parmettre n'existe pas !",
        ]);
       }
    }

    public function update(Request $request, $id) {

        $stars = $request->validate([
            "product_name" => "required",
            "product_price" => "required",
            "category_id" => "required",
        ]);

         if(empty($stars['product_name']) || empty($stars['product_price'])) {
            return response([
            "code" => 200,
            "message" => "failure code",
            "description" => "Les paramèttre sont vides !",
            "data" => null,
        ], 200);
         }

        // Chercher le produit dans le base de donnée 
       $produit = Produit::find($id);
       if ($produit){
        // code pour mettre à ajour le produit
         $produitmaj = $produit->update([
            "product_name" => $request->product_name,
            "product_price" => $request->product_price,
            "category_id" => $request->category_id,
         ]);
        return response([
            "code" => 200,
            "message" => "succes code",
            "description" => "le produit a été modifié avec succès !",
            "data" => $produitmaj,
        ], 200);

       }else{
        // renvoie un produit d'erreur
        return response([
            "code" => 400,
            "message" => "error code",
            "description" => "le id passé en parmettre n'existe pas !",
        ]);
       }
    }
}
