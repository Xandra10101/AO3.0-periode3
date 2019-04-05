<?php
//signup.php
// include ('Model/Database/connection_database.php');

 
echo '<h3>Sign up</h3>';
 
if($_SERVER['REQUEST_METHOD'] != 'POST'){
    /*the form hasn't been posted yet, display it
      note that the action="" will cause the form to post to the same page it is on */
    echo '<form method="post" action="">
       <input required="text" id="lastname" name="last name" placeholder="Last Name"> <br>
        <input required="text" id="firstname" name="firstname" placeholder="First Name"> <br>
        <input type="text" id="email" name="email" placeholder="E-mail"> <br>
        <input required="text" id="username" name="username" placeholder="Username"> <br>
        <input required="text" id="password" name="password"placeholder="Password"><br>
        <input required="text" id="password" name="password" placeholder="Password again"><br>
        <input type="submit" name="submit" id="submit" value="Register"><br>
     </form>';
}else{

    */
    $errors = array(); /* declare the array for later use */
     
    if(isset($_POST['username'])){
        //the user name exists
        if(!ctype_alnum($_POST['username'])){
            $errors[] = 'The username can only contain letters and digits.';
        }
        if(strlen($_POST['username']) > 40){
            $errors[] = 'The username cannot be longer than 30 characters.';
        }
    }else{
        $errors[] = 'The username field must not be empty.';
    }
     
     
    if(isset($_POST['user_pass'])){
        if($_POST['user_pass'] != $_POST['user_pass_check']){
            $errors[] = 'The two passwords did not match.';
        }
    }else{
        $errors[] = 'The password field cannot be empty.';
    }
     
    if(!empty($errors)){
        echo 'Uh-oh.. a couple of fields are not filled in correctly..';
        echo '<ul>';
        foreach($errors as $key => $value){
            echo '<li>' . $value . '</li>'; 
        }
        echo '</ul>';
    }else{
       $sql = "INSERT INTO users (ID, Name, Password, Email, Date, Level)
                VALUES('" . mysql_real_escape_string($_POST['username']) . "',
                       '" . sha1($_POST['password']) . "',
                       '" . mysql_real_escape_string($_POST['email']) . "',
                        NOW(),
                        0)";
                         
        $result = mysql_query($sql);
        if(!$result){
            echo 'Something went wrong while registering. Please try again later.';
            
        }else{
            echo 'Successfully registered. You can now <a href="signin.php">sign in</a> and start posting! :-)';
        }
    }
}
 
?>