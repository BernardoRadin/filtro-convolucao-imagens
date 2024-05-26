<?php

$matriz = array();

$inputarray = $_POST['matriz'];

$tamanho = $_POST['tamanho'];

$contlateral = 0;

for ($i = 0; $i < $tamanho; $i++) {
    $row = array();
    for ($j = 0; $j < $tamanho; $j++) {
        $row[] = $inputarray[$contlateral];
        $contlateral++;
    }
    $matriz[] = $row;
}

$arquivo = $_FILES['arquivo'];
$tipo = $_FILES['arquivo']['type'];

$conteudoarquivo = $_FILES['arquivo']['tmp_name'];

// $matriz = array(
//     array(10, 0, -10),
//     array(0, 10, 0),
//     array(-10    , 0, -1)
// );   

$imagemsaida = AplicaFiltro($conteudoarquivo, $matriz);

header("Content-Type: {$tipo}");
if($tipo == 'image/png'){
    imagepng($imagemsaida);
}else{
    imagejpeg($imagemsaida);
}

function AplicaFiltro($conteudoimagem, $matriz) {
    global $tipo;

    if($tipo == 'image/png'){
        $imagem = imagecreatefrompng($conteudoimagem);
    }else{
        $imagem = imagecreatefromjpeg($conteudoimagem);
    }

    $largura = imagesx($imagem);
    $altura = imagesy($imagem);
    
    $tamanho_filtro = count($matriz);
    $offset = floor($tamanho_filtro / 2);
    
    $imagemsaida = imagecreatetruecolor($largura, $altura);
    
    for ($x = $offset; $x < $largura - $offset; $x++) {
        for ($y = $offset; $y < $altura - $offset; $y++) {

            $rTotal = 0;
            $gTotal = 0;
            $bTotal = 0;
            
            for ($i = 0; $i < $tamanho_filtro; $i++) {
                for ($j = 0; $j < $tamanho_filtro; $j++) {
                    $rgb = imagecolorat($imagem, $x - $offset + $i, $y - $offset + $j);
                    $color = imagecolorsforindex($imagem, $rgb);
                    $rTotal += $color['red'] * $matriz[$i][$j];
                    $gTotal += $color['green'] * $matriz[$i][$j];
                    $bTotal += $color['blue'] * $matriz[$i][$j];
                }
            }
            $rTotal = min(255, max(0, $rTotal));
            $gTotal = min(255, max(0, $gTotal));
            $bTotal = min(255, max(0, $bTotal));
            $color = imagecolorallocate($imagemsaida, $rTotal, $gTotal, $bTotal);
            imagesetpixel($imagemsaida, $x, $y, $color);
        }
    }
    
    return $imagemsaida;
}
