<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
</head>
<?php

$id = $_GET['id'];
if ($id){

  
  
}else {

  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => "https://api.rajaongkir.com/starter/province",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => array(
      "key: 3b336ea639da23a906596cf684b097cd"
    ),
  ));

  $response = curl_exec($curl);
  $err = curl_error($curl);

  curl_close($curl);

  $json = json_decode($response);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    echo "<form method='get' id='search' action=''>
          <div class='input-group'>
          <select name='id' class='custom-select' id='inputGroupSelect04'>";
    for ($i=0; $i<35; $i++){
      echo "<option value='".$json->rajaongkir->results[$i]->province_id."'>".$json->rajaongkir->results[$i]->province."</option>";
    }
    echo "</select>
              <div class='input-group-append'>
              <button class='btn btn-outline-secondary' type='submit'>Button</button>
            </div>
          </div>";
  }

}