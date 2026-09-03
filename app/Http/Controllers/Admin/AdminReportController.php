<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminReportController extends Controller
{
    public function index(Request $request)
    {
        $query = Report::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $reports = $query->latest('published_at')->paginate(15)->withQueryString();
        return view('admin.reports.index', compact('reports'));
    }

    public function create()
    {
        return view('admin.reports.form', ['report' => new Report()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'string', 'max:80'],
            'description'  => ['nullable', 'string'],
            'file'         => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'cover'        => ['nullable', 'image', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('reports', config('filesystems.default'));
        }
        if ($request->hasFile('cover')) {
            $data['cover_image'] = $request->file('cover')->store('reports/covers', config('filesystems.default'));
        }
        unset($data['file'], $data['cover']);

        Report::create($data);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Publication créée.');
    }

    public function edit(Report $report)
    {
        return view('admin.reports.form', compact('report'));
    }

    public function update(Request $request, Report $report)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'string', 'max:80'],
            'description'  => ['nullable', 'string'],
            'file'         => ['nullable', 'file', 'mimes:pdf', 'max:20480'],
            'cover'        => ['nullable', 'image', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('file')) {
            if ($report->file_path) Storage::disk(config('filesystems.default'))->delete($report->file_path);
            $data['file_path'] = $request->file('file')->store('reports', config('filesystems.default'));
        }
        if ($request->hasFile('cover')) {
            if ($report->cover_image) Storage::disk(config('filesystems.default'))->delete($report->cover_image);
            $data['cover_image'] = $request->file('cover')->store('reports/covers', config('filesystems.default'));
        }
        unset($data['file'], $data['cover']);

        $report->update($data);

        return redirect()->route('admin.reports.index')
            ->with('success', 'Publication mise à jour.');
    }

    public function destroy(Report $report)
    {
        if ($report->file_path)   Storage::disk(config('filesystems.default'))->delete($report->file_path);
        if ($report->cover_image) Storage::disk(config('filesystems.default'))->delete($report->cover_image);
        $report->delete();

        return redirect()->route('admin.reports.index')
            ->with('success', 'Publication supprimée.');
    }
}
