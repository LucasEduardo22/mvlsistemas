<script>

    $(document).ready(function($) {

        $('.cpf_cnpj').mask('00.000.000/0000-00');
        $('.cep').mask("99999-999");
        //$('.ie').mask("999.99999-99");
        $('.telefone').mask('(99) 9999-9999');
        $('.celular').mask('(99) 99999-9999');
        $('.sem_tamanho').hide();
        $('.dinheiro').maskMoney({showSymbol:true, symbol:"R$", decimal:",", thousands:"."}); 
        
        $('._nomeValor').keyup(function(){
            var valorUni = []
            var valorUniF = []
            var quatidadetamanho = []
            var valortamanho = []
            var modelo = $('#_modeloId').val()
            var total = 0;
            var totalf = 0;
            var quantidade = 0;
            var valor = 0;
            var totalQuantidade = 0;
            var totalQuantidadef = 0;

            // Loop tamanho masculino
            for (let index = 0; index < $('#totalTamanhoM').val(); index++) {
                var valorM = $('#valorUnitarioM'+index).val();
                var qtdM = $('#qtdM'+index).val();
                totalQuantidade += Number(qtdM);
                if(valorM != "" && qtdM != ""){
                    valorUni.push({quatidadetamanho: qtdM, valortamanho: valorM.replace(/\./g, "").replace(/,/g, ".")})

                }else{
                    valorUni.push({quatidadetamanho: 0, valortamanho: 0})
                }
            }  
            //$('[name="produto_id'+modelo+'"]').push(valorUni);

            /* $('[name="produto_id'+modelo+'"]').each(function () {
                produtoId.push($(this).val());
            });  */

            $(valorUni).each(function (key, value) {
                var qtd = valorUni[key].quatidadetamanho
                var valor = valorUni[key].valortamanho
                if (valor != 0 && qtd != 0) {
                    total += Number(qtd) * Number(valor);
                }
            });

            $(".valorM").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
            $(".totalM").html(totalQuantidade);
            
            // Loop tamanho feminino
            for (let index = 0; index < $('#totalTamanhoF').val(); index++) {
                var valorF = $('#valorUnitarioF'+index).val();
                var qtdF = $('#qtdF'+index).val();
                if(qtdF != ""){
                    totalQuantidadef += Number(qtdF);
                    totalQuantidade += Number(qtdF);
                }
                if(valorF != "" && qtdF != ""){
                    valorUniF.push({quatidadetamanho: qtdF, valortamanho: valorF.replace(/\./g, "").replace(/,/g, ".")})
                }else{
                    valorUniF.push({quatidadetamanho: 0, valortamanho: 0})
                }
            }  
           
            $(valorUniF).each(function (key, value) {
                var qtdf = valorUniF[key].quatidadetamanho
                var valorf = valorUniF[key].valortamanho
                if (valorf != 0 && qtdf != 0) {
                    totalf += Number(qtdf) * Number(valorf);
                    total += totalf;
                }
            });
            //console.log(totalf);
            if (totalf > 0 || totalQuantidadef > 0) {
                $(".valorF").html(totalf.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $('.totalF').html(totalQuantidadef);
            }       
            

            $("#valorTotal").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
            $('#quantidadeTotal').html(totalQuantidade + " Peças");
        })

        //Calcula o valor quanto não estiver tamanho
        $('.sem_tamanho').keyup(function(){
            var qtdSTotal = $('#_quantidadeSemtamanho').val();
            var valorSTotal = $('#_valorSemtamanho').val();
            var totalS = Number(valorSTotal.replace(/\./g, "").replace(/,/g, ".")) * Number(qtdSTotal);

            $('#valor_totalS').html(totalS.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
        })

        $('input[type=radio]').change(function() {
            $('input[type=radio]:checked').not(this).prop('checked', false);
        });

        $('.tipo_pedido').change(function(){
            var tipo_pedido = $(this).val();
            $('[name="tipo_pedido_id"]').val(tipo_pedido)
        })
        

        $('.tipos').change(function(){
            var campo = $(this).val();
            
            if (campo == "T"){
                $('#_tipoMU').html("MASCULINO");	
                $('.tem_tamanho').show();
                $('.femin').show();
                $('.masc').show();
                $('.sem_tamanho').hide();
            }
            else if (campo == "M"){
                $('#_tipoMU').html("MASCULINO");
                $('.tem_tamanho').show();
                $('.femin').hide();
                $('.sem_tamanho').hide();
                $('.masc').show();
            }			
            else if (campo == "U"){
                $('#_tipoMU').html("UNISSEX");
                $('.tem_tamanho').show();
                $('.femin').hide();
                $('.sem_tamanho').hide();
                $('.masc').show();
            }			
            else if (campo == "F"){
                $('.tem_tamanho').show();
                $('.femin').show();
                $('.sem_tamanho').hide();
                $('.masc').hide();
            }else{
                $('.tem_tamanho').hide();
                $('.sem_tamanho').show();
            }			
        });

        //filtra através da tabela cliente
        $(document).on('click', '#_salvar', function(e) {
            e.preventDefault;

            var token = Math.random().toString(16).substr(2);
            var total = 0
            var _modelo = $('#_modeloId').val()
            var valorUni = [];
            var valorUniF = [];
            var valorTotal = [];
            var quantidade = 0;
            var valor = 0;
            var totalQuantidade = 0;
            $('#produto_id'+_modelo).val(token);
  
             // Loop tamanho masculino
            for (let index = 0; index < $('#totalTamanhoM').val(); index++) {
                var valorM = $('#valorUnitarioM'+index).val();
                var qtdM = $('#qtdM'+index).val();
                if(valorM != "" && qtdM != ""){
                    valorUni.push({quatidadetamanho: qtdM, valortamanho: valorM.replace(/\./g, "").replace(/,/g, ".")})
                    totalQuantidade += Number(qtdM);

                }else{
                    valorUni.push({quatidadetamanho: 0, valortamanho: 0})
                }

                $('#valorUnitarioM'+index).val("");
                $('#qtdM'+index).val("");
            }  

            // Loop tamanho feminino
            for (let index = 0; index < $('#totalTamanhoF').val(); index++) {
                var valorF = $('#valorUnitarioF'+index).val();
                var qtdF = $('#qtdF'+index).val();
                if(valorF != "" && qtdF != ""){
                    valorUniF.push({quatidadetamanho: qtdF, valortamanho: valorF.replace(/\./g, "").replace(/,/g, ".")})
                    totalQuantidade += Number(qtdF);
                }else{
                    valorUniF.push({quatidadetamanho: 0, valortamanho: 0})
                }
                $('#valorUnitarioF'+index).val("");
                $('#qtdF'+index).val("");
            }  

            $(valorUni).each(function (key, value) {
                var qtdm = valorUni[key].quatidadetamanho
                var valorm = valorUni[key].valortamanho
                if (valorm != 0 && qtdm != 0) {
                    total += Number(qtdm) * Number(valorm);
                }
            });
            $(valorUniF).each(function (key, value) {
                var qtdf = valorUniF[key].quatidadetamanho
                var valorf = valorUniF[key].valortamanho
                if (valorf != 0 && qtdf != 0) {
                    total += Number(qtdf) * Number(valorf);
                }
            });

            $("#qtd_item"+_modelo).html(totalQuantidade);
            $("#valor_item"+_modelo).html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));

            $('[name="qtd_total'+_modelo+'"]').val(totalQuantidade);
            $('[name="valor_total'+_modelo+'"]').val(total);

         
            //declaro uma var para somar o total tela pedido
            var qtd_total = 0;
            var valor_total = 0;
            //faço um foreach percorrendo todos os inputs com a class soma e faço a soma na var criada acima
            $(".qtd_produto").each(function(){
                qtd_total = qtd_total + Number($(this).val());  
            });

            $(".valor_produto").each(function(){
               valor_total = valor_total + Number($(this).val());  
            });

            console.log(qtd_total);
            //$("#_valor_itens").html(valor_total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
            $('#_qtd_itens').html(qtd_total + " Peças"); 
            $("#_valor_itens").html(valor_total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));

            $.ajax({
                type: 'post',
                url: '{{ route("detalhes.produto") }}',
                dataType: 'json',
                //async: false,
                data: {
                        //detalhes: $('[name="produto_id'+_modelo+'"]').val(),
                        token: token,
                        modelo:$('#_modeloId').val(),
                        cor_principal: $('[name="cor_principal"]').val(),
                        cor_secundaria: $('[name="cor_secundaria"]').val(),
                        cor_terciaria: $('[name="cor_terciaria"]').val(),
                        tecido_principal: $('[name="tecido_principal"]').val(),
                        tecido_secundario: $('[name="tecido_secundario"]').val(),
                        tecido_terciario: $('[name="tecido_terciario"]').val(),
                        quantidadeSemtamanho: $('[name="quantidadeSemtamanho"]').val(),
                        valorSemtamanho: $('[name="valorSemtamanho"]').val(),
                        frente: $('[name="frente"]').val(),
                        costa: $('[name="costa"]').val(),
                        manga_direita: $('[name="manga_direita"]').val(),
                        manga_esquerda: $('[name="manga_esquerda"]').val(),
                        tipo: $('[name="tipo"]').val(),
                        tamanhoM: valorUni,
                        tamanhoF: valorUniF,
                        //alorUnitarioM:$('[name="valorUnitarioM[]"]').val(),
                    },
                
                //contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //var $el = $('[name=estado]');
                    var data = JSON.parse(JSON.stringify(data));
                    var cnpj = data.cpf_cnpj
                    //console.log(data);
                   
                    
                }
            });

            $('[name="cor_principal"]').val('');
            $('[name="cor_secundaria"]').val('');
            $('[name="cor_terciaria"]').val('');
            $('[name="tecido_principal"]').val('');
            $('[name="tecido_secundario"]').val('');
            $('[name="tecido_terciario"]').val('');
            $('[name="quantidadeSemtamanho"]').val('');
            $('[name="valorSemtamanho"]').val('');
            $('[name="frente"]').val('');
            $('[name="costa"]').val('');
            $('[name="manga_direita"]').val('');
            $('[name="manga_esquerda"]').val('');
            $('[name="tipo"]').val('');
            $(".valorM").html("");
            $(".totalM").html("");
            $("#valorTotal").html("");
            $('#quantidadeTotal').html("");
            $(".valorF").html("");
            $('.totalF').html("");
        });
        //filtra através da tabela cliente
        $(document).on('click', '._selecionar', function(e) {
            e.preventDefault;

            var id = $(this).closest('tr').find('td[data-id]').data('id');

            $.ajax({
                type: 'post',
                url: '{{ route("pedido.cliente.searchPedido") }}',
                dataType: 'json',
                beforeSend: function(){
                    loading_show();
                },
                //async: false,
                data: {
                    filtrar: $(this).closest('tr').find('td[data-id]').data('id'),
                    tipo_pedido: $(".tipo_pedido").val(),
                    forma_pagamento_id: $('.forma_pagamento option:selected').val(),
                    codigo: $('[name="codigo"]').val()
                    },
                
                //contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //var $el = $('[name=estado]');
                    var data = JSON.parse(JSON.stringify(data));
                    var cnpj = data.cpf_cnpj
                    //console.log(data);
                   if (data != 0) {
                        $('#modalCliente').modal('hide')
                        $('#nome').html(data.nome);
                        $('#_cpf_cnpj').text(data.cpf_cnpj).mask('00.000.000/0000-00');
                        $('#_telefone').html(data.telefone).mask('(99) 9999-9999');
                        $('#_celular').html(data.celular).mask('(99) 99999-9999');
                        $('#cidade').html(data.cidade);
                        $('#estado').html(data.estado);
                        $('[name="codigo"]').val(data.id);
                        loading_hide();
                        //$('#_codigo').html(data.id);
                    } else {
                        loading_hide();
                        alert("dados não encontrado");

                    }  
                    
                }
            });
        });

        // filtra através do campo filtro
        $(document).on('click', '#search', function(e) {
            var tipo_pedido = $(".forma_pagamento option:selected").val();
            /* var id =  $('[name=filtrar_cliente]').val()*/
           // alert(tipo_pedido); 
            e.preventDefault;           
            $.ajax({
                
                type: 'post',
                url: '{{ route("pedido.cliente.searchPedido") }}',
                dataType: 'json',
                beforeSend: function(){
                    loading_show();
                },
                //async: false,
                data: {
                    filtrar: $('[name=filtrar_cliente]').val(), 
                    tipo_pedido: $(".tipo_pedido").val(),
                    forma_pagamento_id: $('.forma_pagamento option:selected').val(),
                    codigo: $('[name="codigo"]').val()
                },
                //contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //var $el = $('[name=estado]');
                    var data = JSON.parse(JSON.stringify(data));
                    var cnpj = data.cpf_cnpj
                    //console.log(data.codigo);
                    if (data != 0) {
                        $('#modalCliente').modal('hide')
                        $('#nome').html(data.nome);
                        $('#_cpf_cnpj').text(data.cpf_cnpj).mask('00.000.000/0000-00');
                        $('#_telefone').html(data.telefone).mask('(99) 9999-9999');
                        $('#_celular').html(data.celular).mask('(99) 99999-9999');
                        $('#cidade').html(data.cidade);
                        $('#estado').html(data.estado);
                        $('[name="codigo"]').val(data.id);
                        //$('#_codigo').html(data.id);
                        loading_hide();

                    } else {
                        loading_hide();
                        alert("dados não encontrado");
                    }  
                    
                }
            }); 
        }); 

        //filtra através da tabela produto
        $(document).on('click', '.modelo_id', function(e){
            e.preventDefault;
            //console.log(id);

            $.ajax({
                type: 'post',
                url: '{{ route("pedido.produto") }}',
                dataType: 'json',
                beforeSend: function(){
                    loading_show();
                },
                //async: false,
                data: {
                        filtrar: $(this).closest('tr').find('td[data-id]').data('id'), 
                        pedido_id: $('[name="codigo"]').val(), 
                        tipo_pedido: $('[name="tipo_pedido_id"]').val()
                    },
                //contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //var $el = $('[name=estado]');
                    var data = JSON.parse(JSON.stringify(data));
                    //var cnpj = data.cpf_cnpj
                    //console.log(data);
                    if (data.success == true) {
                        if (data != 0) {
                            $('#modallistaProduto').modal('hide')
                            $('._adicionarProduto').append(
                                "<tr>"+
                                    "<td data-modelo='"+data.modelo+"'>"+data.modelo+'<input value="'+data.id+'" type="hidden" name="produto_id"/>'+"</td>"+
                                    "<td data-nome_produto='"+data.nome_produto+"'>"+data.nome_produto+"</td>"+
                                    "<td data-subGrupo='"+data.sub_grupo['nome']+"'>"+data.sub_grupo['nome']+"</td>"+
                                    "<td id='qtd_item"+data.modelo+"'></td>"+
                                    "<td id='valor_item"+data.modelo+"'></td>"+
                                    '<td style="width: 210px">'
                                        +'<button href="" class="btn btn-primary detalhes" data-toggle="modal" >detalhes</button>'
                                        +'<button href="" class="ml-1 btn btn-danger remover"><i class="fas fa-trash"></i></button>'+
                                    '</td>'+
                                "<tr>"
                            );
                            //$(this).closest('table').append(row);
                            $('#itens').append('<input value="" type="hidden" id="produto_id'+data.modelo+'"/>');
                            $('#itens').append('<input type="hidden" class="qtd_produto" name="qtd_total'+data.modelo+'" value="0">');
                            $('#itens').append('<input type="hidden"  class="valor_produto" name="valor_total'+data.modelo+'" value="0">');
                            loading_hide();
                        } 
                    } else {
                        loading_hide();
                        alert(data.message);
                        /* $(".messageBox").removeClass('d-none').html(data.message + 
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                                +'<span aria-hidden="true">&times;</span>'
                                +"</button>"
                                ); */

                        /* setTimeout(function(){
                            $('.messageBox').addClass("d-none");
                        }, 5000); */
                    }
                    
                }
            }); 
        });

        //filtra a através do campo modelo
        $(document).on('click', '#search_modelo', function(e){
            e.preventDefault;
            //console.log(id);
            //var codigo_pedido = $('[name="codigo"]').val();
            $.ajax({
                type: 'post',
                url: '{{ route("pedido.produto") }}',
                dataType: 'json',
                beforeSend: function(){
                    loading_show();
                },
                //async: false,
                data: {
                        filtrar: $('[name=filtrar_modelo]').val(), 
                        pedido_id: $('[name="codigo"]').val(), 
                        tipo_pedido: $('[name="tipo_pedido_id"]').val()
                    },
                //contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //var $el = $('[name=estado]');
                    var data = JSON.parse(JSON.stringify(data));
                    //var cnpj = data.cpf_cnpj
                    //console.log(data);
                    if (data.success == true) {
                        if (data != 0) {
                            $('._adicionarProduto').append(
                                "<tr>"+
                                    "<td data-modelo='"+data.modelo+"'>"+data.modelo+'<input value="'+data.id+'" type="hidden" name="produto_id"/>'+"</td>"+
                                    "<td data-nome_produto='"+data.nome_produto+"'>"+data.nome_produto+"</td>"+
                                    "<td data-subGrupo='"+data.sub_grupo['nome']+"'>"+data.sub_grupo['nome']+"</td>"+
                                    "<td id='qtd_item"+data.modelo+"'></td>"+
                                    "<td id='valor_item"+data.modelo+"'></td>"+
                                    '<td style="width: 210px">'
                                        +'<button href="" class="btn btn-primary detalhes" data-toggle="modal" >detalhes</button>'
                                        + '<input type="hidden"  class="valor_produto" name="valor_total'+data.modelo+'" value="0"> <input type="hidden" class="qtd_produto" name="qtd_total'+data.modelo+'" value="0">'
                                        +'<button href="" class="ml-1 btn btn-danger remover"><i class="fas fa-trash"></i></button>'+
                                    '</td>'+
                                "<tr>"
                            );
                            $('#itens').append('<input value="" type="hidden" id="produto_id'+data.modelo+'"/>');
                            loading_hide();
                            //$(this).closest('table').append(row);
                        } 
                    } else {

                        /* $(".messageBox").removeClass('d-none').html(data.message + 
                                '<button type="button" class="close" data-dismiss="alert" aria-label="Close">'
                                +'<span aria-hidden="true">&times;</span>'
                                +"</button>"
                                ); */
                        loading_hide();
                        alert(data.message);
                        /* setTimeout(function(){
                            $('.messageBox').addClass("d-none");
                        }, 5000); */
                    }
                   
                    
                }
            });
        });

        $("._adicionarProduto").on("click", ".detalhes", function(e){
            e.preventDefault;
            var modelo = $(this).closest('tr').find('td[data-modelo]').data('modelo');
            var nome_produto = $(this).closest('tr').find('td[data-nome_produto]').data('nome_produto');
            var subgrupo = $(this).closest('tr').find('td[data-subgrupo]').data('subgrupo');
            var produtoId = []//$('[name="produto_id'+modelo+'"]').val();
            var token = $('#produto_id'+modelo).val();

            //console.log(token);
            $('#nome_produto').html(nome_produto);
            $('.grupo').html(subgrupo);
            $('#nome_modelo').html(modelo);
            $('#_modeloId').val(modelo);
           if (token != "") {
                $.ajax({
                    type: 'post',
                    url: '{{ route("recuperar.detalhes.produto") }}',
                    dataType: 'json',
                   
                    //async: false,
                    data: {
                            //detalhes: $('[name="produto_id'+_modelo+'"]').val(),
                            token: token,
                        },
                    
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        //var $el = $('[name=estado]');
                        var data = JSON.parse(JSON.stringify(data));
                        //console.log(data);
    
                        if(data.success == true){
                            $('[name="cor_principal"]').val(data.cor_principal);
                            $('[name="cor_secundaria"]').val(data.cor_secundaria);
                            $('[name="cor_terciaria"]').val(data.cor_terciaria);
                            $('[name="tecido_principal"]').val(data.tecido_principal);
                            $('[name="tecido_secundario"]').val(data.tecido_secundario);
                            $('[name="tecido_terciario"]').val(data.tecido_terciario);
                            $('[name="quantidadeSemtamanho"]').val(data.quantidadeSemtamanho);
                            $('[name="valorSemtamanho"]').val(data.valorSemtamanho);
                            $('[name="frente"]').val(data.frente);
                            $('[name="costa"]').val(data.costa);
                            $('[name="manga_direita"]').val(data.manga_direita);
                            $('[name="manga_esquerda"]').val(data.manga_esquerda);
                            $('[name="tipo"]').val(data.tipo);
    
                            var tamanhoF =  data.tamanhoF;
                            var totalQuantidadef = 0;
                            var totalQuantidadeM = 0;
                            var totalQuantidade = 0;
                            var totalf = 0;
                            var totalM = 0;
                            var total = 0;

                            for (let index = 0; index < tamanhoF.length; index++) {
                                const element = tamanhoF[index];
                                if (element.quatidadetamanho != 0) {
                                    $('#valorUnitarioF'+index).val(element.valortamanho.replace(".", ",")); 
                                    $('#qtdF'+index).val(element.quatidadetamanho);
                                    totalQuantidadef += Number(element.quatidadetamanho)
                                    totalf += Number(element.quatidadetamanho) * Number(element.valortamanho);
            
                                }
                            }
    
                            var tamanhoM =  data.tamanhoM;
                            for (let index = 0; index < tamanhoM.length; index++) {
                                const element = tamanhoM[index];
    
                                if (element.quatidadetamanho != 0) {
                                    $('#valorUnitarioM'+index).val(element.valortamanho.replace(".", ",")); 
                                    $('#qtdM'+index).val(element.quatidadetamanho);
                                    totalQuantidadeM += Number(element.quatidadetamanho)
                                    totalM += Number(element.quatidadetamanho) * Number(element.valortamanho);
                                    
                                    
                                }
                            }
                            totalQuantidade = totalQuantidadeM +  totalQuantidadef
                            total = totalM + totalf;

                            $(".valorF").html(totalf.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                            $('.totalF').html(totalQuantidadef);
                            $(".valorM").html(totalM.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                            $(".totalM").html(totalQuantidadeM);
                            $("#valorTotal").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                            $('#quantidadeTotal').html(totalQuantidade + " Peças");
                        }
                       
                        
                    }
                });
            } 

            $(".modalProduto").modal('show');
            
        });
        $("._adicionarProduto").on("click", ".remover", function(e){
            e.preventDefault;
            var modelo = $(this).closest('tr').find('td[data-modelo]').data('modelo');
            var token = $('#produto_id'+modelo).val();

            if (token != "") {
                $.ajax({
                    type: 'post',
                    url: '{{ route("deleta.detalhes.produto") }}',
                    dataType: 'json',
                
                    //async: false,
                    data: {
                            //detalhes: $('[name="produto_id'+_modelo+'"]').val(),
                            token: token,
                        },
                    
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        //var $el = $('[name=estado]');
                        var data = JSON.parse(JSON.stringify(data));
                        //console.log(data);
                        //declaro uma var para somar o total tela pedido
                        var qtd_total = 0;
                        var valor_total = 0;
          
                        if(data.success == true){
                            //faço um foreach percorrendo todos os inputs com a class soma e faço a soma na var criada acima
                            $(".qtd_produto").each(function(){
                                qtd_total = qtd_total + Number($(this).val());  
                            });

                            $(".valor_produto").each(function(){
                                valor_total = valor_total + Number($(this).val());  
                            });
                            alert(data.message);
                            //$("#_valor_itens").html(valor_total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                            $('#_qtd_itens').html(qtd_total + " Peças"); 
                            $("#_valor_itens").html(valor_total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                        }
                    
                        
                    }
                });
            } 
            $(this).closest('tr').remove(); 
        });

        //função para mostrar o loading
        function loading_show(){
            $('#loading').html("<div class='modal-dialog modal-sm'><img src='{{ asset('img/images/loading.gif') }}'/></div>").fadeIn('fast');
        }
        //função para esconder o loading
        function loading_hide(){
            $('#loading').fadeOut('fast');
        }
    });

</script>