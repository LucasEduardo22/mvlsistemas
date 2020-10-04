<!-- Modal -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body">
            <div class = "col-md-12">
                <form action="{{route('cliente.search')}}" method="post">
                    @csrf
                    <div class = "row">
                        <div class= "col-md-10">    
                            <input type="text" class="form-control" id="filtrar" value="{{$filtros['filtrar'] ?? ''}}" name="filtrar" placeholder = "pesquisar por"> 
                        </div>
                        <div class= "col-md-2">
                            <button type="submit" class= "btn btn-success btn-block" >Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="table-responsive">
                    {{-- @if ($clientes->count() != 0) --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Código</th>
                                    <th class="border-top-0" scope="col">Nome Fantasia</th>
                                    <th class="border-top-0" scope="col">CNPJ</th>
                                    <th class="border-top-0" scope="col">Telefone</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($clientes as $cliente)
                                    <tr>
                                        <th scope="row">{{$cliente->id}}</th>
                                        <th scope="row">{{$cliente->nome}}</th>
                                        <td class="cpf_cnpj">{{$cliente->cpf_cnpj}}</td>
                                        <td class="telefone" style="width: 180px">{{$cliente->telefone}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $clientes->links()!!}
                            @else
                                {!! $clientes->links()!!}
                            @endif
                        </div>
                   {{--  @else
                        <h1>Ops ainda não foi cadastrado nenhum cliente</h1>
                    @endif --}}
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                <button type="button" class="btn btn-primary">Salvar mudanças</button>
            </div>
        </div>
    </div>
  </div>
</div>