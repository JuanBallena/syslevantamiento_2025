
<?php
	function SelectorTipoFicha($type){
		
		switch($type):
			
			case '01': 	echo 'FICHA INDIVIDUAL';
						break;
			case '02': 	echo 'FICHA COTITULARIDAD';
						break;
			case '03': 	echo 'FICHA ECONOMICA';
						break;
			case '04': 	echo 'FICHA BIENES COMUNES';
						break;
		endswitch;
	}

	function SelectorTipoVia($type){
		
		switch($type):
			
			case '01': 	echo 'AV';
						break;
			case '02': 	echo 'CA';
						break;
			case '05': 	echo 'JR';
						break;
			case '04': 	echo 'PSJ';
						break;
			case '07': 	echo 'CTRA';
						break;
			case '08': 	echo 'PRLG';
						break;																		
			case 'AL': 	echo 'AL';
						break;
			case 'PS': 	echo 'PS';
						break;	
			case 'ML': 	echo 'ML';
						break;	
			case 'CAM': echo 'CAM';
						break;					
		endswitch;
	}
?>