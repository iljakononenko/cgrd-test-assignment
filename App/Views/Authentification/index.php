<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="/css/styles.css">
        <link rel="icon" href="/img/logo.ico" type="image/x-icon">
        <title>cgrd - Authentification</title>
        <script src="/js/jquery-3.7.0.min.js"></script>
    </head>
    <body>
        <div class="container">
            <form action="/authentification" method="post">

                <?php if($error !== ""):?>
                    <div class="info-box error">
                        <p>
                            <?=$error?>
                        </p>
                    </div>
                <?php endif;?>

                <input class="form-input" name="username" type="text" placeholder="Username">
                <input class="form-input" name="password" type="password" placeholder="Password">
                <button class="form-submit-button">
                    Login
                </button>
            </form>
        </div>
    </body>
</html>
