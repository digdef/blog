<?php
include("includes/config.php");
if (!isset($_SERVER['PHP_AUTH_USER']))
 
{
        Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
        Header ("HTTP/1.0 401 Unauthorized");
        exit();
}
 
else { 
    $query = "SELECT `password`,`login` FROM `users` WHERE login='".$_SERVER['PHP_AUTH_USER']."' and privilege='Admin'";
    $lst = mysqli_query($connection, $query);    
        if (!get_magic_quotes_gpc()) {
                $_SERVER['PHP_AUTH_USER'] = mysqli_escape_string($connection, $_SERVER['PHP_AUTH_USER']);
                $_SERVER['PHP_AUTH_PW'] = mysqli_escape_string($connection, $_SERVER['PHP_AUTH_PW']);
        }
        
        
 
        if (!$lst)
        {
            Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
        Header ("HTTP/1.0 401 Unauthorized");
        exit();
        }
 
        if (mysqli_num_rows($lst) == 0)
        {
           Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }
 
        $pass =  mysqli_fetch_array($lst);
        if ($_SERVER['PHP_AUTH_PW']!= $pass['password'])
        {
            Header ("WWW-Authenticate: Basic realm=\"Admin Page\"");
           Header ("HTTP/1.0 401 Unauthorized");
           exit();
        }
 
 
}
?>