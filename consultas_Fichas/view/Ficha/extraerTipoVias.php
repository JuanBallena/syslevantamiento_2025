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
			          ->prepare("SELECT m.Codigo as Cod_TipoVia, m.DescCodigo as Des_TipoVia FROM Vias v
                                 INNER JOIN Multitabla m ON v.Tip_Via = m.Codigo 
                                 WHERE m.IdTabla='VIA'
                                 ORDER BY m.DescCodigo LIMIT :limit");
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
        $stm = $this->pdo->prepare("SELECT m.Codigo as Cod_TipoVia, m.DescCodigo as Des_TipoVia FROM Vias v
                                    INNER JOIN Multitabla m ON v.Tip_Via = m.Codigo
                                    WHERE m.IdTabla='VIA' and m.DescCodigo like :DescCodigo 
                                    ORDER BY m.DescCodigo LIMIT :limit");
        $stm->bindValue(':DescCodigo', '%'.$search.'%', PDO::PARAM_STR);
        $stm->bindValue(':limit', (int)$numberofrecords, PDO::PARAM_INT);
        $stm->execute();
        //Variable en array para ser procesado en el ciclo foreach
        $lista_tipovia = $stm->fetchAll(PDO::FETCH_OBJ);
    }

    $response = array();

    // Leer los datos de SQL
    foreach($lista_tipovia as $tipovia){
    $response[] = array(
            "id" => $tipovia['Cod_TipoVia'],
            "text" => $tipovia['Des_TipoVia']
        );
    }
    echo json_encode($response);
    exit();
?>
