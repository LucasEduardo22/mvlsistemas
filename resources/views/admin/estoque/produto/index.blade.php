@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Dashboard @parent
@stop
{{-- page level styles --}}
@section('header_styles')
    <!-- page vendors -->
    <link href="{{ asset('css/pages.css') }}" rel="stylesheet">


    <!--end of page vendors -->
@stop
@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div aria-label="breadcrumb" class="card-breadcrumb">
            <h1>Dashboard</h1>

        </div>
        <div class="separator-breadcrumb border-top"></div>
    </section>
    <!-- /.content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="  bg-white dashboard-col pl-15 pb-15 pt-15">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th class="border-top-0" scope="col">Modelo</th>
                                    <th class="border-top-0" scope="col">Produto</th>
                                    <th class="border-top-0" scope="col">Categoria</th>
                                    <th class="border-top-0" scope="col">Tamanho</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if ($produtos->count() != 0)
                                    @foreach ($produtos as $produto)
                                        <tr>
                                            <th scope="row">{{}}</th>
                                            <td>Vivo</td>
                                            <td>1 mobile</td>

                                            <td>Excellent</td>
                                        </tr>
                                    @endforeach
                                @else
                                    <h1>Ops ainda não foi cadastrado nenhuma produto</h1>
                                @endif
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>
@stop
@section('footer_scripts')
    <!--   page level js ----------->
    <script language="javascript" type="text/javascript" src="{{ asset('vendors/chartjs/js/Chart.js') }}"></script>
    <script src="{{ asset('js/pages/dashboard.js') }}"></script>

    <!-- end of page level js -->
@stop
