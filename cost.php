<head>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
    <link rel="stylesheet" type="text/css" href="main.css"/>
    <script type="text/javascript" src="main.js"></script>
</head>
<?php

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "origin=501&destination=114&weight=1700&courier=jne",
  CURLOPT_HTTPHEADER => array(
    "content-type: application/x-www-form-urlencoded",
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
  echo "<div class='container'><div class='row justify-content-center'><div class='col-md-8'>";
  echo "<h2>Tarif Ongkir " . strtoupper($json->rajaongkir->results[0]->code) . "</h2>";
  echo "<div class='card p-3'>";
  echo "<p><b>Kota Asal : </b>" . $json->rajaongkir->origin_details->type . " " . $json->rajaongkir->origin_details->city_name . ", " . $json->rajaongkir->origin_details->province . "<p>";
  echo "<p><b>Kota Tujuan : </b>" . $json->rajaongkir->destination_details->type . " " . $json->rajaongkir->destination_details->city_name . ", " . $json->rajaongkir->destination_details->province . "<p>";
  echo "<p><b>Berat (g) : </b>" . $json->rajaongkir->query->weight . "gram<p>";
  echo "</div>";

  echo "
  <table class='mt-3 table table-hover table-bordered'>
  <thead class='thead-dark'>
    <tr>
      <th scope='col'>Layanan</th>
      <th scope='col'>Harga</th>
      <th scope='col'>Lama Pengiriman</th>
    </tr>
  </thead>
  <tbody>";
  
  for ($i=0; $i<3; $i++){
    $service = $json->rajaongkir->results[0]->costs[$i]->service;
    $service_detail = $json->rajaongkir->results[0]->costs[$i]->description;
    $cost = $json->rajaongkir->results[0]->costs[$i]->cost[0]->value;
    $etd = $json->rajaongkir->results[0]->costs[$i]->cost[0]->etd;
    echo 
    "<tr>
      <td>" . $service . ", " . $service_detail . "</td>
      <td> Rp. " . number_format($cost , 0, ',', '.') . "</td>
      <td>" . $etd . " hari </td>
    </tr>";

  }
    
  echo "
    </tbody>
  </table>";

  echo "</div></div></div>";
}
