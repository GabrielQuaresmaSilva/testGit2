<?php
define("CYCLE_COUNT", 100000);
function sync_io()
{
    //Open the File Stream
    $handle = fopen("/tmp/randomData.txt", "w+");
    try {
        $lockObtained = flock($handle, LOCK_EX);
        if ($lockObtained) {
            $count = 0;
            //$count = fread($handle, filesize("/tmp/randomData.txt"));    //Get Current Hit Count
            while ($count <= CYCLE_COUNT) {
                $count = $count + 1;      //Increment Hit Count by 1
                ftruncate($handle, 0);    //Truncate the file to 0
                rewind($handle);           //Set write pointer to beginning of file
                fwrite($handle, $count);    //Write the new Hit Count
            }
            flock($handle, LOCK_UN);    //Unlock File
        }
    } catch (Exception $e) {
        $lockObtained = false;
    } finally {
        flock($handle, LOCK_UN);    //Unlock File
        fclose($handle);
    }
    return $lockObtained;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sync IO</title>
</head>
<body>
    <h1>Sync IO</h1>
    <p>This page is used to test a "very long" syncronous I/O operation.</p>
    <p>Page will only complete loading after a long operation on a file. File will be locked during the I/O operation, which means that only 1 client (request) can be server at a given moment</p> 
    <hr>
    <?php
    if (sync_io()) {
        echo "Operation Terminated";
    } else {
        echo "Operation has not terminated!";
    }
    ?>
</body>
</html>