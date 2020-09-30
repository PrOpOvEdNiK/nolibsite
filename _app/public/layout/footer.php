<?php

use BS\Facades\Config;

?>
</main>
<footer class="app__footer">
    <div class="container">
        <div class="row jcsb">
            <div class="footer__copyright">
                <?= Config::getAppName(); ?> &copy; BS <?= date('Y'); ?>
            </div>
        </div>
    </div>
</footer>
<script src="<?= APP_ASSETS_PATH ?>/js/app.js<?= BS\App\Assets::getVersion() ?>"></script>
</body>
</html>
