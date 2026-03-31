<?php
if(session_status() == PHP_SESSION_NONE) session_start();

if(isset($_SESSION["msg_errore"]) && $_SESSION["msg_errore"] === "true"){
    unset($_SESSION["msg_errore"]);
} else {
    header("location: index.html");
    exit();
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="5;url=dashboard.php">
    <title>Errore!</title>
    <link rel="stylesheet" href="style/style_error.css">
    <script>
        let seconds = 5;
        function countdown() {
            document.getElementById('timer').innerText = seconds;
            if(seconds > 0) {
                seconds--;
                setTimeout(countdown, 1000);
            }
        }
        window.onload = countdown;
    </script>
</head>
<body>
    <div class="message">
        <h1>Errore!</h1>
        <p>Errore! Verrai reindirizzato alla dashboard tra <span id="timer">5</span> secondi.</p>
    </div>
</body>
</html>
