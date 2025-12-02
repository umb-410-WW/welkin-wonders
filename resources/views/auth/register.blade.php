<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register – Welkin Wonders</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen w-full bg-[#0d0718] text-white overflow-x-hidden">

    <!-- NAV BAR -->
    <nav class="w-full px-8 py-4 flex items-center justify-between bg-[#1a1329] border-b border-[#2e2350] shadow-xl">

        <div class="flex items-center gap-3">
            <img src="/assets/img/crystal_ball_round.png" class="w-12 drop-shadow-lg">
            <span class="text-2xl font-bold text-purple-300">Welkin Wonders</span>
        </div>

        <div class="hidden md:flex gap-8 text-gray-300 text-lg">
            <a href="/" class="hover:text-purple-300">Home</a>
            <a href="/contact" class="hover:text-purple-300">Contact Us</a>
            <a href="/readings" class="hover:text-purple-300">Readings</a>
            <a href="/shop" class="hover:text-purple-300">Shop</a>
        </div>

        <div class="flex items-center gap-3">
            <input type="text" placeholder="Browse our products..."
                class="px-4 py-2 rounded-full bg-[#0f0a1a] border border-[#2e2350] text-sm text-gray-300 focus:ring-purple-500">

            <button class="px-4 py-2 rounded-full bg-purple-600 hover:bg-purple-700 transition">Go</button>
        </div>
    </nav>

    <!-- FULL SCREEN REGISTER FORM -->
    <div class="flex justify-center items-center min-h-[85vh] px-4">

        <div class="w-full max-w-md bg-[#1a1329] border border-[#2e2350]
                    rounded-2xl shadow-2xl p-10">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-300">Create Account</h1>
                <p class="text-gray-400 mt-1">Join the Welkin Wonders community</p>
            </div>

            <!-- FORM -->
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div class="mb-5">
                    <label for="name" class="text-purple-300 font-medium">Name</label>
                    <input id="name" name="name" type="text" required autofocus
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] text-white rounded-xl px-4 py-3 focus:ring-purple-500"
                        value="{{ old('name') }}">

                    @error('name')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-5">
                    <label for="email" class="text-purple-300 font-medium">Email</label>
                    <input id="email" name="email" type="email" required
                        class="mt-1 w-full bg-[#0f0a1a] border border-[#2e2350] text-white rounded-xl px-4 py-3 focus:ring-purple-500"
                        value="{{ old('email') }}">

                    @error('email')
                        <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <label for="password" class="text-purple-300 font-medium">Password</label>
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

                <!-- Submit -->
                <button type="submit"
                        class="w-full py-3 bg-purple-600 hover:bg-purple-700 rounded-xl font-semibold shadow-lg shadow-purple-900/40 transition">
                    Register
                </button>

                <!-- Already Registered -->
                <div class="text-center mt-5">
                    <a href="{{ route('login') }}"
                       class="text-sm text-gray-400 hover:text-purple-300 underline transition">
                        Already registered?
                    </a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>
