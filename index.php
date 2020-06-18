<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Title</title>
  <link media="all" href="./css/custom.css" rel="stylesheet">
  <script src="./js/main.bundle.js"></script>
</head>
<body>
  <h1>
    This project use css, js, php and webpack
  </h1>
  <button type="button" class="op">open form</button>
  <form method="get" id="phoneform">
    <input name='inp1' type="text">
    <input name='inp2' type="text">
    <button>send</button>

  </form>
  <a href="/?par1=1">par1</a>
  <a href="/?par2=parametr2">par2</a>
  <p><?php echo('inp1='.$_GET['inp1'])?></p>
  <p><?php if ($_GET['inp2']) echo('inp2='.$_GET['inp2']);?></p>
  <p>
    <?php if ($_GET['par2']):?>
      param2
    <?php endif;?>
    <?php if ($_GET['par1']):?>
      param1
    <?php endif;?>
  </p>
</body>
</html>