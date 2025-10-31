<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Verify Email</title>
    <link href="/resources/css/app.css" rel="stylesheet">
</head>
<body class="min-h-screen bg-gray-50 flex items-center justify-center">
    <div class="w-full max-w-md p-6 bg-white rounded shadow">
        <h1 class="text-xl font-semibold mb-2">Verify your email</h1>

        <p class="mb-4 text-sm text-gray-700">Before proceeding, please check your email for a verification link. If you did not receive the email, you may request another.</p>

        @if (session('status') === 'verification-link-sent')
            <div class="mb-4 text-sm text-green-600">A new verification link has been sent to your email address.</div>
        @endif

        <form method="POST" action="{{ route('verification.resend') }}">
            @csrf
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Resend verification email</button>
        </form>
    </div>
</body>
</html>
