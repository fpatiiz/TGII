<!-- resources/views/layouts/sidebar.blade.php -->
<div class="sidebar fixed top-0 bottom-0 lg:left-0 p-2 w-[300px] overflow-y-auto text-center bg-gray-900">
    <div class="text-gray-100 text-xl">
        <div class="p-2.5 mt-1 flex items-center">
            <i class="px-2 py-1 rounded-md bg-gray-600"> //logo</i>
            <h1 class=" text-gray-200 text-[15px] ml-3">MIE</h1>
        </div>
        <div class="my-2 bg-gray-600 h-[1px]"></div>
    </div>
    <!--<div class="p-2.5 flex items-center rounded-md px-4 duration-300 cursor-pointer bg-gray-700 text-white">
        <i class="bi bi-search text-sm"></i>
        <input type="text" placeholder="Search" class="text-[15px] ml-4 w-full bg-transparent focus:outline-none" />
    </div> -->
    <a href="{{ route('dashboard') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600 text-white">
    <i class="bi bi-house"></i>
    <span class="text-[15px] ml-4 text-gray-200">Home</span>
</a>

<a href="{{ route('dashboard') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600 text-white">
    <i class="bi bi-list-task"></i>
    <span class="text-[15px] ml-4 text-gray-200">Meus Produtos</span>
</a>

<a href="{{ route('dashboard') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600 text-white">
    <i class="bi bi-cart4"></i>
    <span class="text-[15px] ml-4 text-gray-200">Área de Vendas</span>
</a>

<a href="{{ route('dashboard') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600 text-white">
    <i class="bi bi-folder2-open"></i>
    <span class="text-[15px] ml-4 text-gray-200">Relatórios </span>
</a>

<a href="{{ route('dashboard') }}" class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600 text-white">
    <i class="bi bi-currency-dollar"></i>
    <span class="text-[15px] ml-4 text-gray-200">Financeiro</span>
</a>



    <div class="my-4 bg-gray-600 h-[1px]"></div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600 text-white" onclick="dropdown()">
        <i class="bi bi-chat-left-text-fill"></i>
        <div class="flex justify-between w-full items-center">
            <span class="text-[15px] ml-4 text-gray-200 ">Ajuda</span>
            <span class="text-sm rotate-180" id="arrow">
                <i class="bi bi-chevron-right"></i>
            </span>
        </div>
    </div>
    <div class="text-left text-sm mt-2 w-4/5 mx-auto text-gray-200  hidden" id="submenu">
        

    <a href="{{ route('dashboard') }}" >
        <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">Sobre Nós</h1>
        </a>
        <a href="{{ route('dashboard') }}" >
        <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">Fale Conosco</h1>
        </a>
        <a href="{{ route('dashboard') }}" >
        <h1 class="cursor-pointer p-2 hover:bg-gray-600 rounded-md mt-1">Perguntas Frequentes</h1>
        </a>

    </div>
    <div class="p-2.5 mt-3 flex items-center rounded-md px-4 duration-300 cursor-pointer hover:bg-gray-600 text-white">
        <i class="bi bi-box-arrow-in-right"></i>
        <span class="text-[15px] ml-4 text-gray-200 ">Sair</span>
    </div>
</div>
