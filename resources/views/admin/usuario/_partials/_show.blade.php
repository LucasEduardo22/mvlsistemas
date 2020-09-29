<div class="form-body">
    <h3>Dados do Cliente</h3>
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Cliente:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$cliente->nome}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Razão Social:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$cliente->razao_social}}</strong></p>
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
                        <p class="form-control-static"><strong>{{$cliente->email}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">CNPJ:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="cpf_cnpj"><strong>{{$cliente->cpf_cnpj}}</strong></p>
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
                        <p class="form-control-static" id="ie"><strong>{{$cliente->ie}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Telefone:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="telefone"><strong>{{$cliente->telefone}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Celular:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static" id="celular"><strong>{{$cliente->celular}}</strong></p>
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
                        <p class="form-control-static"><strong>{{$cliente->endereco}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Nº:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$cliente->numero}}</strong></p>
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
                        <p class="form-control-static"><strong>{{$cliente->estado}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Cidade:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$cliente->cidade}}</strong></p>
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
                    <p class="form-control-static" id="cep"><strong>{{$cliente->cep}}</strong></p>
                </div>
            </div>
        </div>
    </div>
        <div class="col-sm-6">
            <div class="form-group">
                <div class="row">
                    <label class="col-sm-4 control-label">Complemento:</label>
                    <div class="col-sm-8">
                        <p class="form-control-static"><strong>{{$cliente->complemento}}</strong></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>