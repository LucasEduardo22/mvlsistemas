<script>
    $(document).ready(function($) {
        $('.select_tecido').select2();

        $('#_cliente').dataTable( {
            "language": {
                    "search": "Pesquisar por nome:",
                    "paginate": {
                        "next": "Próxima",
                        "previous": "Anterior"
                    },
                    "lengthMenu": 
                        "Mostrar <select>" +
                            "<option value='5'>5</option>" +
                            "<option value='10'>10</option>" +
                            "<option value='15'>15</option>" +
                            "<option value='20'>20</option>" +
                        "</select> registro"
                }
            });

        $('#_listaProduto').dataTable( {
            "language": {
                    "search": "Pesquisar por nome:",
                    "paginate": {
                        "next": "Próxima",
                        "previous": "Anterior"
                    },
                    "lengthMenu": 
                        "Mostrar <select>" +
                            "<option value='5'>5</option>" +
                            "<option value='10'>10</option>" +
                            "<option value='15'>15</option>" +
                            "<option value='20'>20</option>" +
                        "</select> registro"
                }
            });
        $('#_cliente_info').remove();
        $('#_listaProduto_info').remove();
        
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
                    valorUni.push({quatidadetamanho: qtdM, valortamanho: valorM})

                }else{
                    valorUni.push({quatidadetamanho: 0, valortamanho: 0})
                }
            } 

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
                    valorUniF.push({quatidadetamanho: qtdF, valortamanho: valorF})
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
            var totalS = Number(valorSTotal) * Number(qtdSTotal);

            $('#valor_totalS').html(totalS.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));  
        })

        $('input[type=radio]').change(function() {
            $('input[type=radio]:checked').not(this).prop('checked', false);
        });

        $('.tipo_pedido').change(function(){
            var tipo_pedido = $(this).val();
            $('[name="tipo_pedido_id"]').val(tipo_pedido)

            if (tipo_pedido == "O") {
                $("#ordem").hide()
            } else {
                $("#ordem").show()
            }
        })

        $('.tipos').change(function(){
            var tipo = $(this).val();
            $('[name="tipo"]').val(tipo)
        })
        
        // Gerador de preço
        $('.preco_custo').change(function (){
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
            var totalQuantidadeM = 0;
            var totalQuantidadef = 0;
            var valor_serigrafia = $('#_valor_serigrafia').val()
            var tecido_principal = $('[name="tecido_principal"] option:selected').data('tecido_principal');
            var tecido_secundario = $('[name="tecido_secundario"] option:selected').data('tecido_secundario');
            var tecido_terciario = $('[name="tecido_terciario"] option:selected').data('tecido_terciario');
            var sem_tamanho = $('[name="sem_tamanho_preco"]').val();
            var preco_tecido = Number(tecido_principal) + Number(tecido_secundario) + Number(tecido_terciario) + Number(valor_serigrafia.replace(/\./g, "").replace(/,/g, "."));

            if(Number(tecido_principal) != 0 ||  Number(tecido_secundario) != 0 || Number(tecido_terciario) != 0){
                var semValorProduto = Number(preco_tecido) + Number(sem_tamanho)
                var ganho = Number($('#ganho').val());
                var semPercentual = (semValorProduto * ganho)/100;
                var semPreco = semPercentual + semValorProduto;
                var qtdSTotal = $('#_quantidadeSemtamanho').val();
                var totalS = Number(qtdSTotal) * Number(semPreco);

                
                // Loop tamanho masculino
                for (let index = 0; index < $('#totalTamanhoM').val(); index++) {
                    var valorM = $('#valorUnitarioM'+index).val();
                    var qtdM = $('#qtdM'+index).val();
                    var tamanho_id = $('#nomeTamanhoM'+index).val()
                    var valortamanho = $('#_tamanho_preco'+Number(tamanho_id)).val();
                    var valorProduto = Number(preco_tecido) + Number(valortamanho)
                    var percentual = (valorProduto * ganho)/100;
                    var preco = percentual + valorProduto;
                
                    $('#valorUnitarioM'+index).val(preco);
                    $('#tamanho'+ Number(tamanho_id)).text(preco.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));

                    totalQuantidadeM += Number(qtdM);
                    totalQuantidade += Number(qtdM);
                    if(qtdM != ""){
                        valorUni.push({quatidadetamanho: qtdM, valortamanho: preco})
                        
                    }else{
                        valorUni.push({quatidadetamanho: 0, valortamanho: 0})
                    }
                }

                for (let index = 0; index < $('#totalTamanhoF').val(); index++) {
                    var valorF = $('#valorUnitarioF'+index).val();
                    var qtdF = $('#qtdF'+index).val();
                    var tamanho_id = $('#nomeTamanhoF'+index).val()
                    var valortamanho = $('#_tamanho_preco'+Number(tamanho_id)).val();
                    var valorProduto = Number(preco_tecido) + Number(valortamanho)
                    var percentual = (valorProduto * ganho)/100;
                    var preco = percentual + valorProduto;
            
                    $('#valorUnitarioF'+index).val(preco);
                    $('#tamanho'+ Number(tamanho_id)).text(preco.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                   
                    if(qtdF != ""){
                        totalQuantidadef += Number(qtdF);
                        totalQuantidade += Number(qtdF);
                    }
                    if(qtdF != ""){
                        valorUniF.push({quatidadetamanho: qtdF, valortamanho: preco})
                    }else{
                        valorUniF.push({quatidadetamanho: 0, valortamanho: 0})
                    }

                }  
                $(valorUni).each(function (key, value) {
                    var qtd = valorUni[key].quatidadetamanho
                    var valor = valorUni[key].valortamanho
                    if (valor != 0 && qtd != 0) {
                        total += Number(qtd) * Number(valor);
                    }
                });

                $(".valorM").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $(".totalM").html(totalQuantidadeM);

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
                
                if(qtdSTotal != ""){
                    $('#valor_totalS').html(totalS.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"})); 
                }
                $('#_valorSemtamanho').val(semPreco);
                $('#_sem_tamanho_preco').text(semPreco.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $("#valorTotal").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                $('#quantidadeTotal').html(totalQuantidade + " Peças");
            }else{
                // Loop tamanho masculino
                for (let index = 0; index < $('#totalTamanhoM').val(); index++) {
                    var valorM = $('#valorUnitarioM'+index).val();
                    var tamanho_id = $('#nomeTamanhoM'+index).val()
                
                    $('#valorUnitarioM'+index).val(0);
                    $('#tamanho'+ Number(tamanho_id)).text("");
                }

                for (let index = 0; index < $('#totalTamanhoF').val(); index++) {
                    var valorF = $('#valorUnitarioF'+index).val();
                    var tamanho_id = $('#nomeTamanhoF'+index).val()

                    $('#valorUnitarioF'+index).val(0);
                    $('#tamanho'+ Number(tamanho_id)).text("");
                }  

                $('#_sem_tamanho_preco').html("");
                $('#valor_totalS').html(""); 
                $("#valorTotal").html("");
                $('#quantidadeTotal').html("");
                $(".valorM").html("");
                $(".totalM").html("");
                $(".valorF").html("");
                $('.totalF').html("");
            }

        });

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

        //Modelo
        $(document).on('click', '#_salvar', function(e) {
            e.preventDefault();

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
            //$('[name="tokenProduto[]"]').append(token);
  
             // Loop tamanho masculino
            for (let index = 0; index < $('#totalTamanhoM').val(); index++) {
                var valorM = $('#valorUnitarioM'+index).val();
                var qtdM = $('#qtdM'+index).val();
                var tamanho_id = $('#nomeTamanhoM'+index).val()
                if(valorM != "" && qtdM != ""){
                    valorUni.push({quatidadetamanho: qtdM, valortamanho: valorM})
                    totalQuantidade += Number(qtdM);

                }else{
                    valorUni.push({quatidadetamanho: 0, valortamanho: valorM})
                }

                $('#valorUnitarioM'+index).val();
                $('#qtdM'+index).val();
                $('#tamanho'+ Number(tamanho_id)).text('');
            }  

            // Loop tamanho feminino
            for (let index = 0; index < $('#totalTamanhoF').val(); index++) {
                var valorF = $('#valorUnitarioF'+index).val();
                var qtdF = $('#qtdF'+index).val();
                var tamanho_id = $('#nomeTamanhoF'+index).val()
                if(valorF != "" && qtdF != ""){
                    valorUniF.push({quatidadetamanho: qtdF, valortamanho: valorF})
                    totalQuantidade += Number(qtdF);
                }else{
                    valorUniF.push({quatidadetamanho: 0, valortamanho: valorF})
                }
                $('#valorUnitarioF'+index).val();
                $('#qtdF'+index).val();
                $('#tamanho'+ Number(tamanho_id)).text('');
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

            if ($('[name="tipo"]').val() == "N") {
                var valorSTotal = $('[name="valorSemtamanho"]').val()
                totalQuantidade = $('[name="quantidadeSemtamanho"]').val();

                total = Number(valorSTotal) * (totalQuantidade);
            }

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
                        tecido_principal:  $('[name="tecido_principal"] option:selected').data('tecido_principal'),
                        tecido_secundario: $('[name="tecido_secundario"] option:selected').data('tecido_secundario'),
                        tecido_terciario:  $('[name="tecido_terciario"] option:selected').data('tecido_terciario'),
                        nome_principal:  $('[name="tecido_principal"] option:selected').text(),
                        nome_secundario: $('[name="tecido_secundario"] option:selected').text(),
                        nome_terciario:  $('[name="tecido_terciario"] option:selected').text(),
                        quantidadeSemtamanho: $('[name="quantidadeSemtamanho"]').val(),
                        valorSemtamanho: $('[name="valorSemtamanho"]').val(),
                        frente: $('[name="frente"]').val(),
                        costa: $('[name="costa"]').val(),
                        valor_serigrafia: $('#_valor_serigrafia').val(),
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
            $('#select2-_tecido_principal-container').text("Selecione");
            $('#select2-_tecido_secundario-container').text("Selecione");
            $('#select2-_tecido_terciario-container').text("Selecione");
            $('#_sem_tamanho_preco').html("");
            $('[name="quantidadeSemtamanho"]').val('');
            $('[name="valorSemtamanho"]').val('');
            $('[name="frente"]').val('');
            $('[name="costa"]').val('');
            $('[name="manga_direita"]').val('');
            $('[name="manga_esquerda"]').val('');
            $('[name="tipo"]').val('T');
            $("#valorTotal").html("");
            $('#quantidadeTotal').html("");
            $(".valorM").html("");
            $(".totalM").html("");
            $(".valorF").html("");
            $('.totalF').html("");
            $('#valor_totalS').html("");
            $('#tipoT').prop("checked", true);
            $('#_tipoMU').html("MASCULINO");	
            $('.tem_tamanho').show();
            $('.femin').show();
            $('.masc').show();
            $('.sem_tamanho').hide();
            $('#_valor_serigrafia').val("")
        });


        //filtra através da tabela cliente
        $(document).on('click', '._selecionar', function(e) {
            e.preventDefault();

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
                        $('[name="cliente_id"]').val(data.id);
                        $('[name="filtrar_cliente"]').val("");
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
            e.preventDefault();           
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
                    if (data.success == true) {
                        if (data != 0) {
                        $('#modalCliente').modal('hide')
                        $('#nome').html(data.nome);
                        $('#_cpf_cnpj').text(data.cpf_cnpj).mask('00.000.000/0000-00');
                        $('#_telefone').html(data.telefone).mask('(99) 9999-9999');
                        $('#_celular').html(data.celular).mask('(99) 99999-9999');
                        $('#cidade').html(data.cidade);
                        $('#estado').html(data.estado);
                        $('[name="codigo"]').val(data.id);
                        $('[name="cliente_id"]').val(data.id);
                        $('[name="filtrar_cliente"]').val("");
                        loading_hide();
                        } else {
                            loading_hide();
                            alert("dados não encontrado");
                        }  
                     } else {
                        loading_hide();
                        alert(data.message);
                     }

                    
                    
                }
            }); 
        }); 

        //filtra através da tabela produto
        $(document).on('click', '.modelo_id', function(e){
            e.preventDefault();
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
                        tipo_pedido: $('[name="tipo_pedido_id"]').val(),
                        forma_pagamento_id: $('[name="forma_pagamento_id"]').val(),
                        tabela_preco_id: $('[name="tabela_preco_id"]').val(),
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
                                        + '<input type="hidden"  class="valor_produto" name="valor_total'+data.modelo+'" value="0"> <input type="hidden" class="qtd_produto" name="qtd_total'+data.modelo+'" value="0">'
                                        +'<button href="" class="ml-1 btn btn-danger remover"><i class="fas fa-trash"></i></button>'+
                                    '</td>'+
                                "<tr>"
                            );
                            $('[name="filtrar_modelo"]').val("");
                            $('#itens').append('<input value="" name="tokenProduto[]" name="tokenProduto[]" class="produto_item" type="hidden" id="produto_id'+data.modelo+'"/>');
                            /* $('#itens').append('<input type="hidden" id="_tokenProduto" name="tokenProduto[]">'); */
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
            e.preventDefault();
            //console.log(id);
            var filtrar = $('[name=filtrar_modelo]').val();
            if(filtrar != ""){
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
                        tipo_pedido: $('[name="tipo_pedido_id"]').val(),
                        forma_pagamento_id: $('[name="forma_pagamento_id"]').val(),
                        tabela_preco_id: $('[name="tabela_preco_id"]').val(),
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
                                        +'<button href="" class="btn btn-primary text-light detalhes" data-toggle="modal" >detalhes</button>'
                                        + '<input type="hidden"  class="valor_produto" name="valor_total'+data.modelo+'" value="0"> <input type="hidden" class="qtd_produto" name="qtd_total'+data.modelo+'" value="0">'
                                        +'<button href="" class="ml-1 btn btn-danger text-light remover"><i class="fas fa-trash"></i></button>'+
                                    '</td>'+
                                "<tr>"
                            );
                            $('#itens').append('<input value="" name="tokenProduto[]" class="produto_item" type="hidden" id="produto_id'+data.modelo+'"/>');
                            /* $('#itens').append('<input type="hidden" id="_tokenProduto" name="tokenProduto[]">'); */
                            $('[name="filtrar_modelo"]').val("");
                            loading_hide();
                            //$(this).closest('table').append(row);
                        } 
                    } else {
                        loading_hide();
                        alert(data.message);
                        /* setTimeout(function(){
                            $('.messageBox').addClass("d-none");
                        }, 5000); */
                    }
                   
                    
                }
            });}
        });

        $("._adicionarProduto").on("click", ".detalhes", function(e){
            e.preventDefault();
            $('#select2-_tecido_principal-container').text("Selecione");
            $('#select2-_tecido_secundario-container').text("Selecione");
            $('#select2-_tecido_terciario-container').text("Selecione");
            $('[name="quantidadeSemtamanho"]').val('');
            $('[name="valorSemtamanho"]').val('');
            $('[name="frente"]').val('');
            $('[name="costa"]').val('');
            $('[name="manga_direita"]').val('');
            $('[name="manga_esquerda"]').val('');
            $('[name="tipo"]').val('T');
            $("#valorTotal").html("");
            $('#quantidadeTotal').html("");
            $(".valorM").html("");
            $(".totalM").html("");
            $(".valorF").html("");
            $('.totalF').html("");
            $('#valor_totalS').html("");
            $('#tipoT').prop("checked", true);
            $('#_tipoMU').html("MASCULINO");	
            $('.tem_tamanho').show();
            $('.femin').show();
            $('.masc').show();
            $('.sem_tamanho').hide();

            var modelo = $(this).closest('tr').find('td[data-modelo]').data('modelo');
            var nome_produto = $(this).closest('tr').find('td[data-nome_produto]').data('nome_produto');
            var subgrupo = $(this).closest('tr').find('td[data-subgrupo]').data('subgrupo');
            var produtoId = []//$('[name="produto_id'+modelo+'"]').val();
            var token = $('#produto_id'+modelo).val();
            var tamanhoM = [];
            var tamanhoF = [];
            $("._tamanhoM").each(function(){
                tamanhoM.push($(this).val());  
            });

            $("._tamanhoF").each(function(){
                tamanhoF.push($(this).val());  
            });
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
                            tamanhoM: tamanhoM,
                            tamanhoF: tamanhoF,
                            modelo: modelo,
                        },
                    
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        //var $el = $('[name=estado]');
                        var data = JSON.parse(JSON.stringify(data));
                        //console.log(data);
                        var tamanhosPreco = data.tamanhosPreco
                        var semTamanhosPreco = data.semTamanhosPreco
                        //console.log(tamanhosPreco);
                        
                        if(data.success == true){
                            for (let index = 0; index < tamanhosPreco.length; index++) {
                                const element = data[index];
                                $("[name='_tamanho"+tamanhosPreco[index].tamanho_id+"']").val(tamanhosPreco[index].preco_venda)
                            }
                            
                            $("[name=sem_tamanho_preco]").val(semTamanhosPreco);

                            $('#_cor_principal').val(data.cor_principal);
                            $('[name="tecido_principal"]').val( $('option:contains("'+data.nome_principal+'")').val() );
                            $('[name="tecido_secundario"]').val( $('option:contains("'+data.nome_secundario+'")').val() );
                            $('[name="tecido_terciario"]').val( $('option:contains("'+data.nome_terciario+'")').val() );
                            $('#select2-_tecido_principal-container').text(data.nome_principal);
                            $('#select2-_tecido_secundario-container').text(data.nome_secundario);
                            $('#select2-_tecido_terciario-container').text(data.nome_terciario);
                            $('[name="quantidadeSemtamanho"]').val(data.quantidadeSemtamanho);
                            $('[name="valorSemtamanho"]').val(data.valorSemtamanho.replace(".", ","));
                            $('[name="frente"]').val(data.frente);
                            $('[name="costa"]').val(data.costa);
                            $('[name="manga_direita"]').val(data.manga_direita);
                            $('[name="manga_esquerda"]').val(data.manga_esquerda);
                            $('[name="tipo"]').val(data.tipo);

                            var tamanhoF =  data.tamanhoF;
                            var valor_serigrafia =  data.valor_serigrafia;
                            var totalQuantidadef = 0;
                            var totalQuantidadeM = 0;
                            var totalQuantidade = 0;
                            var totalf = 0;
                            var totalM = 0;
                            var total = 0;
                            var totalS = 0
                            var valorSemtamanho = Number(data.valorSemtamanho);
                            var quantidadeSemtamanho = data.quantidadeSemtamanho;
                            if (data.tipo != "N") {
                                for (let index = 0; index < tamanhoF.length; index++) {
                                    const element = tamanhoF[index];
                                    var tamanho_id = $('#nomeTamanhoF'+index).val();
                                    var valor = Number(element.valortamanho);
                                    if (element.quatidadetamanho != 0) {
                                        $('#valorUnitarioF'+index).val(element.valortamanho); 
                                        $('#qtdF'+index).val(element.quatidadetamanho);
                                        totalQuantidadef += Number(element.quatidadetamanho)
                                        totalf += Number(element.quatidadetamanho) * Number(element.valortamanho);
                                    }
                                    $('#tamanho'+ Number(tamanho_id)).text(valor.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                                }
                                var tamanhoM =  data.tamanhoM;
                                for (let index = 0; index < tamanhoM.length; index++) {
                                    const element = tamanhoM[index];
                                    var tamanho_id = $('#nomeTamanhoM'+index).val();
                                    var valor = Number(element.valortamanho);
                                    if (element.quatidadetamanho != 0) {
                                        $('#valorUnitarioM'+index).val(element.valortamanho); 
                                        $('#qtdM'+index).val(element.quatidadetamanho);
                                        totalQuantidadeM += Number(element.quatidadetamanho)
                                        totalM += Number(element.quatidadetamanho) * Number(element.valortamanho);
                                    }
                                    $('#tamanho'+ Number(tamanho_id)).text(valor.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                                }
                            } else {
                                totalS = valorSemtamanho * Number(quantidadeSemtamanho);
                            }

                            if (data.tipo == "N") {
                                $('#tipoN').prop("checked", true);
                                $('.tem_tamanho').hide();
                                $('.sem_tamanho').show();
                            }else if (data.tipo == "T") {
                                $('#tipoT').prop("checked", true);
                                $('#_tipoMU').html("MASCULINO");	
                                $('.tem_tamanho').show();
                                $('.femin').show();
                                $('.masc').show();
                                $('.sem_tamanho').hide();
                            }else if (data.tipo == "M") {
                                $('#tipoM').prop("checked", true);
                                $('#_tipoMU').html("MASCULINO");
                                $('.tem_tamanho').show();
                                $('.femin').hide();
                                $('.sem_tamanho').hide();
                                $('.masc').show();
                            }else if (data.tipo == "F") {
                                $('#tipoF').prop("checked", true);
                                $('.tem_tamanho').show();
                                $('.femin').show();
                                $('.sem_tamanho').hide();
                                $('.masc').hide();
                            }else if (data.tipo == "U") {
                                $('#tipoU').prop("checked", true);
                                $('#_tipoMU').html("UNISSEX");
                                $('.tem_tamanho').show();
                                $('.femin').hide();
                                $('.sem_tamanho').hide();
                                $('.masc').show();
                            }

                            
                            if (totalQuantidadeM != 0 || totalQuantidadef != 0 || total != 0 || totalS != 0) {
                                totalQuantidade = totalQuantidadeM +  totalQuantidadef
                                total = totalM + totalf;
                                $(".valorF").html(totalf.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                                $('.totalF').html(totalQuantidadef);
                                $(".valorM").html(totalM.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                                $(".totalM").html(totalQuantidadeM);   
                                $('#_valor_serigrafia').val(valor_serigrafia);                                   
                                $("#valorTotal").html(total.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                                $('#quantidadeTotal').html(totalQuantidade + " Peças");
                                $('#_sem_tamanho_preco').text(valorSemtamanho.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                                $('#valor_totalS').html(totalS.toLocaleString("pt-BR", { style: "currency" , currency:"BRL"}));
                            }
                        }
                        
                    }
                });
            }else{
                $.ajax({
                    type: 'post',
                    url: '{{ route("recuperar.detalhes.produto") }}',
                    dataType: 'json',
                   
                    //async: false,
                    data: {
                            //detalhes: $('[name="produto_id'+_modelo+'"]').val(),
                            token: token,
                            modelo: modelo,
                        },
                    
                    //contentType: "application/json",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data){
                        //var $el = $('[name=estado]');
                        var data = JSON.parse(JSON.stringify(data));
                        var tamanhosPreco = data.tamanhosPreco
                        var semTamanhosPreco = data.semTamanhosPreco
                        //console.log(tamanhosPreco);
                        
                        if(data.success == true){
                            for (let index = 0; index < tamanhosPreco.length; index++) {
                                const element = data[index];
                                $("[name='_tamanho"+tamanhosPreco[index].tamanho_id+"']").val(tamanhosPreco[index].preco_venda)
                            }
                            $("[name=sem_tamanho_preco]").val(semTamanhosPreco);
                        }
                        
                    }
                });
            } 

            $(".modaleditProduto").modal('show');
            
        });

        $("._adicionarProduto").on("click", ".remover", function(e){
            e.preventDefault();
            var modelo = $(this).closest('tr').find('td[data-modelo]').data('modelo');
            var token = $('#produto_id'+modelo).val();
            $('#item'+modelo).val("S");

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
            $('#produto_id'+modelo).remove();
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