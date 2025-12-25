<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Admin;
use App\Models\Report;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Carbon;
use JMac\Testing\Traits\AdditionalAssertions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\ReportController
 */
final class ReportControllerTest extends TestCase
{
    use AdditionalAssertions, RefreshDatabase, WithFaker;

    #[Test]
    public function index_displays_view(): void
    {
        $reports = Report::factory()->count(3)->create();

        $response = $this->get(route('reports.index'));

        $response->assertOk();
        $response->assertViewIs('report.index');
        $response->assertViewHas('reports', $reports);
    }


    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('reports.create'));

        $response->assertOk();
        $response->assertViewIs('report.create');
    }


    #[Test]
    public function store_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReportController::class,
            'store',
            \App\Http\Requests\ReportStoreRequest::class
        );
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $admin = Admin::factory()->create();
        $naziv = fake()->word();
        $period_od = Carbon::parse(fake()->date());
        $period_do = Carbon::parse(fake()->date());
        $datum_kreiranja = Carbon::parse(fake()->date());

        $response = $this->post(route('reports.store'), [
            'admin' => $admin->id,
            'naziv' => $naziv,
            'period_od' => $period_od->toDateString(),
            'period_do' => $period_do->toDateString(),
            'datum_kreiranja' => $datum_kreiranja->toDateString(),
        ]);

        $reports = Report::query()
            ->where('admin', $admin->id)
            ->where('naziv', $naziv)
            ->where('period_od', $period_od)
            ->where('period_do', $period_do)
            ->where('datum_kreiranja', $datum_kreiranja)
            ->get();
        $this->assertCount(1, $reports);
        $report = $reports->first();

        $response->assertRedirect(route('reports.index'));
        $response->assertSessionHas('report.id', $report->id);
    }


    #[Test]
    public function show_displays_view(): void
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.show', $report));

        $response->assertOk();
        $response->assertViewIs('report.show');
        $response->assertViewHas('report', $report);
    }


    #[Test]
    public function edit_displays_view(): void
    {
        $report = Report::factory()->create();

        $response = $this->get(route('reports.edit', $report));

        $response->assertOk();
        $response->assertViewIs('report.edit');
        $response->assertViewHas('report', $report);
    }


    #[Test]
    public function update_uses_form_request_validation(): void
    {
        $this->assertActionUsesFormRequest(
            \App\Http\Controllers\ReportController::class,
            'update',
            \App\Http\Requests\ReportUpdateRequest::class
        );
    }

    #[Test]
    public function update_redirects(): void
    {
        $report = Report::factory()->create();
        $admin = Admin::factory()->create();
        $naziv = fake()->word();
        $period_od = Carbon::parse(fake()->date());
        $period_do = Carbon::parse(fake()->date());
        $datum_kreiranja = Carbon::parse(fake()->date());

        $response = $this->put(route('reports.update', $report), [
            'admin' => $admin->id,
            'naziv' => $naziv,
            'period_od' => $period_od->toDateString(),
            'period_do' => $period_do->toDateString(),
            'datum_kreiranja' => $datum_kreiranja->toDateString(),
        ]);

        $report->refresh();

        $response->assertRedirect(route('reports.index'));
        $response->assertSessionHas('report.id', $report->id);

        $this->assertEquals($admin->id, $report->admin);
        $this->assertEquals($naziv, $report->naziv);
        $this->assertEquals($period_od, $report->period_od);
        $this->assertEquals($period_do, $report->period_do);
        $this->assertEquals($datum_kreiranja, $report->datum_kreiranja);
    }


    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $report = Report::factory()->create();

        $response = $this->delete(route('reports.destroy', $report));

        $response->assertRedirect(route('reports.index'));

        $this->assertModelMissing($report);
    }
}
