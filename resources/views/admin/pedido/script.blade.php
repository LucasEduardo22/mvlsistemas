<script>
    $(document).ready(function($) {
        $('.cpf_cnpj').mask('00.000.000/0000-00');
        $('.cep').mask("99999-999");
        //$('.ie').mask("999.99999-99");
        $('.telefone').mask('(99) 9999-9999');
        $('.celular').mask('(99) 99999-9999');
        $('.sem_tamanho').hide();

        $('input[type=radio]').change(function() {
            $('input[type=radio]:checked').not(this).prop('checked', false);
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
        $(document).on('click', '._selecionar', function(e) {
            e.preventDefault;

            var id = $(this).closest('tr').find('td[data-id]').data('id');

            $.ajax({
                type: 'post',
                url: '{{ route("pedido.cliente.searchPedido") }}',
                dataType: 'json',
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
                        $('[name="codigo"]').val(data.codigo);
                        $('#_codigo').html(data.codigo);
                    } else {
                        alert("dados não encontrado");
                    }  
                    
                }
            });
        });
        $(document).on('click', '#search', function(e) {
            var tipo_pedido = $(".forma_pagamento option:selected").val();
            /* var id =  $('[name=filtrar_cliente]').val()*/
           // alert(tipo_pedido); 
            e.preventDefault;
            $.ajax({
                type: 'post',
                url: '{{ route("pedido.cliente.searchPedido") }}',
                dataType: 'json',
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
                        $('[name="codigo"]').val(data.codigo);
                        $('#_codigo').html(data.codigo);

                    } else {
                        alert("dados não encontrado");
                    }  
                    
                }
            }); 
        }); 
        $(document).on('click', '.modelo_id', function(e){
            e.preventDefault;
            //console.log(id);

            $.ajax({
                type: 'post',
                url: '{{ route("pedido.produto") }}',
                dataType: 'json',
                //async: false,
                data: {filtrar: $(this).closest('tr').find('td[data-id]').data('id')},
                //contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //var $el = $('[name=estado]');
                    var data = JSON.parse(JSON.stringify(data));
                    //var cnpj = data.cpf_cnpj
                    console.log(data);
                    if (data != 0) { 
                        $('#modallistaProduto').modal('hide')
                        $('._adicionarProduto').append(
                            "<tr>"+
                                "<td data-modelo='"+data[0].modelo+"'>"+data[0].modelo+'<input value="'+data[0].id+'" type="hidden" name="produto_id"/>'+"</td>"+
                                "<td data-nome_produto='"+data[0].nome_produto+"'>"+data[0].nome_produto+"</td>"+
                                "<td data-subGrupo='"+data[1]+"'>"+data[1]+"</td>"+
                                "<td>0</td>"+
                                "<td>R$0,00</td>"+
                                '<td style="width: 210px">'
                                    +'<button href="" class="btn btn-primary detalhes" data-toggle="modal" >detalhes</button>'
                                    +'<button href="" class="ml-1 btn btn-danger remover"><i class="fas fa-trash"></i></button>'+
                                '</td>'+
                            "<tr>"
                        );
                        //$(this).closest('table').append(row);
                    } else {
                        alert("dados não encontrado");
                    }  
                    
                }
            }); 
        });
        $(document).on('change', '#_modelo', function(e){
            e.preventDefault;
            //console.log(id);

            $.ajax({
                type: 'post',
                url: '{{ route("pedido.produto") }}',
                dataType: 'json',
                //async: false,
                data: {filtrar: $('[name=filtrar_modelo]').val()},
                //contentType: "application/json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data){
                    //var $el = $('[name=estado]');
                    var data = JSON.parse(JSON.stringify(data));
                    //var cnpj = data.cpf_cnpj
                    console.log(data);
                    if (data != 0) {
                        $('._adicionarProduto').append(
                            "<tr>"+
                                "<td data-modelo='"+data[0].modelo+"'>"+data[0].modelo+'<input value="'+data[0].id+'" type="hidden" name="produto_id"/>'+"</td>"+
                                "<td data-nome_produto='"+data[0].nome_produto+"'>"+data[0].nome_produto+"</td>"+
                                "<td data-subGrupo='"+data[1]+"'>"+data[1]+"</td>"+
                                "<td>0</td>"+
                                "<td>R$0,00</td>"+
                                '<td style="width: 210px">'
                                    +'<button href="" class="btn btn-primary detalhes" data-toggle="modal" >detalhes</button>'
                                    +'<button href="" class="ml-1 btn btn-danger remover"><i class="fas fa-trash"></i></button>'+
                                '</td>'+
                            "<tr>"
                        );
                        //$(this).closest('table').append(row);
                    } else {
                        alert("dados não encontrado");
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
    });

</script>