<?php
$file = $theme['folder'] . DS . 'src' . DS . 'Template' . DS . 'Element' . DS . 'main_footer.ctp';

if (file_exists($file)) {
    ob_start();
    include_once $file;
    echo ob_get_clean();
} else {
?>
<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>API Panel</b> 
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="www.skilllottosolutions.com">Skill Lotto Solutions Pvt. Ltd.</a></strong> All rights
    reserved.
</footer>
<?php } ?>
