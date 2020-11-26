<?php 
    require_once '../config/conexion.php';

    class Categoria{
        public function __construct(){}
        public function comprasfecha($fecha_inicio,$fecha_fin){
            $sql = "SELECT DATE(i.fecha_hora) as fecha,u.nombre as usuario, p.nombre as proveedor,i.tipo_comprobante, 
            i.serie_comprobante,i.num_comprobante,i.total_compra,i.impuesto,i.estado 
            FROM ingreso i INNER JOIN persona p ON i.idproveedor=p.idpersona INNER JOIN usuario u ON i.idusuario=u.idusuario WHERE DATE(i.fecha_hora)>='$fecha_inicio'
            AND DATE(i.fecha_hora)<='$fecha_fin'";
            return ejecutarConsulta($sql);
        }
        public function totalcomprahoy(){
            $sql = "SELECT IFNULL (SUM(total_compra),0) as total_compra FROM ingreso
            WHERE date(fecha_hora)=curdate()";
            return ejecutarConsulta($sql);
        }
        public function totalcomprahoy(){
            $sql = "SELECT IFNULL (SUM(total_venta),0) as total_venta FROM venta
            WHERE date(fecha_hora)=curdate()";
            return ejecutarConsulta($sql);
        }
        public function comprasultimos_10dias(){
            $sql="SELECT CONCAT(DAY(fecha_hora),'-',MONTH(fecha_hora)) as fecha,SUM(total_compra)
                as total FROM ingreso GROUP by fecha_hora ORDER BY fecha_hora DESC limit 0,10";
                return ejecutaConsulta($sql);
        }
        public function ventasultimos_12meses(){
            $sql = "SELECT DATE_FORMAT(fecha_hora,'%M') as fecha,sum(Total_venta) as total FROM 
                    venta GROUP BY MONTH(fecha_hora)ORDER BY fecha_hora DESC limit 0,12"
        }
    }
?>