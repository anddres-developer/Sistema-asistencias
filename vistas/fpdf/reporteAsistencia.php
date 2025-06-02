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

      $consulta_info = $conexion->query(" select * from empresa "); //traemos datos de la empresa desde BD
      $dato_info = $consulta_info->fetch_object();
      $this->Image('waves.png', -10, -10, 105); //fondo
      $this->Image('logo.png', 270, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(95); // Movernos a la derecha
      $this->SetTextColor(0, 95, 189); //color
      $this->SetDrawColor(0, 95, 189); //Border color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('DIRECCION DE POLITICA'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color

      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(0, 95, 189);
      $this->Cell(100); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE ASISTENCIAS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(78, 115, 223); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(78, 115, 223); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      // $this->Cell(15, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(80, 10, utf8_decode('EMPLEADO'), 1, 0, 'C', 1);
      $this->Cell(30, 10, utf8_decode('CEDULA '), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('CARGO'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('ENTRADA'), 1, 0, 'C', 1);
      $this->Cell(60, 10, utf8_decode('SALIDA'), 1, 1, 'C', 1);
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
/* CONSULTA INFORMACION DEL HOSPEDAJE */

$pdf = new PDF();
$pdf->AddPage("landscape"); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde
$pdf->SetFillColor(251, 252, 252); //Color de fondo

$consulta_reporte_asistencia = $conexion->query(" select asistencia.entrada,asistencia.salida,empleado.nombre,empleado.apellido,empleado.ci,cargo.nombre as 'nomCargo' from asistencia
inner join empleado ON asistencia.id_empleado=empleado.id_empleado
inner join cargo ON empleado.cargo=cargo.id_cargo ");

while ($datos_reporte = $consulta_reporte_asistencia->fetch_object()) {
   $i = $i + 1;
   $pdf->SetFont('Arial', '', 10);
   $pdf->setFillColor(251, 252, 252); //Color de fondo
   $pdf->setTextColor(0, 0, 0); //Color de texto
   /* TABLA */
   //$pdf->Cell(15, 10, utf8_decode($i), 'B', 0, 'C', 1);
   $pdf->Cell(80, 10, utf8_decode($datos_reporte->nombre . " " . $datos_reporte->apellido), 1, 0, 'C', 1);
   $pdf->Cell(30, 10, utf8_decode($datos_reporte->ci), 1, 0, 'C', 1);
   $pdf->Cell(50, 10, utf8_decode($datos_reporte->nomCargo), 1, 0, 'C', 1);
   $pdf->Cell(60, 10, utf8_decode($datos_reporte->entrada), 1, 0, 'C', 1);
   $pdf->Cell(60, 10, utf8_decode($datos_reporte->salida), 1, 1, 'C', 1);
}


$pdf->Output('Reporte Asistencia.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)