<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class userController extends Controller
{
     // 📌 Afficher la liste des utilisateurs
     public function index()
     {
         $users = User::all();
         return view('users.index', compact('users'));
     }
 
     // 📌 Afficher un utilisateur
     public function show($id)
     {
         $user = User::findOrFail($id);
         return view('users.show', compact('user'));
     }
 
     // 📌 Formulaire de création
     public function create()
     {
         return view('users.create');
     }
 
     // 📌 Enregistrer un nouvel utilisateur
     public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:8|confirmed', // Validation du mot de passe
    ]);
    
     User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
    ]);
    return redirect()->route('users.index')->with('success', 'Utilisateur ajouté avec succès.');
}
     // 📌 Formulaire d'édition
     public function edit($id)
     {
         $user = User::findOrFail($id);
         return view('users.edit', compact('user'));
     }
     
     // 📌 Mettre à jour un utilisateur
     public function update(Request $request, $id)
     {
         $user = User::findOrFail($id);
         
        // Validation des champs
        $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $id,
        'password' => 'nullable|string|min:8|confirmed', // Validation pour le mot de passe, s'il est fourni
         ]);

        // Mise à jour des informations de l'utilisateur
        $user->update([
        'name' => $request->name,
        'email' => $request->email,
         ]);

        // Si le mot de passe est fourni, on le met à jour
        if ($request->filled('password')) {
        $user->password = bcrypt($request->password); // Assurez-vous de hasher le mot de passe
        $user->save(); // Sauvegarder les changements
        }
 
         return redirect()->route('users.index')->with('success', 'Utilisateur mis à jour !');
     }
 
     // 📌 Supprimer un utilisateur
     public function destroy($id)
     {
         $user = User::findOrFail($id);
         $user->delete();
 
         return redirect()->route('users.index')->with('success', 'Utilisateur supprimé.');
     }
}
