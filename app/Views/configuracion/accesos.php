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

<?php 
    // echo '<pre>';
    // print_r($this->data['param']);
    // echo '</pre>';
?>

<?= $footer ?>