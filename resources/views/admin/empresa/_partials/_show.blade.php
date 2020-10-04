<div class="form-body">
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