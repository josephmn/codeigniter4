<?= $header ?>

<div class="row">
    <section class="col-lg-12">
        <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                        <button id="btnperfil" type="button" class="btn btn-success btn-block font-weight-bolder"
                            style="color: White;">
                            <i class="fas fa-user-plus mr-2"></i>CREAR PERFIL
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-8">
            <div class="card-body">
                <div class="row">

                    <div class="col-md-12 col-12">
                        <table id="example1" class="table cell-border compact hover">
                            <!-- class="table table-bordered compact" display -->
                            <thead>
                                <?php echo $this->data['headperfiles'];?>
                            </thead>
                            <tbody>
                                <?php echo $this->data['bodyperfiles'];?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </section>
</div>

<!-- MODAL AGREGAR PERFIL-->
<div class="modal fade" id="modal-agregar" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"><i class="fa-solid fa-user-plus mr-2"></i>CREAR PERFIL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-square-xmark icon-color"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label font-weight-bolder">Nombre:</label>
                        <input type="text" id="nombre" tabindex="1" class="form-control" placeholder="ingrese un nombre"
                            autocomplete="off" />
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnguardar" type="button" class="btn btn-success col-md-4"><i
                        class="fas fa-save mr-2"></i>Guardar</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDITAR DATO-->
<div class="modal fade" id="modal-editar" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"><i class="fas fa-edit mr-2"></i>ACTUALIZAR PERFIL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-square-xmark icon-color"></i>
                </button>
            </div>
            <div id="overlay"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label font-weight-bolder">Códgo:</label>
                        <input type="text" id="codigox" class="form-control" autocomplete="off" readonly />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label font-weight-bolder">Nombre:</label>
                        <input type="text" id="nombrex" tabindex="1" class="form-control" autocomplete="off" />
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label font-weight-bolder">Estado:</label>
                        <select id="estadox" tabindex="2" class="form-control form-control-md">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button id="btnguardarx" type="button" class="btn btn-success col-md-4"><i
                        class="fas fa-save mr-2"></i>Guardar</button>
            </div>
        </div>
    </div>
</div>

<?php 

    // echo '<pre>';

    // print_r($this->data['perfiles']);
    
    // echo '</pre>';

?>

<?= $footer ?>