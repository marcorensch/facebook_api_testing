<!DOCTYPE html>
<html lang="de">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Facebook API Proof of Concept</title>
        <style>
            label {
                font-weight: bold;
                display: block;
                margin-top: 5px;
            }
            textarea {
                min-width: 300px;
                height: 100px;
            }
            form {
                margin-bottom: 40px;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>Facebook API Proof of Concept</h1>
        </header>

        <main>

            <form action="process.php" method="POST" target="_blank">
            <fieldset>
                <div>
                    <label for="app_id">App ID (1)</label>
                    <input type="text" name="app_id" placeholder="App ID">
                </div>
                <div>
                    <label for="app_secret">App Secret (2)</label>
                    <textarea name="app_secret" placeholder="App Secret"></textarea>
                </div>
                <div>
                    <label for="short_user_token">Short Lived Token (3)</label>
                    <textarea name="short_user_token" placeholder="Short User Token"></textarea>
                </div>
                </fieldset>
                <div>
                    <button type="submit">Submit</button>
                </div>
            </form>

            <form action="getPosts.php" method="POST" target="_blank">
                <fieldset>
                    <div>
                        <label for="page_id">Page ID (4)</label>
                        <input name="page_id" placeholder="Page ID" />
                    </div>
                    <div>
                        <label for="access_token">Access Token (Long Lived) (5)</label>
                        <textarea name="access_token" placeholder="Access Token"></textarea>
                    </div>
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