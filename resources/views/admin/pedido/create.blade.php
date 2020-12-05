@extends('layouts.default')
{{-- Page title --}}
@section('title')
    Pedidos @parent
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
            <a href="{{ route('pedido.index') }}">Pedido</a>
        </li>
        <li class="breadcrumb-item active">
            <a href="{{ route('pedido.create') }}">Create</a>
        </li>
    </ol>
    <div class="card border border-secondary">
        <div class="card-body">
            <form action="{{route('pedido.store')}}" class="form-horizontal" method="post" class="form" enctype="multipart/form-data">
                @method('POST')
                @csrf
                @include('admin.pedido._partials.form')
            </form>
        </div>
    </div>
@stop
@push('scripts')
    @include('admin.pedido.script')
@endpush
