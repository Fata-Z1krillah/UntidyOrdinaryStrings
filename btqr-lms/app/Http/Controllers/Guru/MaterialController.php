<?php

namespace App\Http\Controllers\Guru;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function create(Course $course)
    {
        return view('guru.materials.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:pdf,video,audio,text,link',
            'file' => 'nullable|file|max:51200',
            'external_url' => 'nullable|url',
            'order' => 'integer',
        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('materials', 'public');
        }

        $course->materials()->create([
            'title' => $validated['title'],
            'description' => $validated['description'] ?? null,
            'type' => $validated['type'],
            'file_path' => $filePath,
            'external_url' => $validated['external_url'] ?? null,
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('guru.courses.show', $course)->with('success', 'Materi berhasil ditambahkan.');
    }

    public function edit(Course $course, Material $material)
    {
        return view('guru.materials.edit', compact('course', 'material'));
    }

    public function update(Request $request, Course $course, Material $material)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'type' => 'required|in:pdf,video,audio,text,link',
            'file' => 'nullable|file|max:51200',
            'external_url' => 'nullable|url',
            'order' => 'integer',
        ]);

        if ($request->hasFile('file')) {
            $validated['file_path'] = $request->file('file')->store('materials', 'public');
        }

        $material->update($validated);
        return redirect()->route('guru.courses.show', $course)->with('success', 'Materi berhasil diperbarui.');
    }

    public function destroy(Course $course, Material $material)
    {
        $material->delete();
        return redirect()->route('guru.courses.show', $course)->with('success', 'Materi berhasil dihapus.');
    }
}
