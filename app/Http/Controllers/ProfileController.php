<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use App\Models\User;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();

        // Eager load relationships if needed based on role
        if ($user->role === 'mahasiswa') {
            // Ensure we have access to pendaftar data for "Kelengkapan Data" widget
            $pendaftar = \App\Models\Pendaftar::where('user_id', $user->id)->with('dokumen')->first();

            if ($pendaftar) {
                // Calculate Completeness
                $filled = 0;
                $total = 0;

                // 1. User Data (Name, Email, Photo) - Weight: 15%
                $total += 3;
                if ($user->name)
                    $filled++;
                if ($user->email)
                    $filled++;
                if ($user->profile_photo_path)
                    $filled++;

                // 2. Main Pendaftar Data (NISN, NIK, Phone, Address, Gender, Place/Date Birth) - Weight: 35%
                $pendaftarFields = [
                    'nisn',
                    'nik',
                    'nomor_hp',
                    'alamat_jalan',
                    'jenis_kelamin',
                    'tempat_lahir',
                    'tanggal_lahir',
                    'agama',
                    'asal_sekolah'
                ];
                $total += count($pendaftarFields);
                foreach ($pendaftarFields as $field) {
                    if (!empty($pendaftar->$field))
                        $filled++;
                }

                // 3. Parent Data (Ayah/Ibu/Wali) - Weight: 20%
                // We check if at least Ayah OR Ibu data is partially present
                $parentFields = ['nama_ayah', 'nama_ibu', 'no_hp_ayah', 'no_hp_ibu'];
                $total += count($parentFields);
                foreach ($parentFields as $field) {
                    if (!empty($pendaftar->$field))
                        $filled++;
                }

                // 4. Program Studi - Weight: 10%
                $total += 1;
                if (!empty($pendaftar->pilihan_prodi))
                    $filled++;

                // 5. Documents (Assuming 3 main docs: KK, Ijazah, Photo) - Weight: 20%
                // We check the 'dokumen' relation count. Assuming ~3 required docs.
                // You can adjust this based on actual requirements.
                $total += 3;
                $docCount = $pendaftar->dokumen->count();
                // Cap at 3 for calculation limit
                $filled += min($docCount, 3);

                $percentage = $total > 0 ? round(($filled / $total) * 100) : 0;

                // Inject into model instance for View
                $pendaftar->progress_completion = $percentage;
            }

            return view('auth.profile', compact('user', 'pendaftar'));
        }

        return view('auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'image', 'max:2048'], // Max 2MB
            'current_password' => ['nullable', 'required_with:new_password', 'current_password'],
            'new_password' => ['nullable', 'min:8', 'confirmed'],
        ]);

        // Update basic info
        $user->name = $request->name;
        $user->email = $request->email;

        // Update Password if provided
        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->new_password);
        }

        // Handle Photo Upload
        if ($request->hasFile('photo')) {
            // Delete old photo if exists and is not default
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            $path = $request->file('photo')->store('profile-photos', 'public');
            $user->profile_photo_path = $path;
        }

        /** @var \App\Models\User $user */
        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
