@extends('layout.constructor')

@section('title')
    Konecta - Productos
@endsection

@section('head')
    <x-header title="Productos">
        <button type="button" class="btn btn-info active m-4" onclick="showModalRegistro();">
            Agregar Producto <i class="fal fa-plus-square"></i>
        </button>
    </x-header>
@endsection

@section('content')
    <x-panel title="Tabla Pruductos" subTitle="Adminstración de productos.">
        <x-table id="tablaProductos">
            <th>Nombre de Producto</th>
            <th>Referencia</th>
            <th>Precio</th>
            <th>Peso</th>
            <th>Categoría</th>
            <th>Stock</th>
            <th>Fecha Creación</th>
            <th>Usuario</th>
            <th>Estado</th>
            <th style="width:150px">Acciones de Producto</th>
        </x-table>
    </x-panel>

    <x-modal-form id="ModalRegistro" title="Registro de Productos"
        text="Los productos son la parte principal del inventario.">
        <div class="col-md-6 mb-3">
            <label class="form-label" for="nombreProducto">Nombre del Producto:</label>
            <input type="text" onKeyPress="if(this.value.length==100)return false;" class="form-control"
                id="nombreProducto" name="nombreProducto" placeholder="Nombre del Producto" minlength="3" maxlength="100"
                required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="referencia">Referencia:</label>
            <input type="text" onKeyPress="if(this.value.length==100)return false;" class="form-control" id="referencia"
                name="referencia" placeholder="Rreferencia del producto" minlength="3" maxlength="100" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="precio">Precio del Prducto:</label>
            <input type="text" onkeypress="return filterFloat(event,this);" class="form-control" id="precio"
                name="precio" placeholder="Precio del producto" minlength="3" maxlength="10" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="peso">Peso del Prducto en gramos:</label>
            <input type="text" onkeypress="return filterFloat(event,this);" class="form-control" id="peso"
                name="peso" placeholder="Precio del producto" minlength="3" maxlength="10" required>
        </div>
        <div class="col-md-12 mb-3">
            <label class="form-label" for="categoriaId">Categoría perteneciente del producto:</label>
            <select class="select2 custom-select form-control" id="categoriaId" name="categoriaId">
            </select>
        </div>
        <x-input-user></x-input-user>
    </x-modal-form>
@endsection

@section('subName')
    Pagina de Productos
@endsection

@include('productos.script')
