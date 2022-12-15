<?php

if (isset($_SESSION['alerterror'])) {
  $respuesta = $_SESSION['alerterror']; ?>
  <script>
    $.toast({
      heading: 'Error!',
      text: '<?php echo $respuesta ?>',
      icon: 'error',
      transition: 'plain',
      position: 'top-right',
      loaderBg: 'white'
    })
  </script>
<?php
  unset($_SESSION['alerterror']);
  
} else if (isset($_SESSION['alertsucces'])) {
  $respuesta = $_SESSION['alertsucces']; ?>
  <script>
    $.toast({
      heading: 'Bien!',
      text: '<?php echo $respuesta ?>',
      icon: 'success',
      transition: 'plain',
      position: 'top-right',
      bgColor: '#0f76bc',
      loaderBg: 'white'
    })
  </script>
<?php
  unset($_SESSION['alertsucces']);
} ?>
