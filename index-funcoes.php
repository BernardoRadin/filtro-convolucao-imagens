<?php

// phpinfo();

// die();

$imagePath = 'C:/wamp64/www/filtro-convolucao/imagens-para-teste/Taj_Mahal_N-UP-A28-a.jpg';

$image = new Imagick($imagePath);

$kernel = [
    [0, 0, 0, 0, 0],
    [0, 0, -1, 0, 0],
    [0, -1, 5, -1, 0],
    [0, 0, -1, 0, 0],
    [0, 0, 0, 0, 0]
];

$imagickKernel = \ImagickKernel::fromMatrix($kernel);

$image->convolveImage($imagickKernel);

// Define o cabeçalho da imagem
header('Content-type: image/jpeg');
echo $image;
?>
