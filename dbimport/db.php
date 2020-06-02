<?php
try {
     $db = new PDO("mysql:host=37.247.103.195;dbname=hediyel3_wo", "hediyel3", "*82ZTo2.umHT9n",array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8") );

} catch ( PDOException $e ){
     print $e->getMessage();
}
?>
