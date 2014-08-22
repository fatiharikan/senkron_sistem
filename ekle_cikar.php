<?php require_once('Connections/senkron.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO dersler (ders_adi, ders_bolumu) VALUES (%s, %s)",
                       GetSQLValueString($_POST['ders_adi'], "text"),
                       GetSQLValueString($_POST['ders_bolumu'], "text"));

  mysql_select_db($database_senkron, $senkron);
  $Result1 = mysql_query($insertSQL, $senkron) or die(mysql_error());

  $insertGoTo = "ekle_cikar.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['ders_id'])) {
  $colname_Recordset1 = $_GET['ders_id'];
}
mysql_select_db($database_senkron, $senkron);
$query_Recordset1 = sprintf("SELECT * FROM dersler WHERE ders_id = %s", GetSQLValueString($colname_Recordset1, "int"));
$Recordset1 = mysql_query($query_Recordset1, $senkron) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_senkron, $senkron);
$query_Recordset2 = "SELECT * FROM bolumler";
$Recordset2 = mysql_query($query_Recordset2, $senkron) or die(mysql_error());
$row_Recordset2 = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>

<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">
    


<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="css/bootstrap.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.css" rel="stylesheet" type="text/css" />
<link href="css/bootstrap-theme.min.css" rel="stylesheet" type="text/css" />
<script src="js/bootstrap.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-1.11.1.min.js"></script>

<script src="../../assets/js/ie-emulation-modes-warning.js"></script>

    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>


</head>

<body>

  <!-- /don't touch -->
  <!-- /don't touch -->
  <!-- /don't touch -->


 <!-- Fixed navbar -->
    <div class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Senkron Ders Bilgi Ekranı</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li><a href="giris.php"><span class="glyphicon glyphicon-floppy-open"></span></a></li>
            <li><a href="liste.php"><span class="glyphicon glyphicon-list"></span></a></li>
            <li><a href="istatistik.php"><span class="glyphicon glyphicon-signal"></span></a></li>
            <li><a href="ekle_cikar.php"><span class="glyphicon glyphicon-refresh"></span></a></li>
            
          </ul>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="../navbar/">Çıkış</a></li>
            
            
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </div>

    <div class="container">

      <!-- Main component for a primary marketing message or call to action -->

    <!-- /don't touch -->
    <!-- /don't touch -->
    <!-- /don't touch -->


<div class="jumbotron">

<ol class="breadcrumb">
  <li><a href="ekle_cikar.php">Ders</a></li>
  <li><a href="bolumduzenle.php">Bolum</a></li>
  <li><a href="hocaduzenle.php">Hoca</a></li>
  <li><a href="userduzenle.php">User</a></li>
</ol>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ders_adi:</td>
      <td><input type="text" name="ders_adi" value="" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Ders_bolumu:</td>
      <td><select name="ders_bolumu">
        <?php 
do {  
?>
        <option value="<?php echo $row_Recordset2['bolum_adi']?>" ><?php echo $row_Recordset2['bolum_adi']?></option>
        <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
      </select></td>
    </tr>
    <tr> </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Insert record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_insert" value="form1" />
</form>
<table border="1">
  <tr>
    <td>ders_id</td>
    <td>ders_adi</td>
    <td>ders_bolumu</td>
  </tr>
    <tr>
      <td><?php echo $row_Recordset1['ders_id']; ?></td>
      <td><?php echo $row_Recordset1['ders_adi']; ?></td>
      <td><?php echo $row_Recordset1['ders_bolumu']; ?></td>
    </tr>
</table>
<p>&nbsp;</p>
</div>
           

          
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
    



    
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($Recordset2);
?>
