<div class="form-row mt-0 mb-3">
    <div class="form-group col-md-4 ">
        <label for="_fornecedor_id">Fornecedor</label>
        <div class="input-group">
            <span class="input-group-append">
                <span class="input-group-text">
                    <i class="fas fa-clipboard-check"></i>
                </span>
            </span>
            <select id="_fornecedor_id" name="fornecedor_id" class="form-control tipo_fornecedor @error('fornecedor_id') is-invalid @enderror">
                <option>--Select--</option>
                @foreach ($fornecedors as $fornecedor)
                    <option value="{{ $fornecedor->id }}" @if (old('fornecedor_id') == $fornecedor->id) selected=""
                @endif>{{ $fornecedor->nome }}</option>
                @endforeach
            </select>
            @error('fornecedor_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>
    </div>
</div>
<div class="form-row mt-0 mb-3">
    <div class="form-group col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Fornecedor</th>
                    <th scope="col">Preço compra</th>
                    <th scope="col">Observação</th>
                </tr>
            </thead>
            <tbody class="_fornecedor">
                @if ($materiaPrima->fornecedor->count() > 0)
                    @foreach ($materiaPrima->fornecedor as $materiaPrima)
                        <tr class="_fornecedor_id">
                            <td data-id='{{$materiaPrima->id}}'>{{$materiaPrima->materiaPrimaFornecedor->id}} <a class="float-right mr-2 text-danger remover_id" href="#"><i class="fas fa-trash-alt"></i></a> <input value="{{$materiaPrima->materiaPrimaFornecedor->id}}" type="hidden" id="fornecedor_id{{$materiaPrima->materiaPrimaFornecedor->id}}" name="fornecedor_id[]"/></td>
                            <td data-nome='{{$materiaPrima->materiaPrimaFornecedor->nome}}'>{{$materiaPrima->materiaPrimaFornecedor->nome}}</td>
                            <td><input type="text" class="form-control dinheiro @error("valor_compra") is-invalid @enderror" name="valor_compra[]" id="_valor_compra" value="{{number_format($materiaPrima->valor_compra, 2, ',', '.')}}"></td>
                            <td><input type="text" class="form-control @error("observacao") is-invalid @enderror" name="observacao[]" id="_observacao" value="{{$materiaPrima->observacao}}"></td>
                        <tr>
                    @endforeach                    
                @endif
            </tbody>
        </table>
    </div>
</div>
<button type="submit" class="btn btn-primary">Salvar</button>
