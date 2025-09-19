<?php
    private $pdo;   
    // Número de registros recuperados
    $numberofrecords = 5;

    public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

    if(!isset($_POST['searchTerm'])){
        try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM Puertas ORDER BY Tip_Puerta LIMIT :limit");
            $stm->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
			$stm->execute();
            $lista_via = $stm->fetchAll(PDO::FETCH_OBJ);			
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}

    }else{
        $search = $_POST['searchTerm'];// Search text

        // Mostrar resultados
        $stm = $this->pdo->prepare("SELECT * FROM Puertas WHERE Tip_Puerta like :Tip_Puerta ORDER BY Tip_Puerta LIMIT :limit");
        $stm->bindValue(':Tip_Puerta', '%'.$search.'%', PDO::PARAM_STR);
        $stm->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
        $stm->execute();
        //Variable en array para ser procesado en el ciclo foreach
        $lista_puerta = $stm->fetchAll(PDO::FETCH_OBJ);
    }

    $response = array();

    // Leer los datos de SQL
    foreach($lista_puerta as $puerta){
    $response[] = array(
            "id" => $puerta['IdPuerta'],
            "text" => $puerta['Tip_Puerta']
        );
    }
    echo json_encode($response);
    exit();
?>
