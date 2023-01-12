@extends('layout.constructor')

@section('title')
    Konecta - Productos
@endsection

@section('head')
    <x-header title="Productos">
        <button type="button" class="btn btn-info active m-4" onclick="showModalRegistro();">
            Agregar <i class="fal fa-plus-square"></i>
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
            <th>Acciones</th>
        </x-table>
    </x-panel>

    <x-modal-form id="ModalRegistro" title="Registro de Usuarios" text="Los usuarios que crees se limitan a dos roles.">
        <div class="col-md-12 mb-3">
            <lottie-player src="https://assets8.lottiefiles.com/private_files/lf30_wuojlcng.json" background="transparent"
                speed="1" style="width: 20%; margin: auto;" loop autoplay></lottie-player>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="nombre">Nombre de Usuario</label>
            <input type="text" onKeyPress="if(this.value.length==80)return false;" class="form-control" id="nombre"
                name="nombre" placeholder="Nombre del Usuario" minlength="3" maxlength="80" required>
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="correo">Correo Electronico</label>
            <input type="email" onKeyPress="if(this.value.length==200)return false;" class="form-control" id="correo"
                name="correo" placeholder="Correo Electronico">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="password">Contraseña</label>
            <input type="text" onKeyPress="if(this.value.length==50)return false;" class="form-control" id="password"
                name="password" placeholder="Contraseña">
        </div>
        <div class="col-md-6 mb-3">
            <label class="form-label" for="rol">Rol:</label>
            <select class="select2 custom-select form-control" id="rol" name="rol">
            </select>
        </div>
    </x-modal-form>
@endsection

@section('subName')
    Pagina de Productos
@endsection

@include('productos.script')
