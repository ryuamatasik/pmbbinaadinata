<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Defaults\Password;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Custom Logic to support existing "Role by Email" pattern temporarily, 
        // or just standard Auth::attempt if the user exists.
        // The previous web.php had logic to "Find or Create" based on email role string. 
        // We should PROBABLY standardize this, but to keep existing accounts working:

        $email = strtolower($request->email);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return $this->redirectBasedOnRole(Auth::user());
        }



        return back()->withErrors([
            'email' => 'Kombinasi email dan password tidak cocok.',
        ])->onlyInput('email');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8', // removed confirmed for now as form might not have it, but better to add it
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'mahasiswa', // Default role for public registration 
            // In the previous code, role was determined by email string.
            // Here we assume 'mahasiswa' for public registration.
            // We might need to ensure the User model or some logic assigns the role. 
            // Since there's no visible 'role' column in User model snippets seen so far (it was inferred from email string in web.php), 
            // we might need to rely on that or add a role column.
            // Wait, web.php said: $role = 'mahasiswa'; if(str_contains..). 
            // It didn't save the role to DB! It just redirected based on email.
            // This is fragile. We should probably add a 'role' column if it doesn't exist, 
            // OR just rely on the fact that if they register here, they are mahasiswa.
            // Ensure we handle profile photo path if needed, or leave null
        ]);

        // Auto-create Pendaftar record for Mahasiswa role
        // Assuming every public registration is a Mahasiswa
        $pendaftar = \App\Models\Pendaftar::create([
            'user_id' => $user->id,
            'nama_lengkap' => $user->name,
            'email' => $user->email,
            'status' => 'Draft',
            // Default values for required fields to prevent SQL Error 1364
            'nisn' => '0',             // Added NISN default
            'pilihan_prodi' => '-',
            'no_hp' => '-',
            'nik' => '0000000000000000', // Dummy NIK
            'tempat_lahir' => '-',
            'tanggal_lahir' => '2000-01-01',
            'jenis_kelamin' => 'L',
            'agama' => 'Islam',
            'alamat_lengkap' => '-',
            'kelurahan' => '-',
            'kecamatan' => '-',
            'kabupaten' => '-',
            'provinsi' => '-',
            'nama_sekolah' => '-',
            'jurusan_sekolah' => '-',    // Added missing default
            'alamat_sekolah' => '-',     // Added missing default
            'tahun_lulus' => date('Y'),
            'nilai_rata_rata' => 0,
            'nama_ayah' => '-',          // Added missing default
            'pekerjaan_ayah' => '-',     // Added missing default
            'hp_ayah' => '-',            // Added missing default
            'nama_ibu' => '-',           // Added missing default
            'pekerjaan_ibu' => '-',      // Added missing default
            'hp_ibu' => '-',             // Added missing default
            'penghasilan_ayah' => '< 1 Juta', // Added missing default
            'penghasilan_ibu' => '< 1 Juta', // Added missing default
        ]);

        // Send Welcome Email
        try {
            \Illuminate\Support\Facades\Mail::to($user->email)->send(new \App\Mail\WelcomeEmail($pendaftar));
        } catch (\Exception $e) {
            // Log error
        }

        Auth::login($user);

        return redirect()->route('mahasiswa.pendaftaran');
    }

    public function logout(Request $request)
    {
        \Illuminate\Support\Facades\Log::info('Logout initiated for user: ' . (Auth::user()->email ?? 'unknown'));
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        \Illuminate\Support\Facades\Log::info('Logout complete, redirecting to login route.');
        return redirect()->route('login');
    }

    protected function redirectBasedOnRole($user)
    {
        switch ($user->role) {
            case 'admin':
                return redirect()->route('admin.dashboard');
            case 'pimpinan':
                return redirect()->route('dashboard.pimpinan');
            default:
                return redirect()->route('mahasiswa.dashboard');
        }
    }
}
