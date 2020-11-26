<?php
ob_start();
session_start();
if (!isset($_SESSION["nombre"])) {
    header("Location: login.html");
}else{
    require 'header.php';
if ($_SESSION['almacen']==1){
?>
    <!--Contenido-->
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-header with-border">
                            <h1 class="box-title">Categoria <button class="btn btn-success" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- centro -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                            <table id="tbllistado" class="table table-striped table-bordered table-condesed table-hover">
                                <thead>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                </thead>

                                <tbody>
                                </tbody>
                                <tfoot>
                                    <th>Opciones</th>
                                    <th>Nombre</th>
                                    <th>Descripcion</th>
                                    <th>Estado</th>
                                </tfoot>
                            </table>
                        </div>
                        <div id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                    <label>Nombre</label>
                                    <input type="hidden" id="idcategoria" name="idcategoria">
                                    <input type="text-area" class="form-control" required id="nombre" name="nombre" placeholder="nombre">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="descripcion">Descripcion</label>
                                    <input type="text-area" class="form-control" required id="descripcion" name="descripcion" placeholder="descripcion">
                                </div>
                                <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <button class="btn btn-primary" type="submit" id="btnGuardar">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    Guardar
                                </button>
                                <button class="btn btn-danger" onclick="cancelarform()" type="button">
                                    <i class="fa fa-arrow-circle-left"></i>
                                    Cancelar
                                </button>
                                </div>
                                </div>
                            </form>
                        </div>
                        <!--Fin centro -->
                    </div>
                    <!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->

    </div>
    <!-- /.content-wrapper -->
    <!--Fin-Contenido-->
<?php 
}else{
    require 'noacceso.php';
}
require_once 'footer.php';
?>
<script type="text/javascript" src="scripts/categoria.js"></script>
<?php 
}
ob_end_flush();
?>