<div id="menu" role="navigation">
    <ul class="navigation list-unstyled" id="demo">
        <li><span class="close-icon d-xl-none d-lg-block"><img src="{{asset('img/images/input-disabled.png')}}"
                    alt="image missing"></span></li>

        <a href="{{ URL::to('index') }}" class="logo navbar-brand mr-0">
            <h1 class="text-center">JOSH</h1>
        </a>
        <li {!! (Request::is('') ? 'class="active"' : '' ) !!}>
            <a href="{{ URL::to('') }}">
                <span class="mm-text ">Dashboard</span>
                <span class="menu-icon"><i class="im im-icon-Home"></i></span>
            </a>
        </li>

        <li >
            <a href="#">
                <span class="mm-text ">Cadastros</span>
                <span class="menu-icon "><i class="fas fa-address-book"></i></span>
                <span class="im im-icon-Arrow-Right imicon"></span>
            </a>
            <ul class="sub-menu list-unstyled">
                <li>
                    <a href="{{route('categoria.index')}}">
                        Categoria
                    </a>
                </li>
                <li>
                    <a href="#">
                        Clientes
                    </a>
                </li>
                <li>
                    <a href="#">
                        Produtos
                    </a>
                </li>
                <li>
                    <a href="{{route('status.index')}}">
                        Status
                    </a>
                </li>
                <li>
                    <a href="{{route('tamanho.index')}}">
                        Tamanho
                    </a>
                </li>
                <li>
                    <a href="{{route('tipo-produto.index')}}">
                        Tipo Produto
                    </a>
                </li>
                <li>
                    <a href="{{route('unidade.index')}}">
                        Unidade de medida
                    </a>
                </li>
            </ul>
        </li>
        @include("layouts/menu")
    </ul>
    <!-- / .navigation -->
</div>
