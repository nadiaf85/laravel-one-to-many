<?php

use App\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories=['cinema','motori','cibo','sport'];
        foreach($categories as $category_name){
            $new_category= new Category();
            $new_category->title = $category_name;
            $new_category->slug = Str::of($category_name)->slug('-');
            $new_category->save();
        }
    }
}
