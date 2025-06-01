<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    public function index()
    {
        $cart = null;

        if (Auth::check()) {
            $cart = Cart::with('articles')
                ->firstOrCreate([
                    'company_id' => Auth::user()->company->id
                ]);
        }

        return view('cart.index', compact('cart'));
    }


    // añadir producto al carrito desde la vista de articles ------------------------------------------------------
    public function add(Request $request)
    {
        $request->validate([
            'article_id' => 'required|exists:articles,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $article = Article::findOrFail($request->article_id);

        $cart = Cart::firstOrCreate(['company_id' => Auth::user()->company->id]);
        $exists = $cart->articles()->where('article_id', $article->id)->first();

        // Aquí podrías añadir una verificación de stock si es necesario
        // if ($article->stock < $request->quantity) {
        //     return response()->json(['error' => 'No hay suficiente stock disponible.'], 400);
        // }

        $message = '';

        if ($exists) {
            // si el articulo ya esta, actualizo la cantidad
            $cart->articles()->updateExistingPivot($article->id, [
                'quantity' => $exists->pivot->quantity + $request->quantity
            ]);
            $message = 'Cantidad de "' . $article->name . '" actualizada en el carrito.';
        } else {
            // articulo nuevo
            $cart->articles()->attach($article->id, [
                'quantity' => $request->quantity,
                'price' => $article->price,
            ]);
            $message = 'Artículo "' . $article->name . '" añadido al carrito.';
        }

        $cart->refresh();

        // detalles para la notificacion
        $addedArticleDetails = [
            'id' => $article->id,
            'name' => $article->name,
            'image' =>  Storage::url($article->images->first()->path),
            'quantity' => $request->quantity
        ];

        return response()->json([
            'message' => $message,
            'added_article' => $addedArticleDetails
        ]);
    }

    // Eliminar un producto de la cesta ----------------------------------------------------------------------------
    public function destroy(Article $article)
    {
        $cart = Cart::where('company_id', Auth::user()->company->id)->first();
        $cart->articles()->detach($article->id);

        return response()->json([
            'success' => true,
            'message' => 'Artículo "' . $article->name . '" eliminado del carrito.',
        ]);
    }


    // editar, añado o resto cantidad ------------------------------------------------------------------------------
    public function updateQuantity(Request $request, Article $article)
    {
        $request->validate([
            'num' => 'required|integer|in:-1,1'
        ]);

        $cart = Auth::user()->company->cart;

        $exists = $cart->articles()->where('article_id', $article->id)->first();

        if ($exists) {
            $newQuantity = $exists->pivot->quantity + $request->num;

            if ($newQuantity < 1) {
                // Si la cantidad es menor que 1, eliminamos el artículo
                $cart->articles()->detach($article->id);
                $message = 'Artículo "' . $article->name . '" eliminado del carrito.';
            } else {
                // Aquí podrías añadir una comprobación de stock si es necesario
                // if ($newQuantity > $article->stock) { /* Manejar error de stock */ }

                $cart->articles()->updateExistingPivot($article->id, [
                    'quantity' => $newQuantity,
                ]);
                $message = 'Cantidad de "' . $article->name . '" actualizada.';
            }

            return response()->json([
                'success' => true,
                'message' => $message,
            ]);

        } else {
            // Si no se encuentra el artículo en el carrito
            if ($request->expectsJson()) {
                return response()->json(['error' => 'Artículo no encontrado en el carrito.'], 404);
            }
        }
    }


    // vacia el carrito -------------------------------------------------------------------------------------------
    public function emptyCart()
    {
        $cart = Auth::user()->company->cart;

        if ($cart) {
            $cart->articles()->detach();
        }

        return response()->json([
            'success' => true,
            'message' => 'Todos los artículos han sido eliminados del carrito.',
        ]);
    }
}
