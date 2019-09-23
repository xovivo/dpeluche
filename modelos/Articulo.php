<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Articulo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="INSERT INTO productos (id,ruta,titulo,stock,descripcion,portada,estado)
		VALUES ('$idcategoria','$codigo','$nombre','$stock','$descripcion','$imagen','1')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para editar registros
	public function editar($idarticulo,$idcategoria,$codigo,$nombre,$stock,$descripcion,$imagen)
	{
		$sql="UPDATE productos SET id='$idcategoria',ruta='$codigo',titulo='$nombre',stock='$stock',descripcion='$descripcion',portada='$imagen' WHERE id='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para desactivar registros
	public function desactivar($idarticulo)
	{
		$sql="UPDATE productos SET estado='0' WHERE id='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar registros
	public function activar($idarticulo)
	{
		$sql="UPDATE productos SET estado='1' WHERE id='$idarticulo'";
		return ejecutarConsulta($sql);
	}

	//Implementar un método para mostrar los datos de un registro a modificar
	public function mostrar($idarticulo)
	{
		$sql="SELECT * FROM productos WHERE id='$idarticulo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un método para listar los registros
	public function listar()
	{
		$sql="SELECT a.id,a.id_categoria,c.categoria, a.ruta,a.titulo,a.stock,a.descripcion,a.portada,a.estado FROM productos a INNER JOIN categorias c ON a.id_categoria=c.id";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos
	public function listarActivos()
	{
		$sql= "SELECT a.id,a.id_categoria,c.categoria, a.ruta,a.titulo,a.stock,a.descripcion,a.portada,a.estado FROM productos a INNER JOIN categorias c ON a.idcategoria=c.idcategoria WHERE a.condicion='1'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un método para listar los registros activos, su último precio y el stock (vamos a unir con el último registro de la tabla detalle_ingreso)
	public function listarActivosVenta()
	{
		$sql="SELECT a.id,a.id_categoria,c.categotia as categoria,a.ruta,a.titulo,a.stock,(SELECT precio_venta FROM detalle_ingreso WHERE id=a.id order by iddetalle_ingreso desc limit 0,1) as precio_venta,a.descripcion,a.portada,a.estado FROM articulo a INNER JOIN categorias c ON a.id_categoria=c.id WHERE a.estado='1'";
		return ejecutarConsulta($sql);		
	}
}

?>