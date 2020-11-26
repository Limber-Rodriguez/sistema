<?php
ob_start();
session_start();
if (!isset($_SESSION["nombre"])) {
    header("Location: login.html");
}else{
    require 'header.php';
if ($_SESSION['escritorio']==1){
    require_once '../modelos/Consultas.php';
    $consulta = new Consultas();
    $rsptac = $consulta->totalcomprahoy();
    $regc=$rsptac->fetch_object();
    $totalc=$regc->total_compra;

    $rsptav=$consulta->totalventahoy();
    $regv=$rsptav->fetch_object();
    $totalv=$regv->total_venta;

    $compras10 = $consulta->comprasultimos_10dias();
    $fechasc='';
    $totalesc='';
    while ($regfecha = $compra10->fetch_object()) {
        $fechasc=$fechasc.'"'.$regfechac->fecha.'",';
        $totalesc=$totalesc.$regfechac->total.',';
    }

    $fechasc=substr($fechasc,0 -1);
    $totalesc=substr($totalesc,0 -1);

    $ventas12 = $consulta->comprasultimos_10dias();
    $fechasv='';
    $totalesv='';
    while ($regfechav = $ventas12->fetch_object()) {
        $fechasv=$fechasv.'"'.$regfechav->fecha.'",';
        $totalesv=$totalesv.$regfechav->total.',';
    }

    $fechasv=substr($fechasv,0 -1);
    $totalesv=substr($totalesv,0 -1);
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
                        <div class="panel-body" >
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="inner">
                                    <h4 style="fon-size:17px;">
                                        <strong>S/<?php echo $totalc; ?></strong>
                                    </h4>
                                    <p>Compras</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bang"></i>
                                </div>
                                <a href="ingreso.php" class="small-box-footer">Compra <i class="fa fa-arrow-circle-right">
                                </i></a>
                           </div>
                           <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <div class="inner">
                                    <h4 style="fon-size:17px;">
                                        <strong>S/<?php echo $totalc; ?></strong>
                                    </h4>
                                    <p>ventas</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bang"></i>
                                </div>
                                <a href="venta.php" class="small-box-footer">Venta<i class="fa fa-arrow-circle-right">
                                </i></a>
                           </div>
                        </div>
                        <div class="panel-body" >
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header width-border">
                                        Compras de los 10 dias
                                    </div>
                                    <div>
                                        <canvas id="compras" whidth="400" heigth="300"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                <div class="box box-primary">
                                    <div class="box-header width-border">
                                        ventas de los 12 meses
                                    </div>
                                    <div>
                                        <canvas id="ventas" whidth="400" heigth="300"></canvas>
                                    </div>
                                </div>
                            </div>
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
<script type="text/javascript" src="../public/js/Chart.min.js"></script>
<script type="text/javascript" src="../public/js/Chart.bundle.js"></script>
<script type="text/javascript">
<script>
var ctx = document.getElementById('myChart').getContext('2d');
var compras = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasc?>],
        datasets: [{
            label: '# Compras en S/ de los 10 dias',
            data: [<?php echo $totalesc?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
var ctx = document.getElementById('ventas').getContext('2d');
var ventas = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: [<?php echo $fechasv?>],
        datasets: [{
            label: '# Ventas en S/ de los 10 Meses',
            data: [<?php echo $totalesv?>],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});
</script>
</script>
<?php 
}
ob_end_flush();
?>