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
			          ->prepare("SELECT * FROM Vias ORDER BY Nom_Via LIMIT :limit");
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
        $stm = $this->pdo->prepare("SELECT * FROM Vias WHERE Nom_Via like :Nom_Via ORDER BY Nom_Via LIMIT :limit");
        $stm->bindValue(':Nom_Via', '%'.$search.'%', PDO::PARAM_STR);
        $stm->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
        $stm->execute();
        //Variable en array para ser procesado en el ciclo foreach
        $lista_via = $stm->fetchAll(PDO::FETCH_OBJ);
    }

    $response = array();

    // Leer los datos de SQL
    foreach($lista_via as $via){
    $response[] = array(
            "id" => $via['Cod_Via'],
            "text" => $via['Nom_Via']
        );
    }
    echo json_encode($response);
    exit();
?>
