
<span class="position-fixed bottom-0 end-0 me-3">
    ©Jr <?php echo date('Y'); ?>
    <button id="theme" class="btn " type="button" onclick="switch_theme('<?php echo $_SESSION['theme'] == 'light' ? 'dark' : 'light';?>')"><span style="font-size: 1.5rem;"><?php echo $_SESSION['theme'] == 'light' ? '🌚' : '🌞'; ?></span></button>
</span>

<script src="js/ajax.js"></script>