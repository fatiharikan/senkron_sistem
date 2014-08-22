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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
  $insertSQL = sprintf("INSERT INTO ders_kayit (kayit_hafta, kayit_adi, kayit_hoca, kayit_sure, kayit_katilim, katiy_not) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kayit_hafta'], "text"),
                       GetSQLValueString($_POST['kayit_adi'], "text"),
                       GetSQLValueString($_POST['kayit_hoca'], "text"),
                       GetSQLValueString($_POST['kayit_sure'], "int"),
                       GetSQLValueString($_POST['kayit_katilim'], "int"),
                       GetSQLValueString($_POST['katiy_not'], "text"));

  mysql_select_db($database_senkron, $senkron);
  $Result1 = mysql_query($insertSQL, $senkron) or die(mysql_error());

  $insertGoTo = "deneme.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO ders_kayit (kayit_hafta, kayit_adi, kayit_hoca, kayit_sure, kayit_katilim, katiy_not) VALUES (%s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kayit_hafta'], "text"),
                       GetSQLValueString($_POST['kayit_adi'], "text"),
                       GetSQLValueString($_POST['kayit_hoca'], "text"),
                       GetSQLValueString($_POST['kayit_sure'], "int"),
                       GetSQLValueString($_POST['kayit_katilim'], "int"),
                       GetSQLValueString($_POST['katiy_not'], "text"));

  mysql_select_db($database_senkron, $senkron);
  $Result1 = mysql_query($insertSQL, $senkron) or die(mysql_error());

  $insertGoTo = "giris.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_senkron, $senkron);
$query_derskayit = "SELECT * FROM ders_kayit";
$derskayit = mysql_query($query_derskayit, $senkron) or die(mysql_error());
$row_derskayit = mysql_fetch_assoc($derskayit);
$totalRows_derskayit = mysql_num_rows($derskayit);

mysql_select_db($database_senkron, $senkron);
$query_akademisyen = "SELECT * FROM akademisyen";
$akademisyen = mysql_query($query_akademisyen, $senkron) or die(mysql_error());
$row_akademisyen = mysql_fetch_assoc($akademisyen);
$totalRows_akademisyen = mysql_num_rows($akademisyen);

mysql_select_db($database_senkron, $senkron);
$query_bolumler = "SELECT * FROM bolumler";
$bolumler = mysql_query($query_bolumler, $senkron) or die(mysql_error());
$row_bolumler = mysql_fetch_assoc($bolumler);
$totalRows_bolumler = mysql_num_rows($bolumler);

mysql_select_db($database_senkron, $senkron);
$query_dersler = "SELECT * FROM dersler";
$dersler = mysql_query($query_dersler, $senkron) or die(mysql_error());
$row_dersler = mysql_fetch_assoc($dersler);
$totalRows_dersler = mysql_num_rows($dersler);
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
        <form class="form-horizontal" action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
          <table class="form-group" align="center">
            <tr valign="baseline">
              <td class="col-sm-2 control-label" nowrap="nowrap"  align="right">Hafta </td>
              <td ><select class="form-control" name="kayit_hafta">
                  <option>1.Hafta</option>
                  <option>2.Hafta</option>
                  <option>3.Hafta</option>
                  <option>4.Hafta</option>
                  <option>5.Hafta</option>
                  <option>6.Hafta</option>
                  <option>7.Hafta</option>
                  <option>8.Hafta</option>
                  <option>9.Hafta</option>
                  <option>10.Hafta</option>
                  <option>11.Hafta</option>
                  <option>12.Hafta</option>
                  <option>13.Hafta</option>
                  <option>14.Hafta</option>
              </select></td>
            </tr>
            <tr valign="baseline">
              <td class="col-sm-2 control-label" nowrap="nowrap" align="right">Ders Adı </td>
              <td ><select class="form-control" name="kayit_adi">
                <?php 
do {  
?>
                <option value="<?php echo $row_dersler['ders_adi']?>" ><?php echo $row_dersler['ders_adi']?></option>
                <?php
} while ($row_dersler = mysql_fetch_assoc($dersler));
?>
              </select></td>
            </tr>
            <tr> </tr>
            <tr valign="baseline">
              <td class="col-sm-2 control-label" nowrap="nowrap" align="right">Akademisyen </td>
              <td><select class="form-control" name="kayit_hoca">
                <?php 
