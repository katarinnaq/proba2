<?php

namespace App\Http\Controllers;

use App\Http\Requests\ReportStoreRequest;
use App\Http\Requests\ReportUpdateRequest;
use App\Models\Report;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request)
    {
        $reports = Report::all();

        return view('report.index', [
            'reports' => $reports,
        ]);
    }

    public function create(Request $request)
    {
        return view('report.create');
    }

    public function store(ReportStoreRequest $request)
    {
        $report = Report::create($request->validated());

        $request->session()->flash('report.id', $report->id);

        return redirect()->route('reports.index');
    }

    public function show(Request $request, Report $report)
    {
        return view('report.show', [
            'report' => $report,
        ]);
    }

    public function edit(Request $request, Report $report)
    {
        return view('report.edit', [
            'report' => $report,
        ]);
    }

    public function update(ReportUpdateRequest $request, Report $report)
    {
        $report->update($request->validated());

        $request->session()->flash('report.id', $report->id);

        return redirect()->route('reports.index');
    }

    public function destroy(Request $request, Report $report)
    {
        $report->delete();

        return redirect()->route('reports.index');
    }
}
