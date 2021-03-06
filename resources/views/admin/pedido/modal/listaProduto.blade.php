<!-- Modal -->
<div class="modal fade bd-example-modal-xl" tabindex="-1" id="modallistaProduto" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
          <div class="modal-body">
            <div class="col-md-12">
                <div class="table-responsive">
                    {{-- @if ($produtos->count() != 0) --}}
                        <table class="table table-striped" id="_listaProduto">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Modelo</th>
                                    <th class="border-top-0" scope="col">Produto</th>
                                    <th class="border-top-0" scope="col">Sub grupo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($estoques as $estoque)
                                    <tr>
                                        <td scope="row" data-id="{{$estoque->produto->modelo}}" class="modelo_id">{{$estoque->produto->modelo}}</td>
                                        <td scope="row" data-nome="{{$estoque->produto->nome_produto}}" class="modelo_id">{{$estoque->produto->nome_produto}}</td>
                                        <td class="modelo_id" data-sub_grupo_id="{{$estoque->produto->sub_grupo_id}}" >{{$estoque->produto->subGrupo->nome}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                   {{--  @else
                        <h1>Ops ainda não foi cadastrado nenhum produto</h1>
                    @endif --}}
                </div>
            </div>
            <div class="alert alert-danger d-none messageBox" role="alert">
            </div> 
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
  </div>
</div>