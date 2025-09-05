<?php


class FacebookConnectorModel
{

    public static function generateLongLiveToken(string $appId, string $appSecret, string $shortUserToken): void
    {

        /**
         * Facebook Page Token Generator
         * ------------------------------
         * 1. Nimm dein kurzes User Token aus dem Graph API Explorer
         * 2. Fülle App-ID und App-Secret ein
         * 3. Script liefert dir dein "never-expire" Page Access Token zurück
         */

//// Deine App-Daten
//        $appId = "DEINE_APP_ID";
//        $appSecret = "DEIN_APP_SECRET";
//
//// Hier das kurze User Token einfügen (vom Graph API Explorer)
//        $shortUserToken = "KURZES_USER_TOKEN";

// 1. Kurzes User Token in Long-Lived User Token umwandeln
        $urlUser = "https://graph.facebook.com/v19.0/oauth/access_token?" . http_build_query([
                "grant_type" => "fb_exchange_token",
                "client_id" => $appId,
                "client_secret" => $appSecret,
                "fb_exchange_token" => $shortUserToken
            ]);

        $responseUser = file_get_contents($urlUser);
        $userData = json_decode($responseUser, true);

        if (!isset($userData['access_token'])) {
            die("❌ Fehler beim Abrufen des Long-Lived User Tokens: " . $responseUser);
        }

        $longUserToken = $userData['access_token'];
        echo "✅ Long-Lived User Token: $longUserToken\n\n";

// 2. Mit Long-Lived User Token alle Seiten abrufen
        $urlPages = "https://graph.facebook.com/v19.0/me/accounts?access_token=" . $longUserToken;

        $responsePages = file_get_contents($urlPages);
        $pagesData = json_decode($responsePages, true);

        if (!isset($pagesData['data'])) {
            die("❌ Fehler beim Abrufen der Seiten: " . $responsePages);
        }

// 3. Alle Seiten und ihre Page Tokens anzeigen
        foreach ($pagesData['data'] as $page) {
            echo "📄 Seite: " . $page['name'] . " (ID: " . $page['id'] . ")\n";
            echo "🔑 Page Access Token (never-expire): " . $page['access_token'] . "\n\n";
        }

    }

    public static function getPosts(string $pageId, string $accessToken, int|null $limit = null): void
    {
        /**
         * Facebook Page Posts Fetcher
         * ----------------------------
         * Holt die letzten Beiträge einer Facebook-Seite über die Graph API.
         */

// API-URL vorbereiten
        $url = "https://graph.facebook.com/v19.0/$pageId/posts?" . http_build_query([
                "fields" => "id,message,created_time,permalink_url,full_picture,attachments{media,media_type,type,url}",
                "limit" => 10, // Anzahl der Posts (z. B. 10 letzte Posts)
                "access_token" => $accessToken
            ]);

// Request mit cURL
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

// Fehler abfangen
        if (!isset($data['data'])) {
            die("❌ Fehler beim Laden der Posts: " . $response);
        }

// Posts ausgeben
        foreach ($data['data'] as $post) {
            error_log(var_export($post, true));
            echo "📅 Datum: " . $post['created_time'] . "\n";
            echo "🖼️ Bild: " . ($post['full_picture'] ? '<img alt="Post Image" src="'.$post['full_picture'].'">' : "[Kein Text]") . "\n";
            echo "📝 Text: " . ($post['message'] ?? "[Kein Text]") . "\n";
            echo "🔗 Link: " . $post['permalink_url'] . "\n";
            echo "🔗 Attachments: " . var_export($post['attachments'],1) . "\n";
            echo "----------------------------------------\n";
        }
    }
}
