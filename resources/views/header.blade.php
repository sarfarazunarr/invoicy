<nav class="bg-gray-800 sticky top-0 p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="text-white text-2xl font-bold">Invoicy</a>
        @guest
            <div class="space-x-4">
                <a href="{{ route('login') }}"
                    class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">Login</a>
                <a href="{{ route('register') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium">Register</a>
            </div>
        @else
            <div class="space-x-4">
                <a href="{{ route('invoices') }}"
                    class="text-white hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">Invoices</a>
                <a href="{{ route('invoice.create') }}"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-md text-sm font-medium">Create
                    Invoice</a>
            </div>
            <div>
                <span class="text-white px-3 py-2 rounded-md text-sm font-medium">{{ Auth::user()->name }}</span>
                <form method="GET" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="text-white bg-gray-700 hover:text-gray-300 px-3 py-2 rounded-md text-sm font-medium">Logout</button>
                </form>
            </div>
        @endguest        
    </div>
</nav>