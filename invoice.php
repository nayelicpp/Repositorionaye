<?php
session_start();
require('fpdf/fpdf.php');

if(!isset($_SESSION['invoice'])){
    die("No invoice data.");
}

$data = $_SESSION['invoice'];

$pdf = new FPDF();
$pdf->AddPage();

// 🎨 HEADER
$pdf->SetFillColor(15, 23, 42);
$pdf->Rect(0, 0, 210, 35, 'F');

// 🏢 EMPRESA
$pdf->SetTextColor(255,255,255);
$pdf->SetFont('Arial','B',18);
$pdf->SetXY(10,10);
$pdf->Cell(0,10,'WYDN Robotic Labs',0,1);

// 🧾 FACTURA
$pdf->SetFont('Arial','',12);
$pdf->SetXY(10,20);
$pdf->Cell(0,10,'Factura #'.$data['order_id'],0,1);

// RESET COLOR
$pdf->SetTextColor(0,0,0);

// 📅 INFO
$pdf->SetXY(10,40);
$pdf->SetFont('Arial','',10);
$pdf->Cell(100,8,'Fecha: '.date("d/m/Y"),0,0);
$pdf->Cell(0,8,'Hora: '.date("H:i"),0,1);

// 🧍 CLIENTE
$pdf->SetFillColor(240,240,240);
$pdf->Rect(10,55,190,40,'F');

$pdf->SetXY(15,60);
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,8,'Datos del Cliente',0,1);

$pdf->SetFont('Arial','',11);
$pdf->SetX(15);
$pdf->Cell(0,6,'Nombre: '.$data['fullname'],0,1);
$pdf->SetX(15);
$pdf->Cell(0,6,'Direccion: '.$data['address'],0,1);
$pdf->SetX(15);
$pdf->Cell(0,6,'Ciudad: '.$data['city'],0,1);
$pdf->SetX(15);
$pdf->Cell(0,6,'Telefono: '.$data['phone'],0,1);

// 📦 TABLA PRODUCTOS
$pdf->SetY(105);
$pdf->SetFont('Arial','B',12);

$pdf->Cell(90,10,'Producto',1);
$pdf->Cell(30,10,'Precio',1);
$pdf->Cell(20,10,'Cant.',1);
$pdf->Cell(50,10,'Total',1);
$pdf->Ln();

$pdf->SetFont('Arial','',11);

foreach($data['items'] as $item){
    $totalItem = $item['price'] * $item['qty'];

    $pdf->Cell(90,10,$item['name'],1);
    $pdf->Cell(30,10,'$'.$item['price'],1);
    $pdf->Cell(20,10,$item['qty'],1);
    $pdf->Cell(50,10,'$'.number_format($totalItem,2),1);
    $pdf->Ln();
}

// 💰 TOTALES
$pdf->Ln(5);

$pdf->SetFont('Arial','',11);
$pdf->Cell(140,8,'Subtotal',0);
$pdf->Cell(50,8,'$'.$data['subtotal'],0,1,'R');

$pdf->Cell(140,8,'Descuento',0);
$pdf->Cell(50,8,'-$'.$data['discount'],0,1,'R');

$pdf->SetFont('Arial','B',13);
$pdf->Cell(140,10,'Total Pagado',0);
$pdf->Cell(50,10,'$'.$data['total'],0,1,'R');

// 📝 FOOTER
$pdf->SetY(260);
$pdf->SetFont('Arial','I',10);
$pdf->SetTextColor(120,120,120);
$pdf->Cell(0,10,'Gracias por su compra - WYDN Robotic Labs',0,1,'C');

// 📥 DESCARGA
$pdf->Output('D', 'Factura_'.$data['order_id'].'.pdf');
exit();

$pdf->Image('logo.png', 160, 5, 40);