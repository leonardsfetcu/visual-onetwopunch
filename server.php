<?php
include 'db.php';
set_time_limit(0);
// where does the data come from ? In real world this would be a SQL query or something
// main loop
while (true) {

    // declarare structura vector pt param trimis prin ajax
    $lastClientState = array("id_scanner"=>"","state"=>"");

    // atribuire param trimis prin ajax structurii definite anterior
    if(isset($_POST['info']))
    {
        $lastClientState['id_scanner'] = $_POST['info']['id_scanner'];
        $lastClientState['state'] = $_POST['info']['state'];
    }

    // interogare BD pentru ID-ul primit ca param prin ajax si salvare rezultat in $serverState
    $sql='select scanners.id_scanner,scanners.state,scanners.name,scanners.target from scanners where scanners.id_scanner='.$lastClientState['id_scanner'];
    $conn = OpenConnection();
    $result = $conn->query($sql);

    $serverState = $result->fetch_assoc();
    CloseConnection($conn);
    // trimite informatiile extrase din BD daca acestea difera de cele ale clientului
    if(strcmp($serverState['state'],$lastClientState['state'])!=0)
    {
        echo json_encode($serverState);
        break;

    } else {
        // wait for 1 sec (not very sexy as this blocks the PHP/Apache process, but that's how it goes)
        sleep( 2 );
        continue;
    }
}