<?php
require"./../.env";


header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json; charset=UTF-8"); 
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE"); 
header("Access-Control-Max-Age: 3600"); 
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$servername = "localhost:3306";
$username = "root";
$password = getenv("PASSWORD");

//$text = $_POST["textarea"];
//$name = $_POST["username"];
//$submit = $_POST["submitbutton"];


$requestType = $_SERVER["REQUEST_METHOD"];

if($requestType == "GET") {
try {
    $conn = new PDO("mysql:host=$servername:dbname=pipper",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $statement = $conn->query("select * from pipper.pips");
    $result = $statement->fetchAll(\PDO::FETCH_ASSOC);

    echo json_encode($result);

} catch (PDOException $e) {
    echo "Connection failed". $e->getMessage();
}
}

elseif ($requestType =="POST"){

    $input = (array) json_decode(file_get_contents('php://input'), TRUE);
    $text = $input["message"];
    $name = $input["username"];

    //$text = $_POST["message"];
    //$name = $_POST["username"];

    //$sql = "INSERT INTO pips (username, message) VALUES ('$name', '$text')";
    $conn = new PDO("mysql:host=$servername:dbname=pipper",$username,$password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "INSERT INTO pipper.pips (username, message) VALUES (:name,:text)";
    $stmt= $conn->prepare($sql);
    $stmt->execute(array(
        'text' => $text,
        'name' => $name,
    ));

}


//$sql = "INSERT INTO pips (username, message) VALUES (?,?)";
//$stmt= $pdo->prepare($sql);
//$stmt->execute([$name, $text]);





//$comments= $_POST['textarea'];

//$text = $_POST["textarea"];
//$name = $_POST["username"];
//$submit = $_POST["submitbutton"];


//echo json_encode($result);



//php -S 127.0.0.1:8000 -t public 
//Sæt ovenstående ind i terminalen, eller virker det ikke.... :)))))




?>