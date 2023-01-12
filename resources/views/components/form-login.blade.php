<form class="form" id="{{ $id ?? 'frm_login' }}">
    @csrf
    <div class="form-group">
        <label class="form-label" for="email">Nombre de Usuario</label>
        <input type="email" onKeyPress="if(this.value.length==100)return false;" min="0"
            class="form-control form-control-lg" id="email" name="email" placeholder="Ingresa tu email" required>
        <div class="invalid-feedback">Falta Correo Electronico.</div>
        <div class="help-block">Escribe tu email</div>
    </div>
    <div class="form-group">
        <label class="form-label" for="password">Contraseña</label>
        <input type="password" onKeyPress="if(this.value.length==100)return false;" min="0"
            class="form-control form-control-lg" id="password" name="password" placeholder="Ingresa tu contraseña"
            required>
        <div class="invalid-feedback">Falta contraseña.</div>
        <div class="help-block">Escribe tu contraseña</div>
    </div>

    <div class="form-group text-left">
    </div>
    <div class="row no-gutters">
        <div class="col-lg-12 pr-lg-1 my-2">
            {{ $slot }}
        </div>
    </div>
</form>
