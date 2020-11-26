<?php 
    require_once '../modelos/Categoria.php';

    $categoria = new Categoria;

    $idcategoria = isset($_POST['idcategoria'])?limpiarCadena($_POST['idcategoria']):"";
    $nombre = isset($_POST['nombre'])?limpiarCadena($_POST['nombre']):"";
    $descripcion = isset($_POST['descripcion'])?limpiarCadena($_POST['descripcion']):"";

    switch ($_GET['op']) {
        case 'guardaryeditar':
            if (empty($idcategoria)) {
                $resp = $categoria->insertar($nombre,$descripcion);
                echo $resp?"Categoria registrada":"Fallo el registro";
            }else{
                $resp = $categoria->editar($idcategoria,$nombre,$descripcion);
                echo $resp?"Se actualizo la categoria":"Fallo la actualizacion";
            }
            break;
        case 'desactivar':
            $rspta = $categoria->desactivar($idcategoria);
            echo $rspta?"categoria Desactivada" : "Categoria no se puede desactivar";
            break;
        case 'activar':
            $resp = $categoria->activar($idcategoria);
            echo $resp?"Categoria Activada" : "No se pudo Activar la Categoria";
            break;
        case 'mostrar':
            $rspta = $categoria->mostrar($idcategoria);
            echo json_encode($rspta);
            break;
        case 'listar':
            $rspta= $categoria->listar();
            $data = Array();
            while ($reg=$rspta->fetch_object()) {
                $data[]=array(
                    "0"=>($reg->condicion)?'<button class="btn btn-warning" onclick=mostrar('.$reg->idcategoria.')><i class="fa fa-pencil"></i>
                    </button><button class="btn btn-danger" onclick=desactivar('.$reg->idcategoria.')><i class="fa fa-close"></i>
                    </button>':'<button class="btn btn-warning" onclick=mostrar('.$reg->idcategoria.')><i class="fa fa-pencil"></i>
                    </button><button class="btn btn-primary" onclick=activar('.$reg->idcategoria.')><i class="fa fa-check"></i>
                    </button>',
                    "1"=>$reg->nombre,
                    "2"=>$reg->descripcion,
                    "3"=>($reg->condicion)?'<span class="label bg-green">Activado</span>':'<span class="label bg-red">Desactivado</span>'
                );
            }
            $result = array(
                "sEcho"=>1,
                "iTotalRecords"=>count($data),
                "iTotalDisplayRecords"=>count($data),
                "aaData"=>$data);
                echo json_encode($result);
            break;
    }
?>