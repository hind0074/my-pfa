<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\ClientController;
// Gestion des utilisateurs
Route::get('/', function () {
    return view('welcome'); 
})->name('welcome');

// Gestion des utilisateurs
Route::get('/users', [userController::class, 'index'])->name('users.index');
Route::get('/users/create', [userController::class, 'create'])->name('users.create');
Route::post('/users', [userController::class, 'store'])->name('users.store');
Route::get('/users/{id}', [userController::class, 'show'])->name('users.show');
Route::get('/users/{id}/edit', [userController::class, 'edit'])->name('users.edit');
Route::put('/users/{id}', [userController::class, 'update'])->name('users.update');
Route::delete('/users/{id}', [userController::class, 'destroy'])->name('users.destroy');

// Gestion des produits
Route::get('/produits', [ProduitController::class, 'index'])->name('produits.index');
Route::get('/produits/create', [ProduitController::class, 'create'])->name('produits.create');
Route::post('/produits', [ProduitController::class, 'store'])->name('produits.store');
Route::get('/produits/{id}', [ProduitController::class, 'show'])->name('produits.show');
Route::get('/produits/{id}/edit', [ProduitController::class, 'edit'])->name('produits.edit');
Route::put('/produits/{id}', [ProduitController::class, 'update'])->name('produits.update');
Route::delete('/produits/{id}', [ProduitController::class, 'destroy'])->name('produits.destroy');

// Gestion des categories
Route::get('/categories', [CategorieController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategorieController::class, 'create'])->name('categories.create');
Route::post('/categories', [CategorieController::class, 'store'])->name('categories.store');
Route::get('/categories/{id}', [CategorieController::class, 'show'])->name('categories.show');
Route::get('/categories/{id}/edit', [CategorieController::class, 'edit'])->name('categories.edit');
Route::put('/categories/{id}', [CategorieController::class, 'update'])->name('categories.update');
Route::delete('/categories/{id}', [CategorieController::class, 'destroy'])->name('categories.destroy');

// Gestion des commandes
Route::get('/commandes', [CommandeController::class, 'index'])->name('commandes.index');
Route::get('/commandes/create', [CommandeController::class, 'create'])->name('commandes.create');
Route::get('/commandes/{id}', [CommandeController::class, 'show'])->name('commandes.show');
Route::post('/commandes', [CommandeController::class, 'store'])->name('commandes.store');
Route::get('/commandes/{commande}/edit', [CommandeController::class, 'edit'])->name('commandes.edit');
Route::put('/commandes/{commande}', [CommandeController::class, 'update'])->name('commandes.update');
Route::delete('/commandes/{commande}', [CommandeController::class, 'destroy'])->name('commandes.destroy');
