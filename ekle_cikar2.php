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

  $insertGoTo = "ekle_cikar2.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_senkron, $senkron);
$query_Recordset1 = "SELECT * FROM ders_kayit";
$Recordset1 = mysql_query($query_Recordset1, $senkron) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

mysql_select_db($database_senkron, $senkron);
$query_dersler = "SELECT * FROM dersler";
$dersler = mysql_query($query_dersler, $senkron) or die(mysql_error());
$row_dersler = mysql_fetch_assoc($dersler);
$totalRows_dersler = mysql_num_rows($dersler);

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


      
      </div>
<div class="jumbotron">
      <p>&nbsp;
      </p>
      <form class="form-horizontal" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
        <table class="form-group"  align="center">
          <tr valign="baseline">
            <td class="col-sm-2 control-label"nowrap="nowrap" align="right">Ders_adi:</td>
            <td><input class="form-control" type="text" name="ders_adi" value="" size="32" /></td>
          </tr>
          <tr valign="baseline">
            <td class="col-sm-2 control-label" nowrap="nowrap" align="right">Ders_bolumu:</td>
            <td><select class="form-control" name="ders_bolumu">
              <?php 
do {  
?>
              <option value="<?php echo $row_Recordset2['bolum_id']?>" ><?php echo $row_Recordset2['bolum_adi']?></option>
              <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
            </select></td>
          </tr>
          <tr> </tr>
          <tr valign="baseline">
            <td class="col-sm-2 control-label" nowrap="nowrap" align="right">&nbsp;</td>
            <td><input class="form-control" type="submit" value="     Kaydet     " /></td>
          </tr>
        </table>
        <input class="form-control" type="hidden" name="MM_insert" value="form1" />
      </form>
      <p>&nbsp;</p>
<p>
        <script>
        $(document).ready(function () {

    (function ($) {

        $('#filter').keyup(function () {

            var rex = new RegExp($(this).val(), 'i');
            $('.searchable tr').hide();
            $('.searchable tr').filter(function () {
                return rex.test($(this).text());
            }).show();

        })

    }(jQuery));

});

      </script>
        
  </p>
  <div class="input-group"> <span class="input-group-addon">Filtre</span>

    <input id="filter" type="text" class="form-control" placeholder="sihirli sözcük ?">
</div>
  <table class="table table-striped" border="0">
  <thead align="left">
    <tr style="text-align:left">
    <th>ders_id</th>
    <th>ders_adi</th>
    <th>ders_bolumu</th>
    <th>guncelle</th>
    <th>sil</th>
  </tr>
  </thead>
<tbody align="left" class="searchable">
  <?php do { ?>
    <tr style="text-align:left">
      <td align="left"><?php echo $row_dersler['ders_id']; ?></td>
      <td align="left"><?php echo $row_dersler['ders_adi']; ?></td>
      <td align="left"><?php echo $row_dersler['ders_bolumu']; ?></td>
      <td align="left">güncelle</td>
      <td align="left">sil</td>
    </tr>
    <?php } while ($row_dersler = mysql_fetch_assoc($dersler)); ?>
</tbody>
</table>

</div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
    



    
</body>
</html>
<?php
mysql_free_result($Recordset1);

mysql_free_result($dersler);

mysql_free_result($Recordset2);
?>
t 