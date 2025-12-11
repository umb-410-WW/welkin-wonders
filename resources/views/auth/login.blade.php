<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login – Welkin Wonders</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen w-full bg-[#0d0718] text-white overflow-x-hidden">

    <!-- FULL PAGE CENTERED LOGIN CARD -->
    <div class="flex justify-center items-center min-h-[85vh] px-4">

        <div class="w-full max-w-md bg-[#1a1329] border border-[#2e2350]
                    rounded-2xl shadow-2xl p-10">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-300">Login</h1>
                <p class="text-gray-400 mt-1">Access your Welkin account</p>
            </div>

            <!-- ERROR STATUS -->
            @if (session('status'))
                <div class="mb-4 text-purple-300 text-center">
                    {{ session('status') }}
                </div>
            @endif

            <!-- LOGIN FORM -->
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="text-purple-300 font-medium">Email</label>
                    <input id="email" name="email" type="email" required autofocus
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] rounded-xl px-4 py-3 text-white focus:ring-purple-500">
                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="text-purple-300 font-medium">Password</label>
                    <input id="password" name="password" type="password" required
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] rounded-xl px-4 py-3 text-white focus:ring-purple-500">
                    @error('password')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-5">
                    <input id="remember_me" type="checkbox"
                           class="rounded text-purple-600 border-gray-300 focus:ring-purple-500"
                           name="remember">
                    <label for="remember_me" class="ms-2 text-sm text-gray-300">
                        Remember me
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                    class="w-full py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold shadow-lg shadow-purple-900/40 transition">
                    Log In
                </button>

                <!-- Forgot Password -->
                <div class="text-center mt-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}"
                           class="text-sm text-gray-400 hover:text-purple-300 underline transition">
                            Forgot your password?
                        </a>
                    @endif
                </div>
            </form>

            <!-- REGISTER LINK -->
            <a href="{{ route('register') }}"
               class="block w-full text-center mt-6 py-3 bg-[#2e2350] hover:bg-[#3d2f6b] rounded-xl transition">
                Create a New Account
            </a>

        </div>
    </div>

</body>
</html>
