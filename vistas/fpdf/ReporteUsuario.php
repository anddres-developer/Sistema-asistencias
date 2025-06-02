<?php
session_start();
if (!isset($_SESSION['validarSesion'])) {
   echo '<script> window.location = "../../login"; </script>';
}

require('./fpdf.php');
include "../../config.php";



class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../../modelo/conexion.php'; //llamamos a la conexion BD

      $consulta_info = $conexion->query(" select *from empresa "); //traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('waves.png', -10, -10, 105); //fondo
      $this->Image('logo.png', 270, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 95, 189); //color
      $this->SetDrawColor(0, 95, 189); //borde color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('DIRECCION DE POLITICA'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 95, 189);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE USUARIOS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(78, 115, 223); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(78, 115, 223); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      //$this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(70, 10, utf8_decode('NOMBRE Y APELLIDO'), 1, 0, 'C', 1);
      $this->Cell(55, 10, utf8_decode('USUARIO'), 1, 0, 'C', 1);
      $this->Cell(90, 10, utf8_decode('CORREO ELECTRONICO'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('ROL'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(540, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}
include '../../modelo/conexion.php';


$pdf = new PDF();
$pdf->AddPage("landspage"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_asistencia = $conexion->query(" select usuarios.nombre, usuarios.apellido, usuarios.usuario, usuarios.email, roles.nom_rol as 'nomRol' from usuarios
inner join roles ON roles.id_roles=usuarios.rol; ");

while ($datos_reporte = $consulta_reporte_asistencia->fetch_object()) {
   $i = $i + 1;
   /* TABLA */
   $pdf->SetFont('Arial', '', 10);
   $pdf->setFillColor(251, 252, 252); //Color de fondo
   $pdf->setTextColor(0, 0, 0); //Color de texto
   // $pdf->Cell(15, 10, utf8_decode($i), 'B', 0, 'C', 1);
   $pdf->Cell(70, 10, utf8_decode($datos_reporte->nombre . " " . $datos_reporte->apellido), 1, 0, 'C', 1);
   $pdf->Cell(55, 10, utf8_decode($datos_reporte->usuario), 1, 0, 'C', 1);
   $pdf->Cell(90, 10, utf8_decode($datos_reporte->email), 1, 0, 'C', 1);
   $pdf->Cell(60, 10, utf8_decode($datos_reporte->nomRol), 1, 1, 'C', 1);
}



$pdf->Output('ReporteUsuarios.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
