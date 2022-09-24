<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>new user</title>
</head>
<body>
  <form action="" method="POST">
    @csrf
    first name <input type="text" name="first_name"><br>
    last name <input type="text" name="last_name"><br>
    first name (kana) <input type="text" name="first_name_kana"><br>
    last name (kana) <input type="text" name="last_name_kana"><br>
    mail address <input type="text" name="mail_address"><br>
    password <input type="password" name="password"><br>
    password (confirmation) <input type="password" name="password_confirmation"><br>
    <input type="submit" value="create">
  </form>
</body>
</html>