<header class="bg-[#011640] h-20 min-h-[80px] max-h-[80px] border-b border-gray-800 flex items-center justify-between px-8 shadow-sm z-20 sticky top-0">
                
    <div class="flex items-center">
        <h1 class="text-xl font-bold text-white tracking-wide">
            @yield('header-title', 'Dashboard') 
        </h1>
    </div>

    <div class="flex items-center gap-6">
        <span class="text-sm font-bold text-[#0554f2] tracking-wide hidden md:block">
            Admin Pusat
        </span>
        
        <form action="#" method="POST"> 
            @csrf 
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white text-xs font-bold px-5 py-2 rounded-lg shadow-md transition">
                Log Out
            </button>
        </form>
    </div>
</header>