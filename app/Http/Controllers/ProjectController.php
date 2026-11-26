<?php

// NIM: 252410102004

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProjectController extends Controller
{
    public function index(): View
    {
        $projects = Project::with('client')
            ->withCount('bids')
            ->latest()
            ->get();

        return view('projects.index', compact('projects'));
    }

    public function create(): View
    {
        $clients = User::where('role', 'client')->orderBy('name')->get();

        return view('projects.create', compact('clients'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'budget' => ['required', 'integer', 'min:1'],
            'deadline' => ['required', 'date'],
            'status' => ['required', 'in:open,in_progress,completed,cancelled'],
        ]);

        $validated['title'] = trim(strip_tags($validated['title']));
        $validated['description'] = trim(strip_tags($validated['description']));

        Project::create($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyek baru berhasil ditambahkan.');
    }

    public function show(Project $project): View
    {
        $project->load(['client', 'bids.freelancer']);

        return view('projects.show', compact('project'));
    }

    public function edit(Project $project): View
    {
        $clients = User::where('role', 'client')->orderBy('name')->get();

        return view('projects.edit', compact('project', 'clients'));
    }

    public function update(Request $request, Project $project): RedirectResponse
    {
        $validated = $request->validate([
            'client_id' => ['required', 'exists:users,id'],
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'budget' => ['required', 'integer', 'min:1'],
            'deadline' => ['required', 'date'],
            'status' => ['required', 'in:open,in_progress,completed,cancelled'],
        ]);

        $validated['title'] = trim(strip_tags($validated['title']));
        $validated['description'] = trim(strip_tags($validated['description']));

        $project->update($validated);

        return redirect()
            ->route('projects.index')
            ->with('success', 'Data proyek berhasil diperbarui.');
    }

    public function destroy(Project $project): RedirectResponse
    {
        $project->delete();

        return redirect()
            ->route('projects.index')
            ->with('success', 'Proyek berhasil dihapus.');
    }
}
