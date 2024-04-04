<html>
    <br><br>
<!-- this is the album chooser -->

    <head>
        <link rel="stylesheet" href="style.css">
        <title id="titleText">Choose Album</title>
        <meta name="viewport" content="user-scalable=no">
    </head>

    <!-- listing all the folders in "assets/music" in the form of images (covers of the albums) --> 
    <?php       
    session_start();    //starts the session for data transfering

    $handle = opendir('assets/music');
    $cont = 0;
    if($handle){
        while(($entry = readdir($handle)) !== false){
            if($entry != '.' && $entry != '..' && $entry != '.htaccess'){
            echo "<img src='assets/music/$entry/cover.png' onclick=\"setAlbum('$entry');\"  style='width:400px'></img> &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp"; // not optimal. 
            $cont += 1;
            if($cont == 2)
            {
                echo "<br><br>";
                $cont = 0;
            }
            }
        }
        closedir($handle);
    }
    ?>
    

    <form method="POST" action = "player.php" id = "myForm">
        <input type="hidden" id="myVar" name="albumForm" value="">
        <!-- sends the name of the selected album in php SESSION -->
    </form>

    <script>
        function setAlbum(folder)
        {
            let album = "assets/music/" + String(folder) + "/";
            sessionStorage.setItem('albumPath', album);     //sends album name in javascript storage, for transfering
            document.getElementById("myVar").value = folder;
            document.getElementById("myForm").submit(); //sends all data
        }    
    </script>

</html>