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
<script src="<?= PATH_PUBLIC_ASSETS ?>/js/app.js<?= BS\Main\Assets::getVersion() ?>"></script>
</body>
</html>
