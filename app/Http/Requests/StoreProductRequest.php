<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'brand_id' => 'nullable|exists:brands,id',
            'category_id' => 'nullable|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'sub_sub_category_id' => 'nullable|exists:sub_sub_categories,id',
            'name' => 'required|string|max:255',
            'product_code' => 'required|string|max:255|unique:products,product_code',
            'product_size' => 'nullable|string|max:255',
            'product_color' => 'nullable|string|max:255',
            'stock_quantity' => 'required|integer|min:0',
            'tags' => 'nullable|string|max:255',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lt:price',
            'short_description' => 'required|string|max:500',
            'long_description' => 'required|string',
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'multi_images' => 'nullable|array',
            'multi_images.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'hot_deals' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'special_offer' => 'nullable|boolean',
            'special_deal' => 'nullable|boolean',
            'status' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'discount_price.lt' => 'The discount price must be less than the original price.',
            'thumbnail.max' => 'The thumbnail image must not be larger than 2MB.',
            'multi_images.*.max' => 'Each gallery image must not be larger than 2MB.',
        ];
    }
}
