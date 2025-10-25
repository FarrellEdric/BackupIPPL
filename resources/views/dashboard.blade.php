{{-- allert silahkan login sesuai akun dan pastikan user dan password benar --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg text-center">
        <h1 class="text-3xl font-bold mb-4">Welcome to the Dashboard</h1>
        <p class="text-gray-700 mb-6">You have successfully logged in.</p>
        <a href="{{ route('logout') }}"
           onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
           class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
            Logout
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
            @csrf
        </form>
    </div>
</body>
</html>