<div class="col-lg-{{ $lg ?? '12' }} col-xl-{{ $xl ?? '12' }} order-lg-1 order-xl-1">
    <div class="card mb-g rounded-top">
        <div class="card-body">
            <div class="row no-gutters row-grid">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
