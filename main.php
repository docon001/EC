<?php

include("db.php");

$id = $_POST['id'];
$name = $_POST['name'];
$breed = $_POST['breed'];
$age = $_POST['age'];
$likes = $_POST['likes'];
$description = $_POST['description'];
$image = $_POST['image'];
$friends = $_POST['friends'];
$operation = $_POST['operation'];
$updateParams = inputSet($name, $breed, $age, $likes, $description, $image, $friends);

function id()
{
    return rand();
}

function inputSet($name, $breed, $age, $likes, $description, $image, $friends)
{
    $params = func_get_args();
    for($i = 0; i < $params.length(); $i++)
    {
        if($params[$i] != "")
        {
            $setParams.array_push($params[$i]);
        }
    }
    return $setParams;
}


function createCat($name, $breed, $age, $likes, $description, $image)
{
    $id = id();
    $sql = "INSERT $id, $name, $breed, $age, $likes, $description, $image INTO catList";
    try
    {
        $pdo->query($sql);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

function fetchCat($id)
{
    try
    {
        $sql = "SELECT * FROM catList WHERE $id = id";
    }
    catch(PDOException $e)
    {
        $e->getMessage();
    }
    $response_array = $pdo->query($sql);
    $result = $response_array->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function updateCat($id)
{
    for($i = 0; i < $updateParams.length(); $i++)
    {
	$updateList .= $updateParams[$i] . ',';
    }
    $sql = "UPDATE catList SET".$updateList."WHERE $id = id";
    try
    {
	$pdo->query($sql);
    }
    catch(PDOException $e)
    {
	$e->getMessage();
    }
}

function deleteCat($id)
{
    $sql = "DELETE FROM catList WHERE $id = id";
    try
    {
        $pdo->query($sql);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
}

function controller($operation, $id, $name, $breed, $age, $likes, $description, $image, $friends)
{
    switch($operation){
        case "CREATE":
            createCat($name, $breed, $age, $likes, $description, $image);
            break;
        case "READ":
            fetchCat($id);
            break;
        case "UPDATE":
            updateCat($id);
            break;
        case "DELETE":
            deleteCat($id);
            break;
        default: 
            echo "Invalid operation";
    }
}

?>