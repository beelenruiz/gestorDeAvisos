<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $articles = Article::factory(20) -> create();

        $carts = Cart::pluck('id') -> toArray();

        $orders = Order::pluck('id') -> toArray();

        foreach ($articles as $article){
            shuffle($carts);
            shuffle($orders);
            $article -> carts() -> attach($this -> getRandomArrayId($carts), [
                'quantity' => rand(1, 5),
                'price' => $article -> price,
            ]);
            $article -> orders() -> attach($this -> getRandomArrayId($orders));
        }
    }

    private function getRandomArrayId(array $ides): array{
        return array_slice($ides, 0, random_int(1, count($ides) -1));
    }
}
