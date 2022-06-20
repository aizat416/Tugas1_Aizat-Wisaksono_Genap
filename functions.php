<?php
function pdo_connect_mysql() {
    $DATABASE_HOST = 'localhost';
    $DATABASE_USER = 'root';
    $DATABASE_PASS = '';
    $DATABASE_NAME = 'tugas1_aizatwisaksono_genap';
    try {
    	return new PDO('mysql:host=' . $DATABASE_HOST . ';dbname=' . $DATABASE_NAME . ';charset=utf8', $DATABASE_USER, $DATABASE_PASS);
    } catch (PDOException $exception) {
    	// If there is an error with the connection, stop the script and display the error.
    	exit('Failed to connect to database!');
    }
}
function template_header($title) {
echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>$title</title>
		<link href="style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css">
	</head>
	<body>
    <div>
    <header>
    <h1>WEBSITE SOUNDTRACK</h1>
    </header>

    <nav class="navtop">
    	<div>
            <h1>DASHBOARD</h1>
            <a href="index.php"><i class="fas fa-home"></i>Home</a>
    		<a href="read_artist.php"><i class="fas fa-address-book"></i>ARTIST</a>
            <a href="read_album.php"><i class="fas fa-address-book"></i>ALBUM</a>
            <a href="read_track.php"><i class="fas fa-address-book"></i>TRACK</a>
            <a href="read_played.php"><i class="fas fa-address-book"></i>PLAYED</a>
    	</div>
    </nav>

EOT;
}
function template_footer() {
echo <<<EOT
<div>
    <footer>
    <p>COPYRIGHT AIZAT WISAKSONO (0702192038)</p>
    </footer>
    </div>
    </body>
</html>
EOT;
}
?>