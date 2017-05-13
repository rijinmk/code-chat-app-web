## Introduction

This is a very simple MySQL / PHP 7 based chat application. It contains the following languages: 
#### Front End
* HTML
* CSS3
* jQuery (Client Side)
* Javascript

#### Back End
* PHP 
* MySQL
* jQuery (Sever side)
* Ajax 

### It has the following features: 
* Sign In & Sign Up
* Responsive webdesign
* All forms of error validation
* Recognizes your country while registering, using your IP Address. 
* Very smooth chatting experience
* Group chat
* Can see who all are online 
* Change colors of the chat bubble at your will 

# BACKEND

## Sign In 
The sign in takes plave in the `index.php` page. It has a basic form where you have to enter your username and password, After the username and password is entered. The username and password is `POST-ED` to the same page and the following validation is done on the same page: 

```php
  if(isset($_POST['username']) && isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_hash = md5($password);
    if(!empty($username) && !empty($password)){
      $query = "SELECT `username`,`password` FROM `users` WHERE `username`='$username' AND `password`='$password_hash' ";
      $query_run = mysqli_query($link, $query);
      $userexists = mysqli_num_rows($query_run);
      if($userexists){
        $_SESSION['username'] = $username;
        $query = "UPDATE `users` SET `status`=1 WHERE `username`='$username'";
        mysqli_query($link, $query); 
        header('Location: profile.php');
      }else{
        $error = "Wrong username or password";
      }
    }else{
      $error = "Please fill in the details";
    }
  }
```

As you can see first it checks if the `POSTED` variables are `isset` on line: 
```php
if(isset($_POST['username']) && isset($_POST['password'])){
```
This condition will only be true if there are any variables `POSTED` to this page, Even if the variables are empty this part will be set to true.
Following this code we have: 

```php
$username = $_POST['username'];
$password = $_POST['password'];
$password_hash = md5($password);
```

We set 3 PHP variables, In which the username and password are variables that are posted from the same page. `$password_hash` contains the MD5 crypted version of the password. *I know md5() encryption is depricated, but this was just for a project so I used this. You are free to replace the md5() with any other encryption.* These variables will later be used to validate the user into our chat app. Next we have this condition: 

```php
if(!empty($username) && !empty($password)){
```

As I have mentioned earlier, The function `isset()` wont check if the varibles are empty or not. So we need to write another condition to check if the username and password feilds are left empty. If this contidion is false, `Please fill in the details` will be printed. Now we have checked if the username and password are posted, and also- If they are empty or not. Now we have to check if the username and password entered matches our database (*details about the **database** will be mentioned later*). For that we have to run the following query: 

```php
$query = SELECT `username`,`password` FROM `users` WHERE `username`='$username' AND `password`='$password_hash';
$query_run = mysqli_query($link, $query);
$userexists = mysqli_num_rows($query_run);
```
**NOTE**: The `username and password` is different from `$username and $password`. The ones with the $ in them are PHP variables. The `username and password` in the query are attribute names which we have mentioned in the MySQL Table of the web app. We run this query by 

The variable `$query` stores a MySQL query which is later run suing the `$query_run = mysqli_query($link, $query)` function, When its run we check if the username and password that the user entered matches any username or password in our database. Now the `mysqli_num_rows($query_run)` function will return a `1` or a `0`, It will return `1` if the user exists and `0` if the user doesnt exist. The `mysqli_num_rows($query_run)` just returns the number of rows that have the that username and password. So, you might be thinking what if there are more than 2 users with the same username and password?, That's why we have 'unique' usernames, Which we will talk about in the *Sign Up* page. Now: 

```php
if($userexists){
```

If this condition is true, We have to log the user in. We use the `$_SESSION` variables to log the user in. We use the username as the key to get the users information from the database. 

```php
$_SESSION['username'] = $username;
$query = "UPDATE `users` SET `status`=1 WHERE `username`='$username'";
mysqli_query($link, $query); 
header('Location: profile.php');
```

We run the query `UPDATE users SET status=1 WHERE username='$username'` to show that this user has logged in to the chat application. The `header('Location: profile.php')` function takes the user to the `profile.php` where he / she can talk to anyone who has logged into the app. 

## Profile page

The start of the profile page has: 

```php 
if(!loggedin()){
  header('Location: index.php');
}

$username_logged_in = $_SESSION['username'];
$query = "SELECT * FROM `users` WHERE `username`='$username_logged_in'";
$query_run = mysqli_query($link, $query);
$user_info = mysqli_fetch_assoc($query_run);
$fullname = $user_info['fullname'];
$country_code = $user_info['country_code'];
```
As mentioned before we use ` $_SESSION['username']` as the key to get the users information. 

        
















