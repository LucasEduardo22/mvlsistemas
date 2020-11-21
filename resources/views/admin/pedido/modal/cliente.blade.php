<!-- Modal -->
<div class="modal _modalCliente fade bd-example-modal-xl" tabindex="-1" id="modalCliente" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Clientes</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    {{-- @if ($clientes->count() != 0) --}}
                        <table class="table table-striped" id="_cliente">
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
                                        <td scope="row" data-id="{{$cliente->id}}" class="_selecionar">{{$cliente->id}}</td>
                                        <td scope="row" data-nome="{{$cliente->nome}}" class="_selecionar nome">{{$cliente->nome}}</td>
                                        <td class="cpf_cnpj _selecionar" data-cpf_cnpj="{{$cliente->cpf_cnpj}}" >{{$cliente->cpf_cnpj}}</td>
                                        <td class="telefone _selecionar"data-telefone="{{$cliente->telefone}}"  style="width: 180px">{{$cliente->telefone}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                       
                   {{--  @else
                        <h1>Ops ainda não foi cadastrado nenhum cliente</h1>
                    @endif --}}
                </div>
            </div>
            <div class="modal-footer ">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
  </div>
</div>