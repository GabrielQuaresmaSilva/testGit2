<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Server Info</title>
</head>
<body>
    <h1>Server Information</h1>
    <ul>
        <li><strong>SERVER_NAME:</strong> <?=$_SERVER['SERVER_NAME']?></li>
        <li><strong>SERVER_ADDR:</strong> <?=$_SERVER['SERVER_ADDR']?></li>
        <li><strong>REMOTE_ADDR:</strong> <?=$_SERVER['REMOTE_ADDR']?></li>
    </ul>
    <hr>
    <?php var_dump($_SERVER); ?>
</body>
</html>