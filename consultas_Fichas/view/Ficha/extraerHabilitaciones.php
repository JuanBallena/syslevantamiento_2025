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
			          ->prepare("SELECT * FROM Hab_Urba ORDER BY Nom_Hab_Urba LIMIT :limit");
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
        $stm = $this->pdo->prepare("SELECT * FROM Hab_Urba WHERE Nom_Hab_Urba like :Nom_Hab_Urba ORDER BY Nom_Hab_Urba LIMIT :limit");
        $stm->bindValue(':Nom_Hab_Urba', '%'.$search.'%', PDO::PARAM_STR);
        $stm->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
        $stm->execute();
        //Variable en array para ser procesado en el ciclo foreach
        $lista_HU = $stm->fetchAll(PDO::FETCH_OBJ);
    }

    $response = array();

    // Leer los datos de SQL
    foreach($lista_HU as $HU){
    $response[] = array(
            "id" => $HU['Id_Hab_Urba'],
            "text" => $HU['Nom_Hab_Urba']
        );
    }
    echo json_encode($response);
    exit();
?>
