@extends('layout.constructor')

@section('title')
    Konecta - Stock
@endsection

@section('head')
    <x-header title="Stock de Productos">
    </x-header>
@endsection

@section('content')
    <x-panel title="Tabla Stock" subTitle="Adminstración Stock de Productos.">
        <x-table id="tablaStock">
            <th>Nombre de Producto</th>
            <th>Categoria de Producto</th>
            <th>Usuario</th>
            <th>Cantidad Inicial</th>
            <th>Cantidad Vendida</th>
            <th>Cantidad Disponible</th>
            <th style="width:150px">Acciones de Stock</th>
        </x-table>
    </x-panel>

    <x-modal-form id="ModalRegistro" title="Editar Stock de Productos"
        text="el stock es la cantidad de productos que existen en el inventario">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="categoriaId">Producto de Inventario:</label>
            <select class="select2 custom-select form-control" id="productoId" name="productoId">
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="cantidad">Cantidad:</label>
            <input type="number" onKeyPress="if(this.value.length==10)return false;" class="form-control" id="cantidad"
                name="cantidad" placeholder="Cantidad del Producto" minlength="3" maxlength="100" required>
        </div>
        <x-input-user></x-input-user>
    </x-modal-form>
@endsection

@section('subName')
    Pagina de Stock de Productos
@endsection

@include('stock.script')
