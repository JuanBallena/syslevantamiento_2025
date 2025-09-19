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
			          ->prepare("SELECT * FROM Hab_Urba                                  
                                 ORDER BY Grupo_Urba LIMIT :limit");
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
        $stm = $this->pdo->prepare("SELECT * FROM Hab_Urba 
                                    WHERE Grupo_Urba like :Grupo_Urba 
                                    ORDER BY Grupo_Urba LIMIT :limit");
        $stm->bindValue(':Grupo_Urba', '%'.$search.'%', PDO::PARAM_STR);
        $stm->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
        $stm->execute();
        //Variable en array para ser procesado en el ciclo foreach
        $lista_grupoHU= $stm->fetchAll(PDO::FETCH_OBJ);
    }

    $response = array();

    // Leer los datos de SQL
    foreach($lista_grupoHU as $grupoHU){
    $response[] = array(
            "id" => $grupoHU['Id_Hab_Urba'],
            "text" => $grupoHU['Grupo_Urba']
        );
    }
    echo json_encode($response);
    exit();
?>
