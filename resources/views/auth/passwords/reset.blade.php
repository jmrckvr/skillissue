<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Set New Password</title>
    <link href="/resources/css/app.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white rounded shadow">
        <h1 class="text-xl font-semibold mb-4">Set New Password</h1>

        @if ($errors->any())
            <div class="mb-4 text-sm text-red-600">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>- {{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <label class="block mb-2">
                <span class="text-sm">Email</span>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" required class="mt-1 block w-full border rounded px-3 py-2" />
            </label>

            <label class="block mb-2">
                <span class="text-sm">Password</span>
                <input type="password" name="password" required class="mt-1 block w-full border rounded px-3 py-2" />
            </label>

            <label class="block mb-4">
                <span class="text-sm">Confirm Password</span>
                <input type="password" name="password_confirmation" required class="mt-1 block w-full border rounded px-3 py-2" />
            </label>

            <div>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Reset Password</button>
            </div>
        </form>
    </div>
</body>
</html>
