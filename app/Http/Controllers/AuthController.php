<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function addusers(Request $request) {
         $start = $request->validate([
          "name" => "required",
          "email" => "required",
          "password" => "required",
         ]);

         // Insertion des données dans la BDD
         $insert = User::create([
           "name" => $start['name'],
           "email" => $start['email'],
           "password" => Hash::make($start['password']),
         ]);

         return response([
             "code" => 200,
            "message" => " succes code",
            "description" => "utilisateur crée avec succès",
            "data" => $insert,
         ]);
    }

    public function login(Request $request) {
        $start = $request->validate([
           "email" => "required",
          "password" => "required",
        ]);

        if(!Auth::attempt($start)) {
          return response([
            "code" => 400,
            "message" => "Failure",
            "description" => "Vos identifiants sont incorrectes",
            ]);
        }

        return response([
            "code" => 200,
            "message" => "succes code",
            "description" => "Vous êtes connecté !",
            "token"=>auth()->user()->createToken('secret')->plainTextToken
            ]);
    }
}
