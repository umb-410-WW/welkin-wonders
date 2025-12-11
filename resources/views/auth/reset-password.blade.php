<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password – Welkin Wonders</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen w-full bg-[#0d0718] text-white overflow-x-hidden">

    <!-- MAIN RESET FORM CARD -->
    <div class="flex justify-center items-center min-h-[85vh] px-4">

        <div class="w-full max-w-md bg-[#1a1329] border border-[#2e2350]
                    rounded-2xl shadow-2xl p-10">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-300">Reset Password</h1>
                <p class="text-gray-400 mt-1">Enter your new password below</p>
            </div>

            <form method="POST" action="{{ route('password.store') }}">
                @csrf

                <!-- RESET TOKEN -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="text-purple-300 font-medium">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        value="{{ old('email', $request->email) }}"
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] text-white rounded-xl px-4 py-3 focus:ring-purple-500">

                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="text-purple-300 font-medium">New Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] text-white rounded-xl px-4 py-3 focus:ring-purple-500">

                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-5">
                    <label for="password_confirmation" class="text-purple-300 font-medium">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" required
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] text-white rounded-xl px-4 py-3 focus:ring-purple-500">

                    @error('password_confirmation')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Reset Button -->
                <button type="submit"
                        class="w-full py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold shadow-lg shadow-purple-900/40 transition">
                    Reset Password
                </button>
            </form>
        </div>
    </div>

</body>
</html>
