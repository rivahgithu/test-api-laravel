<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        return response([
            'code' => 200,
            'message' => 'Bienvenu sur la page de notre api'
        ]);
    }

    public function create(Request $request) {
        // permet de verifier si la requette contient des valeurs 
        $donne = $request->validate([
           'categoryName' => 'required',
           'description' => 'required'
        ]);

        // insertion en base de donner
        $insert = Category::create([
          'categoryName' => $donne['categoryName'],
          'description' => $donne['description'],
        ]);

        // retourner une reponse de succes
        return response([
            'code' => 200,
            'message' => 'succes code',
            'description' => ' categorie créée avec succès',
            'data' => $insert
        ]);
    }

     public function deletecategory($id){
       // Chercher le produit dans le base de donnée 
       $produit = Category::find($id);
    //    var_dump($produit);
       if ($produit){
        // code pour supprimer le produit
          $produit->delete();
        return response([
            "code" => 200,
            "message" => "succes code",
            "description" => "la catégorie a été suprimé avec succès !",
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
