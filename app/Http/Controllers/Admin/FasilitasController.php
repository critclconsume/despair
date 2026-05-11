<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Fasilitas;
use Illuminate\Http\Request;

class FasilitasController extends Controller
{
    // ── List all facilities ───────────────────────────────────
    public function index()
    {
        $fasilitas = Fasilitas::latest()->get();
        return view('admin.fasilitas.index', compact('fasilitas'));
    }

    // ── Show create form ──────────────────────────────────────
    public function create()
    {
        return view('admin.fasilitas.form', [
            'fasilitas' => null,       // null = create mode
            'action'    => route('admin.fasilitas.store'),
            'method'    => 'POST',
        ]);
    }

    // ── Store new facility ────────────────────────────────────
    public function store(Request $request)
    {
        $validated = $this->validateFasilitas($request);

        if ($request->hasFile('photo')) {
            $validated['photo'] = $this->uploadPhoto($request);
        }

        Fasilitas::create($validated);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', "Fasilitas \"{$validated['name']}\" berhasil ditambahkan.");
    }

    // ── Show edit form ────────────────────────────────────────
    public function edit(Fasilitas $fasilitas)
    {
        return view('admin.fasilitas.form', [
            'fasilitas' => $fasilitas,
            'action'    => route('admin.fasilitas.update', $fasilitas->id),
            'method'    => 'PUT',
        ]);
    }

    // ── Update existing facility ──────────────────────────────
    public function update(Request $request, Fasilitas $fasilitas)
    {
        $validated = $this->validateFasilitas($request);

        if ($request->hasFile('photo')) {
            // Delete old photo file if it exists
            $this->deletePhoto($fasilitas->photo);
            $validated['photo'] = $this->uploadPhoto($request);
        }
        // If no new photo uploaded — keep the existing one (don't touch $validated['photo'])

        $fasilitas->update($validated);

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', "Fasilitas \"{$fasilitas->name}\" berhasil diperbarui.");
    }

    // ── Delete facility ───────────────────────────────────────
    public function destroy(Fasilitas $fasilitas)
    {
        $this->deletePhoto($fasilitas->photo);
        $name = $fasilitas->name;
        $fasilitas->delete();

        return redirect()
            ->route('admin.fasilitas.index')
            ->with('success', "Fasilitas \"{$name}\" berhasil dihapus.");
    }

    // ── Private helpers ───────────────────────────────────────

    private function validateFasilitas(Request $request): array
    {
        return $request->validate([
            'name'    => 'required|string|max:100',
            'address' => 'required|string|max:200',
            'type'    => 'required|string|max:50',
            'status'  => 'required|in:open,maintenance',
            'photo'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:5120',
        ], [
            'name.required'    => 'Nama fasilitas wajib diisi.',
            'address.required' => 'Alamat wajib diisi.',
            'type.required'    => 'Tipe fasilitas wajib dipilih.',
            'status.required'  => 'Status wajib dipilih.',
            'photo.image'      => 'File harus berupa gambar.',
            'photo.max'        => 'Ukuran foto maksimal 5 MB.',
        ]);
    }

    private function uploadPhoto(Request $request): string
    {
        $file     = $request->file('photo');
        $filename = time() . '_' . preg_replace('/\s+/', '_', $file->getClientOriginalName());
        $file->move(public_path('images/fasilitas'), $filename);
        return $filename;
    }

    private function deletePhoto(?string $photo): void
    {
        if (!$photo) return;
        $path = public_path('images/fasilitas/' . $photo);
        if (file_exists($path)) unlink($path);
    }
}
