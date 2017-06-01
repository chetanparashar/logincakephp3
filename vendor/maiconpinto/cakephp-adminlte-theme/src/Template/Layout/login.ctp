<?php use Cake\Core\Configure; ?>
<!DOCTYPE html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>API Associates</title>  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.5 -->
  <?php echo $this->Html->css('AdminLTE./bootstrap/css/bootstrap'); ?>

	<?php echo $this->Html->css('AdminLTE.font-awesome.min.css'); ?>
   
    <!-- Ionicons -->
	<?php echo $this->Html->css('AdminLTE.ionicons.min.css'); ?>
   
  <!-- Theme style -->
  <?php echo $this->Html->css('AdminLTE.AdminLTE.min'); ?>
  <!-- iCheck -->
  <?php echo $this->Html->css('AdminLTE./plugins/iCheck/square/blue'); ?>

</head>
<body class="hold-transition login-page" style="background: #3C8DBC none repeat scroll 0% 0%;">
<div class="login-box">

  <!-- /.login-logo -->
  <div class="login-box-body">  
	<?php echo $this->fetch('content'); ?>
  </div>

  <!-- /.login-box-body -->
</div>
<?php echo $this->element('login_footer'); ?>
<!-- /.login-box -->

<!-- jQuery 2.1.4 -->
<?php echo $this->Html->script('/plugins/jQuery/jQuery-2.1.4.min'); ?>
<!-- Bootstrap 3.3.5 -->
<?php echo $this->Html->script('/bootstrap/js/bootstrap'); ?>
<!-- iCheck -->
<?php echo $this->Html->script('/plugins/iCheck/icheck.min'); ?>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' // optional
    });
  });
</script>
</body>
</html>
