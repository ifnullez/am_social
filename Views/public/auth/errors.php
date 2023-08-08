<?php if (!empty($signon->errors)) { ?>
    <div class="auth-errors">
        <?php foreach ($signon->errors as $errorKey => $error) { ?>
            <p class="error <?php echo str_replace(["_"], ["-"], $errorKey); ?>">
                <?php echo str_replace(["<strong>Error:</strong>"], [""], $error[0]); ?>
            </p>
        <?php } ?>
    </div>
<?php } ?>