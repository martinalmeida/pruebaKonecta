@extends('layout.constructor')

@section('title')
    Konecta - Ventas
@endsection

@section('head')
    <x-header title="Ventas">
        <button type="button" class="btn btn-info active m-4" onclick="showModalRegistro();">
            Agregar Venta <i class="fal fa-plus-square"></i>
        </button>
    </x-header>
@endsection

@section('content')
    <x-panel title="Tabla de Ventas" subTitle="Adminstración de ventas de productos.">
        <x-table id="tablaVentas">
            <th>Id Venta</th>
            <th>Nombre del Producto</th>
            <th>Categoría</th>
            <th>Persona Compradora</th>
            <th>Cantidad Vendida</th>
            <th>Descripción</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th style="width:150px">Acciones de Ventas</th>
        </x-table>
    </x-panel>

    <x-modal-form id="ModalRegistro" title="Registro de Ventas"
        text="Las ventas de productos se descuentan directamente del stock.">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="stockId">Productos en Stock:</label>
            <select class="select2 custom-select form-control" id="stockId" name="stockId">
            </select>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="cantidad">Cantidad a Vender:</label>
            <input type="number" onKeyPress="if(this.value.length==10)return false;" class="form-control" id="cantidad"
                name="cantidad" placeholder="Cantidad a vender al comprador" minlength="1" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="personaVenta">Nombre del Comprador:</label>
            <input type="text" onKeyPress="if(this.value.length==100)return false;" class="form-control"
                id="personaVenta" name="personaVenta" placeholder="Nombre de la persona que compra" minlength="3"
                maxlength="100" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="descripcion">Descripción de la Venta</label>
            <textarea onKeyPress="if(this.value.length==1000)return false;" class="form-control" id="descripcion" name="descripcion"
                rows="5" style="height: 77px;" required></textarea>
        </div>
        <x-input-user></x-input-user>
    </x-modal-form>
@endsection

@section('subName')
    Pagina de Ventas
@endsection

@include('ventas.script')
