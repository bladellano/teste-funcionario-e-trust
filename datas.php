<?php

/**
* Calcula o numero de dias entre 2 datas.
* As datas passadas sempre serao validas e a primeira data sempre sera menor que a segunda data.
* @param string $dataInicial No formato YYYY-MM-DD
* @param string $dataFinal No formato YYYY-MM-DD
* @return int O numero de dias entre as datas
**/
function calculaDias($dataInicial, $dataFinal) {
	/*
		- Setembro, abril, junho e novembro tem 30 dias, todos os outros meses tem 31 exceto fevereiro que tem 28, exceto nos anos bissextos nos quais ele tem 29.
		- Os anos bissexto tem 366 dias e os demais 365.
		- Todo ano divisivel por 4 e um ano bissexto.
		- A regra acima não e valida para anos divisiveis por 100. Estes anos devem ser divisiveis por 400 para serem anos bissextos. Assim, o ano 1700, 1800, 1900 e 2100 nao sao bissextos, mas 2000 e bissexto.
		- Não e permitido o uso de classes e funcoes de data da linguagem (DateTime, mktime, strtotime, etc).
	*/

		return setDaysData($dataFinal) - setDaysData($dataInicial);
	}

	function setDaysData($_data){
		
		$countAno    = 0;
		$anoBissexto = 366;
		$anoNormal   = 365;
		$data        = explode("-",$_data);
		$diasCorridoMeses = 0;

		$dia = $data[2];
		$mes = $data[1];
		$ano = $data[0];
		
		$diasTotalIntervaloAno = 0;

		for($i = $countAno; $i <= $ano ; $i++){/*Pegando no intervalo de anos a qtd de dias */ 			
			if(verificaAnoBissexto($i)){
				$diasTotalIntervaloAno += $anoBissexto;
			} else {
				$diasTotalIntervaloAno += $anoNormal; 
			}
		}

		$aMeses = Array(/* Array de meses com qtd de dias */
			1  => 31,
			2  => 28,
			3  => 31,
			4  => 30,         
			5  => 31,
			6  => 30,
			7  => 31,
			8  => 31,
			9  => 30,         
			10 => 31,
			11 => 30,
			12 => 31);

		if(verificaAnoBissexto($ano)) 
			$aMeses[2] = $aMeses[2] + 1;/* Seta +1 fevereiro se ano for bissexto. */

		$qtdDiasAno = array_sum($aMeses);/* Soma todos os dias do ano correspondente */	

		foreach($aMeses as $chave => $tDias){/* Verifica dias corridos através dos meses */
			if($chave == $mes)
				break;
			$diasCorridoMeses += $tDias;
		}
		return $dia + $diasTotalIntervaloAno + $diasCorridoMeses - $qtdDiasAno;
	}

	function verificaAnoBissexto($ano){/* Função auxiliar */
		if($ano % 400 == 0) 
			return true;
		elseif ($ano % 4 == 0 && $ano % 100 != 0)
			return true;		
		return false;
	}

	/***** Teste 01 *****/
	$dataInicial = "2018-01-01";
	$dataFinal = "2018-01-02";
	$resultadoEsperado = 1;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("01", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 02 *****/
	$dataInicial = "2018-01-01";
	$dataFinal = "2018-02-01";
	$resultadoEsperado = 31;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("02", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 03 *****/
	$dataInicial = "2018-01-01";
	$dataFinal = "2018-02-02";
	$resultadoEsperado = 32;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("03", $resultadoEsperado, $resultado);

	echo "<br/>";
	// **** Teste 04 ****
	$dataInicial = "2018-01-01";
	$dataFinal = "2018-02-28";
	$resultadoEsperado = 58;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("04", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 05 *****/
	$dataInicial = "2018-01-15";
	$dataFinal = "2018-03-15";
	$resultadoEsperado = 59;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("05", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 06 *****/
	$dataInicial = "2018-01-01";
	$dataFinal = "2019-01-01";
	$resultadoEsperado = 365;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("06", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 07 *****/
	$dataInicial = "2018-01-01";
	$dataFinal = "2020-01-01";
	$resultadoEsperado = 730;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("07", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 08 *****/
	$dataInicial = "2018-12-31";
	$dataFinal = "2019-01-01";
	$resultadoEsperado = 1;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("08", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 09 *****/
	$dataInicial = "2018-05-31";
	$dataFinal = "2018-06-01";
	$resultadoEsperado = 1;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("09", $resultadoEsperado, $resultado);

	echo "<br/>";
	/***** Teste 10 *****/
	$dataInicial = "2018-05-31";
	$dataFinal = "2019-06-01";
	$resultadoEsperado = 366;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("10", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 11 *****/
	$dataInicial = "2016-02-01";
	$dataFinal = "2016-03-01";
	$resultadoEsperado = 29;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("11", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 12 *****/
	$dataInicial = "2016-01-01";
	$dataFinal = "2016-03-01";
	$resultadoEsperado = 60;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("12", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 13 *****/
	$dataInicial = "1981-09-21";
	$dataFinal = "2009-02-12";
	$resultadoEsperado = 10006;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("13", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 14 *****/
	$dataInicial = "1981-07-31";
	$dataFinal = "2009-02-12";
	$resultadoEsperado = 10058;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("14", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 15 *****/
	$dataInicial = "2004-03-01";
	$dataFinal = "2009-02-12";
	$resultadoEsperado = 1809;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("15", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 16 *****/
	$dataInicial = "2004-03-01";
	$dataFinal = "2009-02-12";
	$resultadoEsperado = 1809;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("16", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 17 *****/
	$dataInicial = "1900-02-01";
	$dataFinal = "1900-03-01";
	$resultadoEsperado = 28;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("17", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 18 *****/
	$dataInicial = "1899-01-01";
	$dataFinal = "1901-01-01";
	$resultadoEsperado = 730;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("18", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 19 *****/
	$dataInicial = "2000-02-01";
	$dataFinal = "2000-03-01";
	$resultadoEsperado = 29;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("19", $resultadoEsperado, $resultado);
	echo "<br/>";
	/***** Teste 20 *****/
	$dataInicial = "1999-01-01";
	$dataFinal = "2001-01-01";
	$resultadoEsperado = 731;
	$resultado = calculaDias($dataInicial, $dataFinal);
	verificaResultado("20", $resultadoEsperado, $resultado);

	function verificaResultado($nTeste, $resultadoEsperado, $resultado) {
		if(intval($resultadoEsperado) == intval($resultado)) {
			echo "Teste $nTeste passou.\n";
		} else {
			echo "Teste $nTeste NAO passou (Resultado esperado = $resultadoEsperado, Resultado obtido = $resultado).\n";
		}
	}

	?>