<?php
// Including all required classes
require_once('class/BCGFont.php');
require_once('class/BCGColor.php');
require_once('class/BCGDrawing.php');

$codebar = 'BCGean13'; //该软件支持的所有编码，只需调整$codebar参数即可。

// Including the barcode technology
require_once('class/'.$codebar.'.barcode.php');

// Loading Font
$font = new BCGFont('./class/font/Arial.ttf', 24);

// The arguments are R, G, B for color.
$color_black = new BCGColor(0, 0, 0);
$color_white = new BCGColor(255, 255, 255);

$drawException = null;
try {
    $code = new $codebar();
    $code->setScale(3); // Resolution
    $code->setThickness(23); // Thickness
    $code->setForegroundColor($color_black); // Color of bars
    $code->setBackgroundColor($color_white); // Color of spaces
    $code->setFont($font); // Font (or 0)
    $text = $_REQUEST['cardid']; //条形码将要数据的内容
    $code->parse($text);
} catch(Exception $exception) {
    $drawException = $exception;
}

/* Here is the list of the arguments
- Filename (empty : display on screen)
- Background color */
$drawing = new BCGDrawing('', $color_white);
if($drawException) {
    $drawing->drawException($drawException);
} else {
    $drawing->setBarcode($code);
    $drawing->draw();
}

// Header that says it is an image (remove it if you save the barcode to a file)
header('Content-Type: image/png');

// Draw (or save) the image into PNG format.
$drawing->finish(BCGDrawing::IMG_FORMAT_PNG);
?>