<?php $argument = $request->get('name') ?>

<p>Hello <?php echo htmlspecialchars($argument, ENT_QUOTES, 'UTF-8') ?>, comment vas-tu ?</p>
