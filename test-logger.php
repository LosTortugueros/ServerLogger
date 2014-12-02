<?php
$toto = '{ "source": "mobile", "capteur": "boisson", "timestamp":1417454339833, "type":"the" }';
$ch = curl_init('http://etud.insa-toulouse.fr/~livet/logger.php?user=2');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $toto);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($toto))
);
while(true){
    $result = curl_exec($ch);
}

curl_close($ch);
echo $result;
