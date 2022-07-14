<?php
    include('connection.php');
    if(isset($_POST['operation']))
    {
        if($_POST['operation']=="send")
        {
            $isOk = "";
            $artistName = $_POST['artistName'];
            $email = $_POST['email'];
            $songName = $_POST['songName'];
            $link = $_POST['link'];
            $adInfo = $_POST['adInfo'];
            $ip = $_SERVER['REMOTE_ADDR'];
            $date = date("Y-m-d, H:i");


            $artistName = htmlentities($artistName, ENT_QUOTES, "UTF-8");
            $email = htmlentities($email, ENT_QUOTES, "UTF-8");
            $songName = htmlentities($songName, ENT_QUOTES, "UTF-8");
            $link = htmlentities($link, ENT_QUOTES, "UTF-8");
            $adInfo = htmlentities($adInfo, ENT_QUOTES, "UTF-8");

            if(!filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $isOk = "Enter a valid email";
            }

            if($artistName=="" || $songName=="" || $link=="")
            {
                $isOk = "Fill required fields";
            }

            if($isOk=="")
            {
                if($rezultat = @$connection->query('SELECT id FROM tracks ORDER BY id DESC LIMIT 1'))
                {
                    $wiersz = $rezultat->fetch_assoc();
                    $id = $wiersz['id'] + 1;
                    $rezultat->close();
                }

                if($connection->query("INSERT INTO tracks VALUES('$id', '$artistName', '$email', '$songName', '$link', '$adInfo', '$ip', '$date')"))
                {
                    echo '<div class="resultSuccess">You submitted your track! We will response you at <b>'.$email.'</b></div>';
                    echo '
                        <script>
                            clearForm();
                        </script>
                    ';
                }

                else
                {
                    echo '<div class="resultError">Server error occurred</div>';
                }
            }

            else
            {
                echo '<div class="resultError">'.$isOk.'</div>';
            }
        }
    }

    function loadAdminPanel()
    {
        global $connection;

        $request = $connection->query("SELECT * FROM tracks");

        for($i=1;$i<=$request->num_rows;$i++)
        {
            $row = $request->fetch_assoc();

            $id = $row['id'];
            $artistName = $row['artistName'];
            $email = $row['email'];
            $songName = $row['songName'];
            $link = $row['link'];
            $adInfo = $row['adInfo'];
            $ip = $row['ip'];

            echo '
                <div style="padding:20px">
                    <b>'.$id.'</b> | <b>'.$artistName.'</b> | <b>'.$email.'</b> | <b>'.$songName.'</b> | <a href="'.$link.'" target="_blank"><b>'.$link.'</b></a> | <b>'.$adInfo.'</b> | <b>'.$ip.'</b>
                </div>
                <hr>
            ';

        }
    }
?>
