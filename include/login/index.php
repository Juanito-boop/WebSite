<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <style>
        body{
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: #fff;
        }
        .box{
            width: 300px;
            padding: 40px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background: #3d3d3d;
            text-align: center;
        }
        .box h1{
            color: white;
            text-transform: uppercase;
            font-weight: 500;
        }
        .box input[type=text],.box input[type=password]{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #3498db;
            padding: 14px 10px;
            width: 200px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
        }
        .box input[type=text]:focus,.box input[type=password]:focus{
            width: 280px;
            border-color: #2ecc71;
        }
        .box input[type=submit]{
            border: 0;
            background: none;
            display: block;
            margin: 20px auto;
            text-align: center;
            border: 2px solid #2ecc71;
            padding: 14px 40px;
            outline: none;
            color: white;
            border-radius: 24px;
            transition: 0.25s;
            cursor: pointer;
        }
        .box input[type=submit]:hover{
            background: #2ecc71;
        }
    </style>
    <title>Login</title>
</head>
<body>
    <form class="box" action="validar.php" method="post">
        <h1>LOGIN</h1>        
        <input type="text" name="" placeholder="Usuario">        
        <input type="password" name="" placeholder="Contraseña">
        <input type="submit" name="" value="Login">
    </form>
</body>
</html>