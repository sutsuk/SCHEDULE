<?php
  if(empty($_SERVER['HTTPS'])){
    header('Location: https://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF']);
  }
?>
<?php
  if(!empty($_GET['usr']) && !empty($_GET['data'])){
    chdir('data');
    $frw = fopen($_GET['usr'], "r");
    $fwt = fopen(sprintf("%s_tmp", $_GET['usr']), "w");
    $wr = 0;
    while(1){
      $tmp = str_replace("\r", "", str_replace("\n", "", fgets($frw)));
      if(feof($frw)){
        break;
      }
      $cmp = explode(';', str_replace("/", "", $tmp));
      $cmp0 = intval(sprintf("%d", $cmp[0]));
      $cmp = explode(';', str_replace("/", "", $_GET['data']));
      $cmp1 = intval(sprintf("%d", $cmp[0]));
      if($cmp0 > $cmp1 && $wr == 0){
        $wr = 1;
        fwrite($fwt, sprintf("%s\n", $_GET['data']));
        fwrite($fwt, sprintf("%s\n", $tmp));
      }else{
        fwrite($fwt, sprintf("%s\n", $tmp));
      }
    }
    if($wr == 0){
      fwrite($fwt, sprintf("%s\n", $_GET['data']));
    }
    fclose($fwt);
    fclose($frw);
    unlink($_GET['usr']);
    rename(sprintf("%s_tmp", $_GET['usr']), $_GET['usr']);
    chdir('../');
  }
?>
<?php
  if(!empty($_GET['usr']) && !empty($_GET['erase'])){
    chdir('data');
    $frw = fopen($_GET['usr'], "r");
    $fwt = fopen(sprintf("%s_tmp", $_GET['usr']), "w");
    $wr = 0;
    while(1){
      $tmp = str_replace("\r", "", str_replace("\n", "", fgets($frw)));
      if(feof($frw)){
        break;
      }
      if($tmp != $_GET['erase']){
        fwrite($fwt, sprintf("%s\n", $tmp));
      }
    }
    fclose($fwt);
    fclose($frw);
    unlink($_GET['usr']);
    rename(sprintf("%s_tmp", $_GET['usr']), $_GET['usr']);
    chdir('../');
  }
?>
<?php
  if(!empty($_GET['usr'])){
    $frw = fopen("usr", "r");
    while(!(feof($frw))){
      $usr = str_replace("\r", "", str_replace("\n", "", fgets($frw)));
      if($usr == $_GET['usr']){
        $log = 1;
        break;
      }
    }
    fclose($frw);
    if($log <> 1){
      $frw = fopen("usr", "a");
      fwrite($frw, $_GET['usr'] . "\n");
      fclose($frw);
      chdir('data');
      touch($_GET['usr']);
      chdir('../');
    }
  }else{
    echo('<script type="text/javascript">alert("Specify username as follows' . "'?usr=<username>'" . '");</script>');
    exit();
  }
?>
<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta name="robots" content="noindex,nofollow,noarchive">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SCHEDULE</title>
    <link rel="stylesheet" href="schedule.css">
    <script type="text/javascript" src="schedule.js"></script>
    <script type="text/javascript">
<?php
  chdir('data');
  $frw = fopen($_GET['usr'], "r");
  while(!(feof($frw))){
    $data = explode(";", str_replace("\r", "", str_replace("\n", "", fgets
($frw))));
    $date = explode("/", $data[0]);
    if(!empty($date[0])){
      echo('year.push(' . $date[0] . ');');
      echo('month.push(' . $date[1] . ');');
      echo('day.push(' . $date[2] . ');');
      echo('evnt.push("' . $data[1] . '");');
    }
  }
  fclose($frw);
  chdir('../');
?>
<?php
  if(!empty($_GET['show'])){
    $showym = explode(',', $_GET['show']);
    echo('showy = ' . $showym[0] . ';');
    echo('showm = ' . $showym[1] . ';');
  }
?>
    </script>
  </head>
  <body onload="init()">
    <div>
      <h1 class="heading">SCHEDULE</h1>
    </div>
    <table border=1 id="tab" style="font-size:small;">
      <tr>
        <th>SUN</th>
        <th>MON</th>
        <th>TUE</th>
        <th>WED</th>
        <th>THU</th>
        <th>FRI</th>
        <th>SUT</th>
     </tr>
    </table>
  </body>
</html>

