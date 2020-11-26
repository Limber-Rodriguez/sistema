<?php
ob_start();
session_start();
if (!isset($_SESSION["nombre"])) {
    header("Location: login.html");
}else{
  require 'header.php';
  if ($_SESSION['articulo']==1){
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
                            <h1 class="box-title">Categoria <button class="btn btn-success" id="btnagregar" onclick="mostrarform(true)"><i class="fa fa-plus-circle"></i> Agregar</button></h1>
                            <div class="box-tools pull-right">
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <!-- centro -->
                        <div class="panel-body table-responsive" id="listadoregistros">
                        <table id="tbllistado" class="table table-striped table-bordered table-condensed table-hover">
                          <thead>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Código</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </thead>
                          <tbody>                            
                          </tbody>
                          <tfoot>
                            <th>Opciones</th>
                            <th>Nombre</th>
                            <th>Categoría</th>
                            <th>Código</th>
                            <th>Stock</th>
                            <th>Imagen</th>
                            <th>Estado</th>
                          </tfoot>
                        </table>
                    </div>
                        <div id="formularioregistros">
                            <form name="formulario" id="formulario" method="POST">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label>Nombre(*)</label>
                                        <input type="hidden" name="idarticulo" id="idarticulo">
                                        <input type="text" class="form-control selectpicker" data-live-search="true" name="nombre" id="nombre" maxlength="100" placeholder="Nombre" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Categoria(*)</label>
                                        <select name="idcategoria" id="idcategoria" class="form-control" required></select>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label>Stock(*)</label>
                                        <input type="number" class="form-control" name="stock" id="stock" required>
                                    </div>
                                <div class="form-group col-md-6">
                                    <label>Descripcion</label>
                                    <input type="text-area" class="form-control" required id="descripcion" name="descripcion" placeholder="descripcion">
                                </div>
                                <div class="form-group col-md-6">
                                    <label >Imagen</label>
                                    <input type="file" class="form-control" id="imagen" name="imagen">
                                    <input type="hidden" class="form-control" id="imagenactual" name="imagenactual">
                                    <img src="" whidth="150px" height="120px" id="imagenmuestra">
                                </div>
                                <div class="form-group col-md-6">
                                    <label >Codigo</label>
                                    <input type="text" class="form-control" id="codigo" name="codigo" placeholder="Codigo Barras">
                                    <button class="btn btn-success" type="button" onclick="generarbarcode()">Generar</button>
                                    <button class="btn btn-info" type="button" onclick="imprimir()">Imprimir</button>
                                    <div id="print">
                                        <svg id="barcode"></svg>
                                    </div>
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
<script type="text/javascript" src="../public/js/JsBarcode.all.min.js"></script>
<script type="text/javascript" src="../public/js/jquery.PrintArea.js"></script>
<script type="text/javascript" src="scripts/articulo.js"></script>
<?php  
}
ob_end_flush();
?>