<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
<?php
/*

$fileName = "Formulario de Prestamos de Equipo.xml";
$xml = simplexml_load_file($fileName);
print_r($xml);



echo "<br>";
echo "<br>";
echo "<br>";
*/
$suppress_localhost=false;

$fecha_de_entraga = "2016-01-01";
$fecha_de_devolucion = "2016-01-02";
$descripcion = "desc";
$marca = "marca";
$modelo = "modelo";
$serie = "seri";
$placa = "placa";








include 'Classes/PHPExcel.php';
$fileType = 'Excel5';
$fileName = "Formulario de Prestamos de Equipo.xls";

// Read the file
$objReader = PHPExcel_IOFactory::createReader($fileType);
$objPHPExcel = $objReader->load($fileName);

// Change the file

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('D11', $fecha_de_entraga)
            ->setCellValue('D13', $fecha_de_devolucion)
->setCellValue('C18', $descripcion)
->setCellValue('C20', $marca)
->setCellValue('C22', $modelo)
->setCellValue('C24', $serie);
$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, $fileType);
ob_end_clean();
$objWriter->save($fileName);
exit;




?>

adfasdfas

    </body>
</html>
