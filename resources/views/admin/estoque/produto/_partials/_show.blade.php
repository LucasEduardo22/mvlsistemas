<div class="form-body">
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="_image" class="control-label">
                    @if (!empty($produto->image))
                        <img src="{{ asset('storage/'.$produto->image) }}" alt="{{$produto->image}}" id="_img" style="width: 350px; height: 450px;">
                    @else
                        <img id="_img" style="width: 300px; height: 400px;" src="{{ asset('img/images/mvlsistemas.jpg') }}" alt="mvlsistemas">
                    @endif
                </label>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Produto:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->nome_produto}}</strong></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Modelo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->modelo}}</strong></p>
                    </div>
                </div>
                <div class="row">
                    <label class="col-sm-4 control-label">Sub Grupo:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->subGrupo->nome}}</strong></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Descrição:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->descricao}}</strong></p>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Observção:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$produto->observacao}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <h3>Aviamentos:</h3>
    <div class="row">
        <div class="col-sm-12">
            <table id="people-table" class="col-md-12 table table-striped table-bordered">
                <thead>
                    <tr>
                        <th class="border-top-0" scope="col">Sigla</th>
                        <th class="border-top-0" scope="col">Aviamento</th>
                        <th class="border-top-0" scope="col">detalhes</th>
                        <th class="border-top-0" scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produto->aviamentos as $aviamento)
                        <tr>
                            <td>
                                {{$aviamento->produtosAviamento->sigla}}
                            </td>
                            <td>
                                {{$aviamento->produtosAviamento->nome}}
                            </td>
                            <td>
                                {{$aviamento->detalhes}}
                            </td>
                            <td>
                                <form action="{{route('produto.aviamento.estoque.destroy', [$aviamento->id, $produto->id])}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                                </form>
                            </td>
                        </tr>
                    @endforeach                                            
                </tbody>
            </table>
        </div>
    </div>
</div>