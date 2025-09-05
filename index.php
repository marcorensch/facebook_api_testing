<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Meine Webseite</title>
    </head>
    <body>
        <header>
            <h1>Facebook API Proof of Concept</h1>
        </header>

        <main>

            <form action="process.php" method="POST" target="_blank">
            <fieldset>
                    <input type="text" name="app_id" placeholder="App ID">
                    <textarea name="app_secret" placeholder="App Secret"></textarea>
                    <textarea name="short_user_token" placeholder="Short User Token"></textarea>
                </fieldset>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>

            <form action="getPosts.php" method="POST" target="_blank">
                <fieldset>
                    <input name="page_id" placeholder="Page ID" />
                    <textarea name="access_token" placeholder="Access Token"></textarea>
                </fieldset>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>

        </main>

        <footer>

        </footer>
    </body>
</html>