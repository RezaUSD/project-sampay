<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>SAMPAY - Mobile</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="w-full max-w-sm bg-white p-6 shadow-md rounded-2xl mx-4">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-green-600">SAMPAY</h1>
            <p class="text-gray-500 mt-2">Masuk ke akun Anda</p>
        </div>

        @if($errors->any())
            <div class="bg-red-100 text-red-600 p-3 rounded-lg mb-4 text-sm text-center">
                {{ $errors->first() }}
            </div>
        @endif

        <form action="{{ route('app.login.post') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2">Email</label>
                <input type="email" name="email" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan email..." required value="{{ old('email') }}">
            </div>
            <div class="mb-6">
                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                <input type="password" name="password" class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500" placeholder="Masukkan password..." required>
            </div>
            <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 px-4 rounded-xl transition duration-200">
                Masuk
            </button>
        </form>
    </div>
</body>
</html>
