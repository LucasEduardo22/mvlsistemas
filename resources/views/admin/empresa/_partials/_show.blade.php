<div class="form-body">
    <h1 class="mt-2"><a href="{{route('empresa.edit', $empresa->id)}}" class="btn btn-info float-right"><i class="fas fa-plus-square"></i> Editar</a></h1>
    <h3>Dados do empresa</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">empresa:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->nome}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Razão Social:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->razao_social}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Email:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->email}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">CNPJ:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="cpf_cnpj"><strong>{{$empresa->cpf_cnpj}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">I.E:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="ie"><strong>{{$empresa->ie}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Telefone:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="telefone"><strong>{{$empresa->telefone}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Celular:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="celular"><strong>{{$empresa->celular}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label for="_image" class="control-label">
                        @if (!empty($empresa->image))
                            <img src="{{ asset('storage/'.$empresa->image) }}" alt="{{$empresa->image}}" id="_img" style="width: 150px; height: 150px;">
                        @else
                            <img id="_img" style="width: 300px; height: 400px;" src="{{ asset('img/images/mvlsistemas.jpg') }}" alt="mvlsistemas">
                        @endif
                    </label>
                </div>
            </div>
        </div>
    </div>
    <h3>Endereço</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Endereço:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->endereco}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Nº:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->numero}}</strong></p>
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Estado:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->estado}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Cidade:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->cidade}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
    <div class="col-sm-6">
        <div class="form-group">
            <div class="row"> <label class="col-sm-4 control-label">CEP:</label>
                <div class="col-sm-8">
                    <p class="form-control-static" id="cep"><strong>{{$empresa->cep}}</strong></p>
                </div>
            </div>
        </div>
    </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Complemento:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$empresa->complemento}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>