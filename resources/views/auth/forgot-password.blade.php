<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - PMB Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Lexend', sans-serif;
        }
    </style>
</head>

<body class="bg-[#f6f8fb] min-h-screen flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-xl w-full max-w-md p-8">
        <div class="text-center mb-8">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Lupa Password? 🔒</h1>
            <p class="text-gray-500 text-sm">Masukkan email Anda untuk menerima link reset password.</p>
        </div>

        @if (session('success'))
            <div class="mb-4 bg-green-50 text-green-600 p-3 rounded-lg text-sm font-medium">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="mb-4 bg-red-50 text-red-600 p-3 rounded-lg text-sm font-medium">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-6">
                <label class="block text-xs font-bold text-gray-500 uppercase mb-2">Email Address</label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:outline-none transition-all placeholder-gray-400"
                    placeholder="nama@email.com">
            </div>

            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-colors shadow-lg shadow-blue-200">
                Kirim Link Reset
            </button>
        </form>

        <div class="mt-8 text-center border-t border-gray-100 pt-6">
            <a href="{{ route('login') }}"
                class="text-sm font-medium text-gray-500 hover:text-blue-600 transition-colors">
                &larr; Kembali ke Login
            </a>
        </div>
    </div>
</body>

</html>