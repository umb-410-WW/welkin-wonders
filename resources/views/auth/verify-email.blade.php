<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification – Welkin Wonders</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="min-h-screen w-full bg-[#0d0718] text-white overflow-x-hidden">

    <!-- MAIN VERIFICATION CARD -->
    <div style="margin-top:50px;" class="flex justify-center items-center min-h-[85vh] px-4">

        <div class="w-full max-w-md bg-[#1a1329] border border-[#2e2350]
                    rounded-2xl shadow-2xl p-10">

            <div class="text-center mb-6">
                <h1 class="text-3xl font-bold text-purple-300">Verify Your Email</h1>
                <p class="text-gray-400 mt-2">
                    Thanks for signing up! Please check your inbox and click the verification link.
                </p>
            </div>

            <!-- Status Message -->
            @if (session('status') == 'verification-link-sent')
                <div class="mb-4 text-purple-300 text-center font-medium">
                    A new verification link has been sent to your email.
                </div>
            @endif

            <div class="mt-6 flex flex-col gap-4">

                <!-- Resend Verification Email -->
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf

                    <button type="submit"
                        class="w-full py-3 bg-purple-600 hover:bg-purple-700 rounded-xl shadow-lg shadow-purple-900/40 transition font-semibold">
                        Resend Verification Email
                    </button>
                </form>

                <!-- Log Out -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="w-full text-gray-400 hover:text-purple-300 underline transition text-sm">
                        Log Out
                    </button>
                </form>

            </div>

        </div>
    </div>

</body>
</html>
