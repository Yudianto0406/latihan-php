<?php

    $connect = new PDO("mysql:host=localhost;dbname=latihan", "root", "");
    $received_data = json_decode(file_get_contents("php://input"));

    $data = array();

    if($received_data->action == 'fetchall')
    {

        $query      = "SELECT * FROM tb_sample ORDER BY id DESC";
        $statement  = $connect->prepare($query);
        $statement->execute();

        while($row = $statement->fetch(PDO::FETCH_ASSOC)){
            $data[] = $row;
        }
        
        echo json_encode($data);
    }

    	

    if($received_data->action == 'insert')
    {
        $data = array(
            ':first_name' => $received_data->first_name,
            ':last_naame' => $received_data->last_naame
        );
            
        $query = "INSERT INTO tb_sample (first_name, last_naame) VALUES (:first_name, :last_naame)";
        $statement  = $connect->prepare($query);
        $statement->execute($data);

    }

        
    

    if($received_data->action == 'update')
    {
        $data = array(
            ':first_name'   => $received_data->first_name,
            ':last_naame'    => $received_data->last_naame,
            ':id'           => $received_data->id
        );
            
        $query = "UPDATE tb_sample SET first_name = :first_name, last_naame = :last_naame WHERE id = :id";
            
        $statement = $connect->prepare($query);
            
        $statement->execute($data);
    }


    if($received_data->action == 'delete')
    {
        $data = array(
            ':id'           => $received_data->id
        );
            
        $query = "DELETE FROM tb_sample WHERE id = :id";
        
        $statement = $connect->prepare($query);
            
        $statement->execute($data);
    }


    
    
?>