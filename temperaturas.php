<?php

/**
* Retorna a temperatura mais proxima de zero.
* Se duas temperaturas com o mesmo valor absouto (uma positiva e outra negativa) serem igualmente proxima a zero, deve ser dada a preferencia para o valor positivo.
* @param array $temperaturas Lista de temperaturas
* @return int A temperatura mais proxima de zero
**/

function menorTemperatura($temperaturas) {

	$aNegativos = array();
	$aPositivos = array();

	foreach($temperaturas as $temp){//Separa os positivos e negativos
		if($temp <= -1){
			array_push($aNegativos,$temp);
		} else {        	
			array_push($aPositivos,$temp);
		}
	}

	if(count($aNegativos) == 0) return (min($aPositivos));//Se o array aNegativos for vazio, busca logo minimo do aPositivos
	if(count($aPositivos) == 0) return (max($aNegativos));//Se o array aPositivos for vazio, busca logo máximo do aNegativos

	$vMinimoP = min($aPositivos);//Seleciona o mínimo valor do array aPositivos
	$vMinimoN = max($aNegativos);//Seleciona o máximo valor do array aNegativos

	if($vMinimoP + $vMinimoN == 0) return $vMinimoP;//Verifica se o valor absoluto é negativo ou positivo. 

	$rComp = min(array($vMinimoP,-($vMinimoN))); //Verifica o valor mais próximo de Zero.
	if(in_array(-($rComp),$aNegativos)) return (-1 * $rComp);

	return $rComp;
}


/***** Teste 01 *****/
$temperaturas = array( 17, 32, 14, 21 );
$resultadoEsperado = 14;
$resultado = menorTemperatura($temperaturas);
verificaResultado("01", $resultadoEsperado, $resultado);

echo "<br/>";

/***** Teste 02 *****/
$temperaturas = array( 27, -8, -12, 9 );
$resultadoEsperado = -8;
$resultado = menorTemperatura($temperaturas);
verificaResultado("02", $resultadoEsperado, $resultado);

echo "<br/>";

/***** Teste 03 *****/
$temperaturas = array( -6, 14, 42, 6, 25, -18 );
$resultadoEsperado = 6;
$resultado = menorTemperatura($temperaturas);
verificaResultado("03", $resultadoEsperado, $resultado);

echo "<br/>";

// /***** Teste 04 *****/
$temperaturas = array( 34, 11, 13, -23, -11, 18 );
$resultadoEsperado = 11;
$resultado = menorTemperatura($temperaturas);
verificaResultado("04", $resultadoEsperado, $resultado);

echo "<br/>";

/***** Teste 05 *****/
$temperaturas = array( 17, 0, 28, -4 );
$resultadoEsperado = 0;
$resultado = menorTemperatura($temperaturas);
verificaResultado("05", $resultadoEsperado, $resultado);

echo "<br/>";

/***** Teste 06 *****/
$temperaturas = array( -10, 27, 9, -12 );
$resultadoEsperado = 9;
$resultado = menorTemperatura($temperaturas);
verificaResultado("06", $resultadoEsperado, $resultado);

echo "<br/>";

/***** Teste 07 *****/
$temperaturas = array( -47, -14, -5, -12, -8 );
$resultadoEsperado = -5;
$resultado = menorTemperatura($temperaturas);
verificaResultado("07", $resultadoEsperado, $resultado);

echo "<br/>";
/***** Teste 08 *****/
$temperaturas = array( -47, -14, -5, -12, -5 );
$resultadoEsperado = -5;
$resultado = menorTemperatura($temperaturas);
verificaResultado("08", $resultadoEsperado, $resultado);

echo "<br/>";

/***** Teste 09 *****/
$temperaturas = array( -7, 12, -13, 8 );
$resultadoEsperado = -7;
$resultado = menorTemperatura($temperaturas);
verificaResultado("09", $resultadoEsperado, $resultado);


function verificaResultado($nTeste, $resultadoEsperado, $resultado) {
	if(intval($resultadoEsperado) === intval($resultado)) {
		echo "Teste $nTeste passou.\n";
	} else {
		echo "Teste $nTeste NAO passou (Resultado esperado = $resultadoEsperado, Resultado obtido = $resultado).\n";
	}
}

?>