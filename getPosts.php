<?php
// FacebookConnectorModel einbinden
require_once 'src/Model/FacebookConnectorModel.php';

// Prüfen, ob Formular abgesendet wurde
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Formulardaten erfassen
    $pageId = isset($_POST['page_id']) ? trim($_POST['page_id']) : '';
    $accessToken = isset($_POST['access_token']) ? trim($_POST['access_token']) : '';

    // Weitere Bereinigung des Tokens (entfernt Leerzeichen, Tabs und Zeilenumbrüche)
    $accessToken = preg_replace('/\s+/', '', $accessToken);

    // Prüfen, ob alle erforderlichen Daten vorhanden sind
    if (empty($pageId) || empty($accessToken)) {
        die("Fehler: Bitte geben Sie sowohl die Page ID als auch das Access Token an.");
    }

    // Optionalen Parameter für die Anzahl der Posts prüfen
    $limit = isset($_POST['limit']) && is_numeric($_POST['limit']) ? (int)$_POST['limit'] : 10;

    // Ausgabe in ein HTML-Format umleiten
    ob_start();

    // Posts abrufen
    try {
        FacebookConnectorModel::getPosts($pageId, $accessToken, $limit);
        $result = ob_get_clean();

        // HTML-Ausgabe formatieren
        echo '<!DOCTYPE html>
        <html>
        <head>
            <title>Facebook Posts</title>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; margin: 20px; line-height: 1.6; }
                pre { white-space: pre-wrap; word-break: break-all; background: #f5f5f5; padding: 15px; border-radius: 5px; }
                .back-link { margin: 20px 0; }
                h1 { color: #4267B2; } /* Facebook-Blau */
                .post { border: 1px solid #ddd; padding: 15px; margin-bottom: 20px; border-radius: 5px; }
            </style>
        </head>
        <body>
            <h1>Facebook Posts von Seite: ' . htmlspecialchars($pageId) . '</h1>
            <div class="back-link">
                <a href="index.php">← Zurück zum Formular</a>
            </div>
            <div class="posts">
            ' . $result . '
            </div>
        </body>
        </html>';
    } catch (Exception $e) {
        ob_end_clean();
        echo "Ein Fehler ist aufgetreten: " . $e->getMessage();
        echo "<p><a href='index.php'>Zurück zum Formular</a></p>";
    }
} else {
    // Wenn kein POST-Request, zurück zum Formular
    header('Location: index.php');
    exit;
}
?>