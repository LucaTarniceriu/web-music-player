
<html> 
    <head>
        <link rel="stylesheet" href="style.css">
        <title id="titleText">title</title>
        <meta name="viewport" content="user-scalable=no">
        <audio id="audiotag1" src = "assets/music/" onended= "nextTrack()"> </audio>
    </head>


    <body>
        <img id="cover" src="assets/music/Stray1/cover.png" alt="cover" width="600" onclick="location.href='index.php'"> </img>

        <div id="trackText" class="titleClass" style="color:white; font-family:Monaco ;font-weight:bold; font-style: normal; font-size: 350%;" >track</div>

        <controls class="controls">
            <img onclick = "prevTrack()" href="#" id = "b1" src="assets/images/prev.png" alt="prev" style="width: 250px;"></img>
            <img onclick="palyPause()" href="#" id = "b2" src="assets/images/pause.png" alt="play" style="width: 250px;"></img>
            <img onclick = "nextTrack()" href="#"id = "b3" src="assets/images/next.png" alt="next" style="width: 250px;"></img>
        </controls>
        
        <script>
            <?php 
                $albumTransfer = $_POST['albumForm'];       //this gets the value of 'albumForm' from the form on index.php
                // echo "//album".$albumTransfer;
            ?>

            var files = <?php $out = array();             // this paragraph creates the files array, which contains all tracks from the selected album
            foreach (glob("assets/music/$albumTransfer/*") as $filename) {
            $p = pathinfo($filename);
            $out[] = $p['filename'];
            }
            echo json_encode($out); ?>;



            let track = 0;                                           // initialising neded variables
            let folder_path = sessionStorage.getItem("albumPath");  //getting the value of albumPath stored in js sessionStorage (different from php's $_SESSION)
            let state = 0; //to play or not to play
            let audio = document.getElementById('audiotag1');

            audio.src= folder_path + files[track] + ".wav"; 
            document.getElementById('cover').src = folder_path + "cover.png";
            document.getElementById('titleText').textContent = files[track];
            document.getElementById('trackText').textContent = files[track];



            function nextTrack ()
            {
                if(track < files.length - 2) // limits going over the last track (-2 is ignoring the cover which is the last file in album; indexing starts  at 0)
                    track += 1;
                else 
                    track = 0;
                document.getElementById('titleText').textContent = files[track];        //reseting all data for the new song
                document.getElementById('trackText').textContent = files[track];
                document.getElementById('audiotag1').src = folder_path + files[track] + ".wav";
                document.getElementById('audiotag1').load();
                if(state == 1)      //keeps the state(pause/play)
                    document.getElementById('audiotag1').play();
            }

            function prevTrack ()
            {
                if(track > 0)
                    track -= 1;
                else
                    track = files.length -2;
                document.getElementById('titleText').textContent = files[track];
                document.getElementById('trackText').textContent = files[track];
                document.getElementById('audiotag1').src = folder_path + files[track] + ".wav";
                document.getElementById('audiotag1').load();
                if(state ==1)
                    document.getElementById('audiotag1').play();
            }

            function palyPause()
            {
                document.getElementById('titleText').textContent = files[track]; // set the correct title on entering page
                if(state == 0 )
                {
                    state = 1;
                    audio.play();
                    document.getElementById('b2').src = "assets/images/play.png";
                }
                else
                {
                    state = 0;
                    audio.pause();
                    document.getElementById('b2').src = "assets/images/pause.png";
                }
            }
        </script>
    </body>
</html>
