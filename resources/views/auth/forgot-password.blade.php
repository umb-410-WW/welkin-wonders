<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password – Welkin Wonders</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen w-full bg-[#0d0718] text-white overflow-x-hidden">

    <!-- MAIN FORGOT PASSWORD CARD -->
    <div class="flex justify-center items-center min-h-[85vh] px-4">

        <div class="w-full max-w-md bg-[#1a1329] border border-[#2e2350]
                    rounded-2xl shadow-2xl p-10">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-300">Forgot Password</h1>
                <p class="text-gray-400 mt-2">
                    Enter your email below and we’ll send you a link to reset your password.
                </p>
            </div>

            <!-- Success Message -->
            <x-auth-session-status class="mb-4 text-center text-purple-300" :status="session('status')" />

            <!-- FORM -->
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="text-purple-300 font-medium">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        value="{{ old('email') }}"
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] rounded-xl text-white px-4 py-3 focus:ring-purple-500">

                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold shadow-lg shadow-purple-900/40 transition">
                    Email Password Reset Link
                </button>

            </form>
        </div>
    </div>

</body>
</html>
