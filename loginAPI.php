<?php
// https://reqres.in/api/login

include 'apiCall.php'; //Step 1


function login($username,$password)
{
    //Step 2 Add to parameter
    $postParameter = array(
        "email" => $username,
        "password" => $password
    );
    
 //Now call api function in apiCall.php (step 3)
    $make_call = callAPI('POST', 'https://reqres.in/api/login', json_encode($postParameter)); 
   $response = json_decode($make_call, true);
    if($response['error']!=null)
    {
        print_r($response['error']);
    }
    else{
        echo $response['token'];
    }
   
}

//step 4 handle button click event
if(isset($_POST)){
    login($_POST['email'],$_POST['password']);
    }
?>

<html>
<body>

<h2>HTML Forms</h2>

<form method="post" action="loginAPI.php">
  <label for="fname">Email:</label><br>
  <input type="text" id="email" name="email" ><br>
  <label for="lname">Password:</label><br>
  <input type="text" id="password" name="password"><br><br>
  <input type="submit"  onclick="login()">
</form> 



<h5>username :  "eve.holt@reqres.in" </h5>
<h5>Password: "cityslicka"</h5>
</body>
</html>
