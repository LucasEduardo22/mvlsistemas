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
            console.log(totalf);
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
                    console.log(data);
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
                    console.log(data.codigo);
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
                    console.log(data);
                    if (data.success == true) {
                        if (data != 0) {
                            $('#modallistaProduto').modal('hide')
                            $('._adicionarProduto').append(
                                "<tr>"+
                                    "<td data-modelo='"+data.modelo+"'>"+data.modelo+'<input value="'+data.id+'" type="hidden" name="produto_id"/>'+"</td>"+
                                    "<td data-nome_produto='"+data.nome_produto+"'>"+data.nome_produto+"</td>"+
                                    "<td data-subGrupo='"+data.sub_grupo['nome']+"'>"+data.sub_grupo['nome']+"</td>"+
                                    "<td>0</td>"+
                                    "<td>R$0,00</td>"+
                                    '<td style="width: 210px">'
                                        +'<button href="" class="btn btn-primary detalhes" data-toggle="modal" >detalhes</button>'
                                        +'<button href="" class="ml-1 btn btn-danger remover"><i class="fas fa-trash"></i></button>'+
                                    '</td>'+
                                "<tr>"
                            );
                            //$(this).closest('table').append(row);
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
                    console.log(data);
                    if (data.success == true) {
                        if (data != 0) {
                            $('._adicionarProduto').append(
                                "<tr>"+
                                    "<td data-modelo='"+data.modelo+"'>"+data.modelo+'<input value="'+data.id+'" type="hidden" name="produto_id"/>'+"</td>"+
                                    "<td data-nome_produto='"+data.nome_produto+"'>"+data.nome_produto+"</td>"+
                                    "<td data-subGrupo='"+data.sub_grupo['nome']+"'>"+data.sub_grupo['nome']+"</td>"+
                                    "<td>0</td>"+
                                    "<td>R$0,00</td>"+
                                    '<td style="width: 210px">'
                                        +'<button href="" class="btn btn-primary detalhes" data-toggle="modal" >detalhes</button>'
                                        +'<button href="" class="ml-1 btn btn-danger remover"><i class="fas fa-trash"></i></button>'+
                                    '</td>'+
                                "<tr>"
                            );
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

            $('#nome_produto').html(nome_produto);
            $('.grupo').html(subgrupo);
            $(".modalProduto").modal('show');
        });
        $("._adicionarProduto").on("click", ".remover", function(e){
            e.preventDefault;
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