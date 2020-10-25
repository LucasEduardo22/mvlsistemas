<!-- Modal -->
<div class="modal fade bd-example-modal-xl modalProduto" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
      <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="TituloModalCentralizado">Produtos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-md-12">
                    <div class="form-row">
                        {{-- <div class="form-group col-md-4">
                            <label for="_modelo" class="pb-0 mb-0">Modelo:</label>
                            <input type="text" name="filtrar_modelo" class="form-control col-md-4 pt-0" id="_modelo" value="{{old("modelo")}}">
                        </div> --}}
                        <div class="form-group col-md-6">
                            <label for="_modelo">Tipo de tamanho:</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input tipos" type="radio" name="tipo" id="tipo" value="T" checked>
                                <label class="form-check-label" for="tipoT">Todos</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input tipos" type="radio" name="tipo" id="tipo" value="M">
                                <label class="form-check-label" for="tipoM">Masculino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input tipos" type="radio" name="tipo" id="tipo" value="F">
                                <label class="form-check-label" for="tipoF">Feminino</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input tipos" type="radio" name="tipo" id="tipo" value="U">
                                <label class="form-check-label" for="tipoF">Unissex</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input tipos" type="radio" name="tipo" id="tipo" value="N">
                                <label class="form-check-label" for="tipoF">Tamanho único</label>
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-5">
                            <p>Produto: <strong id="nome_produto">Nenhum Produto foi selecionado</strong></p>
                        </div>
                        <div class="form-group col-md-4">
                            <p>Sub Grupo: <strong id="subgrupo" class="grupo">Nenhum Produto foi selecionadoe</strong></p>
                        </div>
                        {{-- <div class="form-group col-md-3">
                            <p>Cor Principal: <strong>Azul</strong></p>
                        </div> --}}
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="_cor_principal" class="pb-0 mb-0">
                                Cor Primária:
                            </label>
                            <input value="{{old('cor_principal')}}" type="text" name="cor_principal" class="form-control 
                            @error('cor_principal') is-invalid @enderror" placeholder="Cor Primária" id="_cor_principal">
                            @error('cor_principal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="_cor_secundaria" class="pb-0 mb-0">
                                Cor Secundária:
                            </label>
                            <input value="{{old('cor_secundaria')}}" type="text" name="cor_secundaria" class="form-control 
                            @error('cor_secundaria') is-invalid @enderror" placeholder="Cor Secundária" id="_cor_secundaria">
                            @error('cor_secundaria')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="_cor_terciaria" class="pb-0 mb-0">
                                Cor Terciária:
                            </label>
                            <input value="{{old('cor_terciaria')}}" type="text" name="cor_terciaria" class="form-control 
                            @error('cor_terciaria') is-invalid @enderror" placeholder="Cor Terciária" id="_cor_terciaria">
                            @error('cor_terciaria')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="_tecido_primario" class="pb-0 mb-0">
                                Tecido Primária:
                            </label>
                            <input value="{{old('cor_principal')}}" type="text" name="cor_principal" class="form-control 
                            @error('cor_principal') is-invalid @enderror" placeholder="Tecido Primário" id="_cor_principal">
                            @error('cor_principal')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="_tecido_secundario" class="pb-0 mb-0">
                                Tecido Secundário:
                            </label>
                            <input value="{{old('tecido_secundario')}}" type="text" name="tecido_secundario" class="form-control 
                            @error('tecido_secundario') is-invalid @enderror" placeholder="Tecido Secundário" id="_tecido_secundario">
                            @error('tecido_secundario')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <label for="_tecido" class="pb-0 mb-0">
                                Tecido Terciária:
                            </label>
                            <input value="{{old('tecido')}}" type="text" name="tecido" class="form-control @error('tecido') is-invalid @enderror" placeholder="Tecido Terciário" id="_tecido">
                            @error('tecido')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-row sem_tamanho">
                        <div class="form-group col-md-2 sem_tamanho">
                            <label for="_tecido" class="pb-0 mb-0">
                                Quantidade:
                            </label>
                            <input value="{{old('tecido')}}" type="text" name="tecido" class="form-control @error('tecido') is-invalid @enderror" placeholder="Tipo de tecido" id="_tecido">
                            @error('tecido')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-2 sem_tamanho">
                            <label for="_tecido" class="pb-0 mb-0">
                                Valor Unitario:
                            </label>
                            <input value="{{old('tecido')}}" type="text" name="tecido" class="form-control @error('tecido') is-invalid @enderror" placeholder="Tipo de tecido" id="_tecido">
                            @error('tecido')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-4 sem_tamanho">
                        <p>Valor total: <strong id="valor_total">R$120,20</strong></p>
                    </div>
                    <h3>Serigrafia ou Bordado</h3>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="_frente" class="pb-0 mb-0">
                               Frente:
                            </label>
                            <input value="{{old('frente')}}" type="text" name="frente" class="form-control 
                            @error('frente') is-invalid @enderror" placeholder="Frente" id="_frente">
                            @error('frente')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="_costa" class="pb-0 mb-0">
                                Costa:
                             </label>
                             <input value="{{old('costa')}}" type="text" name="costa" class="form-control 
                             @error('costa') is-invalid @enderror" placeholder="Costa" id="_costa">
                             @error('costa')
                                 <div class="invalid-feedback">
                                     {{ $message }}
                                 </div>
                             @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="_manga_direita" class="pb-0 mb-0">
                                Manga Direita:
                             </label>
                             <input value="{{old('manga_direita')}}" type="text" name="manga_direita" class="form-control 
                             @error('manga_direita') is-invalid @enderror" placeholder="Manga direita" id="_manga_direita">
                             @error('manga_direita')
                                 <div class="invalid-feedback">
                                     {{ $message }}
                                 </div>
                             @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="_manga_esquerda" class="pb-0 mb-0">
                                Manga Esquerda:
                             </label>
                             <input value="{{old('manga_esquerda')}}" type="text" name="manga_esquerda" class="form-control 
                             @error('manga_esquerda') is-invalid @enderror" placeholder="Manga esquerda" id="_manga_esquerda">
                             @error('manga_esquerda')
                                 <div class="invalid-feedback">
                                     {{ $message }}
                                 </div>
                             @enderror
                        </div>
                        {{-- <div class="form-group col-md-3">
                            <p>Cor Principal: <strong>Azul</strong></p>
                        </div> --}}
                    </div>
                    <h3 class="tem_tamanho">Tamanhos</h3>
                    <div class="form-row tem_tamanho">
                        <div class="form-group col-md-5">
                            <p>Quantidade total: <strong id="nome_produto">10 Peças</strong></p>
                        </div>
                        <div class="form-group col-md-4">
                            <p>Valor total: <strong id="nome_produto">R$120,20</strong></p>
                        </div>
                        <div class="form-group col-md-12">
                            <div class="table-responsive masc">
                                <table class="table table-bordered">
                                    <span class="text-dark" id="_tipoMU">MASCULINO</span>
                                    <thead>
                                        <tr>
                                            @foreach ($tamanhos->tamanhoMasculino() as $tamanhoM)
                                                <td>
                                                    {{$tamanhoM->sigla}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            @for ($i = 0; $i < $tamanhos->tamanhoMasculino()->count(); $i++)
                                                <td>
                                                    <input value="{{old('quantidade')}}" type="text" name="quantidadeM[]" class="form-control @error('quantidade') is-invalid @enderror" placeholder="Qtd." id="_quantidade">
                                                </td>
                                            @endfor
                                        </tr>
                                        <tr>
                                            @for ($i = 0; $i < $tamanhos->tamanhoMasculino()->count(); $i++)
                                                <td>
                                                    <input value="{{old('valorUnitarioM')}}" type="text" name="valorUnitarioM[]" class="form-control @error('valorUnitario') is-invalid @enderror" placeholder="Valor Unit." id="_valorUnitario">
                                                </td>
                                            @endfor
                                        </tr>
                                        <tr>
                                            <th scope="row">Total:</th>
                                            <td colspan="2">0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="form-group col-md-12 femin">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <span class="text-dark">FEMININO</span>
                                    <thead>
                                        <tr>
                                            @foreach ($tamanhos->tamanhoFeminino() as $tamanhoF)
                                                <td>
                                                    {{$tamanhoF->sigla}}
                                                </td>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>
                                         <tr>
                                            @for ($i = 0; $i < $tamanhos->tamanhoFeminino()->count(); $i++)
                                                <td>
                                                    <input value="{{old('quantidade')}}" type="text" name="quantidadeF[]" class="form-control @error('quantidade') is-invalid @enderror" placeholder="Qtd." id="_quantidade">
                                                </td>
                                            @endfor
                                        </tr>
                                         <tr>
                                            @for ($i = 0; $i < $tamanhos->tamanhoFeminino()->count(); $i++)
                                                <td>
                                                    <input value="{{old('valorUnitarioF')}}" type="text" name="valorUnitarioF[]" class="form-control @error('valorUnitario') is-invalid @enderror" placeholder="Valor Unit." id="_valorUnitario">
                                                </td>
                                            @endfor
                                        </tr>
                                        <tr>
                                            <th scope="row">Total:</th>
                                            <td colspan="2">0</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>