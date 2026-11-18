<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Product::class;

    public function definition(): array
    {
        $price = $this->faker->randomFloat(2, 10, 500);
        $category = Category::inRandomOrder()->first();
        $subCategory = SubCategory::where('category_id', $category->id)->inRandomOrder()->first();
        $subSubCategory = SubSubCategory::where('sub_category_id', $subCategory->id)->inRandomOrder()->first();
        $brand = Brand::inRandomOrder()->first();

        return [
            'brand_id' => $brand ? $brand->id : null,
            'category_id' => $category->id,
            'sub_category_id' => $subCategory ? $subCategory->id : null,
            'sub_sub_category_id' => $subSubCategory ? $subSubCategory->id : null,
            'name' => $this->faker->words(3, true),
            'slug' => Str::slug($this->faker->words(3, true)).'-'.Str::random(4),
            'product_code' => strtoupper($this->faker->bothify('??-####')),
            'product_size' => $this->faker->randomElement(['S,M,L', 'One Size', '40,41,42']),
            'product_color' => $this->faker->randomElement(['Red,Blue', 'Black,White', 'Green']),
            'stock_quantity' => $this->faker->numberBetween(0, 50),
            'tags' => implode(',', $this->faker->words(3)),
            'price' => $price,
            'discount_price' => $this->faker->boolean(30) ? $price * 0.8 : null,
            'short_description' => $this->faker->sentence(),
            'long_description' => $this->faker->paragraphs(3, true),
            'thumbnail' => 'https://picsum.photos/seed/'.Str::random(5).'/600/600',
            'hot_deals' => $this->faker->boolean(20),
            'featured' => $this->faker->boolean(20),
            'special_offer' => $this->faker->boolean(20),
            'special_deal' => $this->faker->boolean(20),
            'status' => true,
        ];
    }
}
