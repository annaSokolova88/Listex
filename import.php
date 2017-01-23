<?php
include ('config.php');
class importFile
{
    protected $connection;

    public function __construct($host, $username, $password, $db_name)
    {
        $this->connection = new PDO("mysql:dbname = $db_name;host = $host", $username, $password);
        if (!$this->connection) {
            throw new Exception('Could not connect to DB ');
        }
    }

    public function run($fileImport)
    {
        $processRecord =0;
        $insertRecord = 0;
        if (is_file($fileImport) && ($data = fopen($fileImport, 'r')) !== FALSE) {
            $this->connection->beginTransaction();
            fgetcsv($data);
            while (($row = fgetcsv($data, 300, ',')) !== FALSE) {
                $processRecord ++;
                $statementSelect = $this->connection->prepare(
                    'SELECT Name
                    FROM Lst_Goods
                    WHERE Name = ?');
                $statementSelect->execute(array($row[1]));
                $query = $statementSelect->fetchAll();
                if($query){
                    continue;
                }
                $statementInsert = $this->connection->prepare("INSERT INTO Lst_Goods (name) VALUES (:name)");
                $statementInsert->bindParam(':name', $row[1], PDO::PARAM_STR);
                $statementInsert->execute();
                $insertRecord++;
            }
        } else {
            throw new Exception('Could not open file');
        }
        $this->connection->commit();
        fclose($data);
        echo "Total processed records: {$processRecord}. Total insert records: {$insertRecord}";
    }
}
if ($_POST){
    if($_FILES['csv_file']['name'] && $_FILES['csv_file']['type'] == "application/vnd.ms-excel"){
        if($_POST ['is_defaultConfig']){
            $newImport = new importFile ($host, $db_user, $db_password, $db_name);
            $newImport->run($_FILES['csv_file']['tmp_name']);
    }else{
            if($_POST['host'] && $_POST['dbName'] && $_POST['dbUser']){
                $newImport = new importFile ($_POST['host'], $_POST['dbUser'], $_POST['dbPassword'], $_POST['dbName']);
                $newImport->run($_FILES['csv_file']['tmp_name']);
            }else{
                echo "Select the default configuration or enter settings for connecting to the database";
            }
        }
    }else{
        echo "Import file format must be '.csv'. Operation canceled";
    }
}
?>
<br>
<a href="index.php">To main Page</a>
