<?php
// create & initialize a curl session 
$curl = curl_init();  
// set our url with curl_setopt() 
curl_setopt($curl, CURLOPT_URL, "api.example.com");  
// return the transfer as a string, also with setopt() curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);  
// curl_exec() executes the started curl session and $output contains the output string 
$output = curl_exec($curl);  
// close curl resource to free up system resources and (deletes the variable made by curl_init) 
curl_close($curl);

function callAPI($method, $url, $data){
   $curl = curl_init();
   switch ($method){
      case "POST":
         curl_setopt($curl, CURLOPT_POST, 1);
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
         break;
      case "PUT":
         curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
         if ($data)
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);			 					
         break;
      default:
         if ($data)
            $url = sprintf("%s?%s", $url, http_build_query($data));
   }
   // OPTIONS:
   curl_setopt($curl, CURLOPT_URL, $url);
   curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      'APIKEY: 111111111111111111111',
      'Content-Type: application/json',
   ));
   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
   // EXECUTE:
   $result = curl_exec($curl);
   if(!$result){die("Connection Failure");}
   curl_close($curl);
   return $result;
}



// $get_data = callAPI('GET', 'https://yourapi.com/get_url/', false);
$get_data = callAPI('GET', 'https://reqres.in/api/users?page=2', false);



$data = json_decode($get_data, true);

echo "<pre>"; print_r($data); echo "</pre>";
?>


<table id="customers">
    <?php
    foreach( $data['data'] as $row )
    {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['email']; ?></td>

            <td><?php echo $row['first_name']; ?></td>
            <td><?php echo $row['last_name']; ?></td>
            <td><img src="<?php echo $row['avatar']; ?>" /></td>
        </tr>
        <?php
    }
    ?>
</table>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>