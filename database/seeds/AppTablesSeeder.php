<?php

use Illuminate\Database\Seeder;

class AppTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $numOfSellers=2;
        $numOfProducts=3;
        $numOfReviews=10;
        $numOfLabels=5;

        factory(App\Label::class,$numOfLabels)->create();

       factory(App\Seller::class, $numOfSellers)->create();

       $seller_ids=App\Seller::all('id');


       for($i=0; $i<$numOfSellers;$i++){
         $seller_id = $seller_ids->get('id',$i+1);

         factory(App\Address::class)->create(['seller_id'=>$seller_id]);

         factory(App\Product::class,$numOfProducts)->create(['seller_id'=>$seller_id])->each(function($p){
           $p->labels()->save(App\Label::all()->random());
         });

       }


       $products_id=App\Product::all('id');

       for($i=0;$i<$numOfReviews;$i++){
        factory(App\Review::class,$numOfReviews)->create(['product_id'=>$products_id->get('id',$i+1)]);
       }


    }
}
