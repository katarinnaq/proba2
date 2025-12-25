<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ProductController
 */
final class ProductControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $products = Product::factory()->count(3)->create();

        $response = $this->get(route('products.index'));

        $response->assertOk();
        $response->assertViewIs('product.index');
        $response->assertViewHas('products', $products);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('products.create'));

        $response->assertOk();
        $response->assertViewIs('product.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'store',
            \App\Http\Requests\ProductStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $category = Category::factory()->create();
        $naziv = fake()->word();
        $tip_vode = fake()->word();
        $ambalaza = fake()->word();
        $cena = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('products.store'), [
            'category_id' => $category->id,
            'naziv' => $naziv,
            'tip_vode' => $tip_vode,
            'ambalaza' => $ambalaza,
            'cena' => $cena,
        ]);

        $products = Product::query()
            ->where('category_id', $category->id)
            ->where('naziv', $naziv)
            ->where('tip_vode', $tip_vode)
            ->where('ambalaza', $ambalaza)
            ->where('cena', $cena)
            ->get();
        $this->assertCount(1, $products);
        $product = $products->first();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.show', $product));

        $response->assertOk();
        $response->assertViewIs('product.show');
        $response->assertViewHas('product', $product);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $product = Product::factory()->create();

        $response = $this->get(route('products.edit', $product));

        $response->assertOk();
        $response->assertViewIs('product.edit');
        $response->assertViewHas('product', $product);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ProductController::class,
            'update',
            \App\Http\Requests\ProductUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $product = Product::factory()->create();
        $category = Category::factory()->create();
        $naziv = fake()->word();
        $tip_vode = fake()->word();
        $ambalaza = fake()->word();
        $cena = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('products.update', $product), [
            'category_id' => $category->id,
            'naziv' => $naziv,
            'tip_vode' => $tip_vode,
            'ambalaza' => $ambalaza,
            'cena' => $cena,
        ]);

        $product->refresh();

        $response->assertRedirect(route('products.index'));
        $response->assertSessionHas('product.id', $product->id);

        $this->assertEquals($category->id, $product->category_id);
        $this->assertEquals($naziv, $product->naziv);
        $this->assertEquals($tip_vode, $product->tip_vode);
        $this->assertEquals($ambalaza, $product->ambalaza);
        $this->assertEquals($cena, $product->cena);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $product = Product::factory()->create();

        $response = $this->delete(route('products.destroy', $product));

        $response->assertRedirect(route('products.index'));

        $this->assertModelMissing($product);
    }
}
