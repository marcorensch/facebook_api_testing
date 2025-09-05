<?php
// Datei einbinden, die Ihre Klasse enthält
require_once 'src/Model/FacebookConnectorModel.php';

// Prüfen, ob Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formulardaten validieren und sichern
    $appId = isset($_POST['app_id']) ? trim($_POST['app_id']) : '';
    $appSecret = isset($_POST['app_secret']) ? trim($_POST['app_secret']) : '';
    $shortUserToken = isset($_POST['short_user_token']) ? trim($_POST['short_user_token']) : '';

    // Prüfen, ob alle erforderlichen Daten vorhanden sind
    if (empty($appId) || empty($appSecret) || empty($shortUserToken)) {
        die("Bitte füllen Sie alle Felder aus.");
    }

    // Ausgabe in ein HTML-Format umleiten
    ob_start();

    // Methode aufrufen
    try {
        FacebookConnectorModel::generateLongLiveToken($appId, $appSecret, $shortUserToken);
        $result = ob_get_clean();

        // HTML-Ausgabe formatieren
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Facebook Token Ergebnis</title>
            <meta charset="UTF-8">
            <style>
                pre { white-space: pre-wrap; word-break: break-all; }
                .token { background: #f5f5f5; padding: 10px; border: 1px solid #ddd; }
            </style>
        </head>
        <body>
            <h1>Facebook Token Ergebnisse</h1>
            <a href="index.php">Zurück zum Formular</a>
            <pre>' . htmlspecialchars($result) . '</pre>
        </body>
        </html>';
    } catch (Exception $e) {
        ob_end_clean();
        echo "Ein Fehler ist aufgetreten: " . $e->getMessage();
    }
} else {
    // Wenn kein POST-Request, zurück zum Formular
    header('Location: index.php');
    exit;
}
?>