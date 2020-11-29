@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Matéria Prima @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- page vendors -->
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">
    <!--end of page vendors -->
@stop
@section('content')
    @include('includes.alert')
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="{{ route('home') }}">Home</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('materia-prima.index') }}">Matéria Prima</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('materia-prima.fornecedor.edit', $materiaPrima->id) }}">Fornernecedor</a>
        </li>
    </ol>
    <div class="card">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <ul class="nav nav-tabs">
                <li class="nav-item">
                  <a class="nav-link" href="#">Matéria Prima</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="">Fornernecedor</a>
                </li>
            </ul>
            <h1 class="mt-2"></h1>
        </section>
        <div class="card-body pt-0">
            <form action="{{route('materia-prima.fornecedor.update', $materiaPrima->id)}}" class="form-horizontal" method="post" class="form">
                @method('POST')
                @csrf
                @include('admin.estoque.materia-prima.fornecedor.form-fornecedor')
            </form>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        $(document).ready(function($){
            $('.tipo_fornecedor').change(function (){
                var nome = $('.tipo_fornecedor option:selected').text();
                var id = $('.tipo_fornecedor option:selected').val();
                $('._fornecedor').append(
                    "<tr>"+
                        "<td data-id='"+id+"'>"+id+'<input value="'+id+'" type="hidden" id="fornecedor_id'+id+'" name="fornecedor_id[]"/>'+"</td>"+
                        "<td data-nome='"+nome+"'>"+nome+"</td>"+
                        '<td><input type="text" class="form-control dinheiro @error("valor_compra") is-invalid @enderror" name="valor_compra[]" id="_valor_compra" value="{{old("valor_compra")}}"></td>'+
                        '<td><input type="text" class="form-control @error("observacao") is-invalid @enderror" name="observacao[]" id="_observacao" value="{{old("observacao")}}"></td>'+
                    "<tr>"
                )
                $('.dinheiro').mask('#.###,00', {reverse: true}); 
            });
        });

    </script>
@endpush