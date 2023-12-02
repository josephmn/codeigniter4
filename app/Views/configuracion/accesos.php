<?= $header ?>

<div class="row">
    <div class="col-md-6">
        <div class="card col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                        <button id="btnperfil" type="button" class="btn btn-success btn-block font-weight-bolder"
                            style="color: White;">
                            <i class="fas fa-user-plus mr-2"></i>AGREGAR ACCESOS
                        </button>
                    </div>
                    <input id="perfil" type="hidden" value="<?php echo $this->data['perfil']; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="card card-gray">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-bars mr-2"></i>MENU</h3>
            </div>
            <div class="card-body">
                <table id="example1" class="table cell-border compact hover">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th class="text-center">ORDEN</th>
                            <th class="text-center">MENU</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $this->data['bodymenu'];?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card card-gray">
            <div class="card-header">
                <h3 class="card-title font-weight-bold">
                    <i class="fas fa-caret-down mr-2"></i>SUB-MENU</h3>
            </div>
            <div class="card-body">
                <table id="example2" class="table cell-border compact hover">
                    <thead>
                        <tr class="text-center">
                            <th class="text-center">#</th>
                            <th class="text-center">#</th>
                            <th class="text-center">ORDEN</th>
                            <th class="text-center">MENU</th>
                            <th class="text-center">ESTADO</th>
                            <th class="text-center">#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo $this->data['bodysubmenu'];?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- MODAL AGREGAR ACCESOS-->
<div class="modal fade" id="modal-agregar" data-backdrop="static" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold"><i class="fa-solid fa-user-plus mr-2"></i>CREAR PERFIL</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <i class="fa-solid fa-square-xmark icon-color"></i>
                </button>
            </div>
            <div id="overlay"></div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label font-weight-bolder">Menu:</label>
                        <select id="menu" tabindex="1" class="select2 form-control">
                            <option selected='selected' disabled='disabled' value='0'>-- SELECCIONAR --</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-12">
                        <label class="form-label font-weight-bolder">SubMenu:</label>
                        <select id="submenu" tabindex="2" class="select2 form-control">
                            <option selected='selected' disabled='disabled' value='0'>-- SELECCIONAR --</option>
                        </select>
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

<?= $footer ?>