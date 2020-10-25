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
            <div class = "col-md-12">
                <form action="{{route('produto.search')}}" method="post">
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
                    {{-- @if ($produtos->count() != 0) --}}
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Modelo</th>
                                    <th class="border-top-0" scope="col">Produto</th>
                                    <th class="border-top-0" scope="col">Sub grupo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produtos as $produto)
                                    <tr>
                                        <td scope="row" data-id="{{$produto->modelo}}" class="modelo_id">{{$produto->modelo}}</td>
                                        <td scope="row" data-nome="{{$produto->nome_produto}}" class="modelo_id">{{$produto->nome_produto}}</td>
                                        <td class="modelo_id" data-sub_grupo_id="{{$produto->sub_grupo_id}}" >{{$produto->subGrupo->nome}}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="card-footer">
                            @if (isset($filtros))
                                {!! $produtos->links()!!}
                            @else
                                {!! $produtos->links()!!}
                            @endif
                        </div>
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