do {  
?>
                <option value="<?php echo $row_akademisyen['akad_adi']?>" ><?php echo $row_akademisyen['akad_adi']?></option>
                <?php
} while ($row_akademisyen = mysql_fetch_assoc($akademisyen));
?>
              </select></td>
            </tr>
            <tr> </tr>
            <tr valign="baseline">
              <td class="col-sm-2 control-label" nowrap="nowrap" align="right">Süre </td>
              <td><select class="form-control" name="kayit_sure">
                  <option>10</option>
                  <option>15</option>
                  <option>20</option>
                  <option>25</option>
                  <option>30</option>
                  <option>35</option>
                  <option>40</option>
                  <option>45</option>
                  <option>50</option>
                  <option>55</option>
                  <option>60</option>
                  <option>65</option>
                  <option>70</option>
                  <option>75</option>
                  <option>80</option>
                  <option>85</option>                  
                  <option>90</option>
                  <option>95</option>
                  <option>100</option>
                  <option>110</option>
                  <option>120</option>
                  <option>130</option>
                  <option>140</option>
                  <option>150</option>
                  <option>160</option>
                  <option>175</option>                  
                  <option>190</option>
                  <option>200</option>                  
              </select></td>
            </tr>
            <tr valign="baseline">
              <td class="col-sm-2 control-label" nowrap="nowrap" align="right">Katılım </td>
              <td><select class="form-control" name="kayit_katilim">
                  <option>1</option>
                  <option>2</option>
                  <option>3</option>
                  <option>4</option>
                  <option>5</option>
                  <option>6</option>
                  <option>7</option>
                  <option>8</option>
                  <option>9</option>
                  <option>10</option>
                  <option>11</option>
                  <option>12</option>
                  <option>13</option>
                  <option>14</option>
                  <option>15</option>
                  <option>16</option>
                  <option>17</option>
                  <option>18</option>
                  <option>19</option>
                  <option>20</option>
                  <option>22</option>
                  <option>24</option>
                  <option>26</option>
                  <option>28</option>
                  <option>30</option>
                  <option>33</option>
                  <option>36</option>
                  <option>39</option>
                  <option>42</option>
                  <option>45</option>
                  <option>50</option>
                  <option>55</option>
                  <option>60</option>
                  <option>65</option>
                  <option>70</option>
                  <option>75</option>
                  <option>80</option>
                  <option>85</option>
                  <option>90</option>
                  <option>95</option>
                  <option>100</option>
                  <option>110</option>
                  <option>120</option>
                  <option>130</option>
                  <option>140</option>
                  <option>150</option>
                  <option>160</option>
                  <option>170</option>
                  <option>175</option>
                  <option>180</option>
                  <option>190</option>
                  <option>200</option>
                  <option>220</option>
                  <option>240</option>
                  <option>250</option>
                  <option>270</option>
                  <option>290</option>
                  <option>300</option>
                  <option>325</option>
                  <option>350</option>
                  <option>375</option>
                  <option>400</option>
                  <option>425</option>
                  <option>450</option>
                  <option>475</option>
                  <option>500</option>
                  <option>525</option>
                  <option>550</option>
                  <option>575</option>
                  <option>600</option>
              </select></td>
            </tr>
            <tr valign="baseline">
              <td class="col-sm-2 control-label" nowrap="nowrap" align="right" valign="top">Not </td>
              <td><textarea class="form-control" name="katiy_not" cols="50" rows="5"></textarea></td>
            </tr>
            <tr valign="baseline">
              <td nowrap="nowrap" align="right">&nbsp;</td>
              <td><input type="submit" value="Insert record" /></td>
            </tr>
          </table>
          <input type="hidden" name="MM_insert" value="form1" />
        </form>
        <p>&nbsp;</p>
      </div>
            

          
    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  
    



    
</body>
</html>
<?php
mysql_free_result($derskayit);

mysql_free_result($akademisyen);

mysql_free_result($bolumler);

mysql_free_result($dersler);
?>
t 