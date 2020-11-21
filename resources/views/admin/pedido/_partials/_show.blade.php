<div class="form-body">
    <h3></h3>
    <div class="row">
        <div class="col-sm-1">
            <div class="col-sm-6">
                <div class="form-group">
                    <div class="row">
                        <label for="_image" class="control-label">
                            @if (!empty($empresa->image))
                                <img src="{{ asset('storage/'.$empresa->image) }}" alt="{{$empresa->image}}" id="_img" style="width: 150px; height: 150px;">
                            @else
                                <img id="_img" style="width: 150px; height: 150px;" src="{{ asset('img/images/mvlsistemas.jpg') }}" alt="mvlsistemas">
                            @endif
                        </label>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="form-group">
                <div class="col-sm-8">
                    <p class="form-control-static"><strong>{{$empresa->nome}}</strong></p>
                    <p class="form-control-static" id="cpf_cnpj"><strong>{{$empresa->cpf_cnpj}}</strong></p>
                    <p class="form-control-static" ><span id="telefone">{{$empresa->telefone}}</span> | <span id="celular">{{$empresa->celular}}</span></p>
                    <p class="frow" ><span >rua: {{$empresa->endereco}}</span>, <span>{{$empresa->numero}}</span></p>
                    <p class="frow" ><span >bairro: {{$empresa->bairro}}</span> - <span >cidade: {{$empresa->cidade}}</span> - estado: <span>{{$empresa->estado}}</span></p>
                </div>
            </div>
        </div>
    </div>
    <h3>Itens do pedido</h3>
    <div class="row">
        <div class="col-md-6 col-12">
            <div>
                <h5 class="d-inline-block">Border Table</h5>  <span>(Add class <code>.table-bordered)</code></span>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="border-top-0" >#</th>
                                <th class="border-top-0" scope="col">Name</th>
                                <th class="border-top-0" scope="col">Email Address</th>
                                <th class="border-top-0" scope="col">Action</th>
                                <th class="border-top-0" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12">
            <div>
                <h5 class="d-inline-block">Border Table</h5>  <span>(Add class <code>.table-bordered)</code></span>
            </div>
            <div class="">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th class="border-top-0" >#</th>
                                <th class="border-top-0" scope="col">Name</th>
                                <th class="border-top-0" scope="col">Email Address</th>
                                <th class="border-top-0" scope="col">Action</th>
                                <th class="border-top-0" scope="col">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>