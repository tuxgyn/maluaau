<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::available();

        if ($search = $request->query('busca')) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('category', 'like', "%{$search}%");
            });
        }

        return response()->json([
            'data' => $query->get(['name', 'category', 'description', 'price', 'stock'])
                ->map(fn ($p) => [
                    'nome' => $p->name,
                    'categoria' => $p->category,
                    'descricao' => $p->description,
                    'preco' => 'R$ ' . number_format($p->price, 2, ',', '.'),
                    'estoque' => $p->stock,
                ]),
        ]);
    }
}