<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Korisnik;
use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\OrderController
 */
final class OrderControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $orders = Order::factory()->count(3)->create();

        $response = $this->get(route('orders.index'));

        $response->assertOk();
        $response->assertViewIs('order.index');
        $response->assertViewHas('orders', $orders);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('orders.create'));

        $response->assertOk();
        $response->assertViewIs('order.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'store',
            \App\Http\Requests\OrderStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $korisnik = Korisnik::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);
        $ukupna_cena = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->post(route('orders.store'), [
            'korisnik' => $korisnik->id,
            'status' => $status,
            'ukupna_cena' => $ukupna_cena,
        ]);

        $orders = Order::query()
            ->where('korisnik', $korisnik->id)
            ->where('status', $status)
            ->where('ukupna_cena', $ukupna_cena)
            ->get();
        $this->assertCount(1, $orders);
        $order = $orders->first();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.show', $order));

        $response->assertOk();
        $response->assertViewIs('order.show');
        $response->assertViewHas('order', $order);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $order = Order::factory()->create();

        $response = $this->get(route('orders.edit', $order));

        $response->assertOk();
        $response->assertViewIs('order.edit');
        $response->assertViewHas('order', $order);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\OrderController::class,
            'update',
            \App\Http\Requests\OrderUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $order = Order::factory()->create();
        $korisnik = Korisnik::factory()->create();
        $status = fake()->randomElement(/** enum_attributes **/);
        $ukupna_cena = fake()->randomFloat(/** decimal_attributes **/);

        $response = $this->put(route('orders.update', $order), [
            'korisnik' => $korisnik->id,
            'status' => $status,
            'ukupna_cena' => $ukupna_cena,
        ]);

        $order->refresh();

        $response->assertRedirect(route('orders.index'));
        $response->assertSessionHas('order.id', $order->id);

        $this->assertEquals($korisnik->id, $order->korisnik);
        $this->assertEquals($status, $order->status);
        $this->assertEquals($ukupna_cena, $order->ukupna_cena);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $order = Order::factory()->create();

        $response = $this->delete(route('orders.destroy', $order));

        $response->assertRedirect(route('orders.index'));

        $this->assertModelMissing($order);
    }
}
