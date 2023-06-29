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