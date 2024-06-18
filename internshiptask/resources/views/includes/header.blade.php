<img id="background" src="../resources/images/background.svg" style="z-index: -1"/>
<div class="navbar justify-content-end pt-4">
   <nav class="navbar-inner justify-content-end">
       <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" aria-current="page" href="{{ route('home') }}">Начало</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('products') ? 'active' : '' }}" aria-current="page" href="{{ route('products') }}">Списък Продукти</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('counterparties') ? 'active' : '' }}" aria-current="page" href="{{ route('counterparties') }}">Списък Контрагенти</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('sales') ? 'active' : '' }}" aria-current="page" href="{{ route('sales') }}">Списък Продажби</a>
            </li>
        </ul>
    </nav>
</div>