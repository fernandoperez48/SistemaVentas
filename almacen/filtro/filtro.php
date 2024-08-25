<div class="card-header" style="background-color:#ffe8cd">
    <h3 class="card-title">Filtros</h3>
    <div class="card-tools">
        <button type="button" class="btn btn-tool" data-card-widget="collapse">
            <i class="fas fa-plus"></i>
        </button>
    </div>
    <!-- /.card-tools -->
</div>
<!-- /.card-header -->
<div class="card-body collapse">


    <div class="card mb-3 col-md-3">
        <div class="card-header" style="background-color:#ffe8cd">
            <h3 class="card-title">Filtros de Precios</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-plus"></i>
                </button>
            </div>
        </div>
        <!-- /.card-header -->
        <div class="card-body collapse show">
            <div class="col-md-12">
                <div class="form-group">
                    <div class="row col-md-12">
                        <div class="col-md-16">
                            <input type="checkbox" id="priceCompra" checked>Compra
                        </div>
                        <div class="col-md-16">
                            <input type="checkbox" id="priceVenta">Venta
                        </div>
                    </div>
                </div>
                <div class="row container-fluid">
                    <div class="form-group col-md-6">
                        <label for="minPrice">Precio mínimo:</label>
                        <input type="number" id="minPrice" class="form-control" placeholder="Precio mínimo">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="maxPrice">Precio máximo:</label>
                        <input type="number" id="maxPrice" class="form-control" placeholder="Precio máximo">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>