<html>
<head>
  <title>DiDiCo store</title>
  <link rel="stylesheet" href="styles.css">
</head>
<body>
<?php
include 'functions.php';
include 'secrets.php';

// Attempt to open a database connection
try {
  $connection = new PDO('mysql:host=localhost;dbname=passion',$dbuser,$dbpasswd);
} catch(PDOException $e){
  print "Connection failed!: ".$e->getMessage()."<br />";
  die();
}

$error_msg = "";

// Process the form where relevant
if (isset($_POST['product_name'])) {
 
  $name = $_POST['product_name'];
  $weight = $_POST['product_weight'];
  $length = $_POST['product_length'];
  $width = $_POST['product_width'];
  $height = $_POST['product_height'];

  //handle image upload

  $file_name = $_FILES['product_image']['name'];
  $target_dir = "img/";
  $target_file = $target_dir . basename($file_name);
  
  try {
   move_uploaded_file($_FILES['product_image']['tmp_name'], $target_file);
   } catch(Exception $e) {
     $error_msg .= "<li>File upload failed!</li>";
  }

  try {
  addProduct($connection,$name,$weight,$length,$width,$height,$file_name);
  } catch(Exception $e){
    $error_msg .= "<li>".$e->getMessage()."</li>";
  }

  if(empty($error_msg)){
    $msg = $name." successfully added!";
    echo json_encode(['code'=>200,'msg'=>$msg]);
    exit;
  }

  echo json_encode(['code'=>404, 'msg'=>$error_msg]);

} else {
?>
<h1>DiDiCo Product List</h1>
<div class="container">
<?php $products = getProductList($connection); ?>
<ul>
<?php foreach($products as $product){?>
  <li>
  <div class="product">
  <div class="image-wrapper">
  <img src="<?php echo "img/".$product['image'];?>" alt="<?php echo $product['name'];?>"/>
  </div>
  <div class="product-details">
  <h4><?php echo $product['name']?></h4>
  <span>Weight: <?php echo $product['weight'];?> kg</span>
  <span>Length: <?php echo $product['length'];?> cm</span>
  <span>Width: <?php echo $product['width'];?> cm</span>
  <span>Height: <?php echo $product['height'];?> cm</span>
  </div>
  </div>
  </li>
  <?php }?>
</ul>
</div>
<button title="add" onclick="showForm()">Add product</button>

<form id="the-form" action="DiDiCo.php" method="POST" enctype="multipart/form-data">
<div class="error"></div>
<p><label for="product_name">Product name:</label>
<input type="text" name="product_name" id="product_name">
</p>
<fieldset>
<legend>Measurements:</legend>
<p><label for="product_weight">Weight:</label>
<input type="number" placeholder="1.0" step="0.01" maxlength="3" name="product_weight" id="product_weight">
</p>
<p><label for="product_length">Length:</label>
<input type="number" name="product_length" id="product_length">
</p>
<p><label for="product_width">Width:</label>
<input type="number" name="product_width" id="product_width">
</p>
<p><label for="product_height">Height:</label>
<input type="number" name="product_height" id="product_height">
</p>
</fieldset>
<fieldset>
<legend>Add an image:</legend>
<p><label for="product_image">Add an image:</label>
<input type="file" name="product_image" id="product_image"
accept="image/png, image/jpeg">
</p>
</fieldset>
<input type="submit" id="submit" name="submit" value="Add Product">
</form>
<?php }?>

<script src="https://code.jquery.com/jquery-3.4.1.min.js"
 integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
 crossorigin="anonymous"></script>
<script src="js/handle-form.js"></script>
</body>
</html>
