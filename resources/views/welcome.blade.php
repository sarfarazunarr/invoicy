<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Invoicy - Your Own Invoices</title>
  <script src="https://cdn.tailwindcss.com"></script>

</head>
<body>

<div class="relative bg-gradient-to-r from-purple-600 to-blue-600 h-screen text-white overflow-hidden">
  <div class="absolute inset-0">
    <img src="https://plus.unsplash.com/premium_photo-1679923814036-8febf10a04c0" alt="Background Image" class="object-cover object-center w-full h-full" />
    <div class="absolute inset-0 bg-black opacity-75"></div>
  </div>
  
  <div class="relative z-10 flex flex-col justify-center items-center h-full text-center">
    <h1 class="text-5xl font-bold leading-tight mb-4">Welcome to Invoicy!</h1>
    <p class="text-lg text-gray-300 mb-8">Manage your invoices and bills online!</p>
    <a href="{{ route('login') }}" class="bg-yellow-400 text-gray-900 hover:bg-yellow-300 py-2 px-6 rounded-full text-lg font-semibold transition duration-300 ease-in-out transform hover:scale-105 hover:shadow-lg">Login Now</a>
  </div>
</div>
  
</body>
</html>