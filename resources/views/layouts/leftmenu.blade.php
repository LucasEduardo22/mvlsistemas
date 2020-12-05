<div id="menu" class="hasMenu" role="navigation">
    <ul class="navigation list-unstyled" id="demo">
        <li><span class="close-icon d-xl-none d-lg-block"><img src="{{asset('img/images/input-disabled.png')}}"
                    alt="image missing"></span></li>

        <a href="{{ route('home') }}" class="logo navbar-brand mr-0">
            <h1 class="text-center text-light" id="edus">EDUS</h1>
        </a>
        <li {!! (Request::is('') ? 'class="active"' : '' ) !!}>
            <a href="{{ URL::to('') }}">
                <span class="mm-text ">Inicio</span>
                <span class="menu-icon"><i class="im im-icon-Home"></i></span>
            </a>
        </li>
        <li>
            <a href="{{route('pedido.index')}}">
                <span class="mm-text ">Pedidos</span>
                <span class="menu-icon"><i class="fas fa-shopping-cart"></i></span>
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
                    <a href="{{route('materia-prima.index')}}">
                        Matéria Prima
                    </a>
                </li>
                <li>
                    <a href="{{route('cliente.index')}}">
                        Clientes
                    </a>
                </li>
                <li>
                    <a href="{{route('fornecedor.index')}}">
                        Fornecedores
                    </a>
                </li>               
                <li>
                    <a href="{{route('produto.index')}}">
                        Produtos
                    </a>
                </li>
                <li>
                    <a href="{{route('unidade.index')}}">
                        Unidade de medida
                    </a>
                </li>
                <li >
                    <a href="#">
                        <span class="mm-text ">Departamentos</span>
                        
                    </a>
                    <ul class="sub-menu list-unstyled">
                        <li>
                            <a href="{{route('departamento.index')}}">
                                Departamentos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('grupo.index')}}">
                                Grupos
                            </a>
                        </li>
                        <li>
                            <a href="{{route('sub-grupo.index')}}">
                                Sub Grupos
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </li>
        <li>
            <a href="#">
                <span class="mm-text ">Estoque</span>
                <span class="menu-icon"><i class="fas fa-layer-group"></i></span>
                <span class="im im-icon-Arrow-Right imicon"></span>
            </a>
            <ul class="sub-menu list-unstyled">

            </ul>
        </li>
        <li>
            <a href="#">
                <span class="mm-text ">Financeiro</span>
                <span class="menu-icon"><i class="fas fa-coins"></i></span>
                <span class="im im-icon-Arrow-Right imicon"></span>
            </a>
            <ul class="sub-menu list-unstyled">

            </ul>
        </li>
        
        <li>
            <a href="#">
                <span class="mm-text ">Configuração</span>
                <span class="menu-icon "><i class="fas fa-cogs"></i></span>
                <span class="im im-icon-Arrow-Right imicon"></span>
            </a>
            <ul class="sub-menu list-unstyled">
                <li>
                    <a href="{{route('forma-pagamento.index')}}">
                        Forma de pagamento
                    </a>
                </li>
                <li>
                    <a href="{{route('usuario.index')}}">
                        Usuários
                    </a>
                </li>
                <li>
                    <a href="{{route('empresa.index')}}">
                        Dados da empresa
                    </a>
                </li>
                <li>
                    <a href="{{route('grade')}}">
                        Grade
                    </a>
                </li>
                <li>
                    <a href="{{route('status.index')}}">
                        Status
                    </a>
                </li>
                <li>
                    <a href="{{route('tabela-preco.index')}}">
                        Tabela de preço
                    </a>
                </li>
                <li>
                    <a href="{{route('tamanho.index')}}">
                        Tamanho
                    </a>
                </li>
            </ul>
        </li>
        @include("layouts/menu")
    </ul>
</div>
