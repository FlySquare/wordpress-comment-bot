<?php

include('dbimport/db.php');
$link = "https://blog.reedsy.com/character-name-generator/language/turkish/";
$site = file_get_contents($link);
preg_match_all('@<h3>(.*?)</h3>@si', $site, $name);
$namecikti = implode("bolfps", $name[1]);
$namedizi = explode ("bolfps",$namecikti);
$metin = $namedizi[4];
$dizi = explode ('bolfps',$metin);
$isim = $dizi[0];
$sayi = rand(10,99);
$sayi2 = rand(10,999);
$sayi3 = rand(10,999);
$sayi4 = rand(10,999);
function sifreureteci(){
 $karakterler = "1234567890abcdefghijKLMNOPQRSTuvwxyzABCDEFGHIJklmnopqrstUVWXYZ0987654321";
 $sifre = '';
 for($i=0;$i<8;$i++)                    //Oluşturulacak şifrenin karakter sayısı 8'dir.
 {
  $sifre .= $karakterler{rand() % 72};    //$karakterler dizisinden ilk 72 karakter kullanılacak, yani hepsi.
 }
 return $sifre;                            //Oluşturulan şifre gönderiliyor.
}
$kimlik = "2521";
$query = $db->query("SELECT * FROM wp_commentmeta ORDER BY comment_id DESC LIMIT 1", PDO::FETCH_ASSOC);
if ( $query->rowCount() ){
     foreach( $query as $row ){
           $row['comment_id'];
     }
}
if (isset($_POST['yorumekle'])) {
	$query = $db->prepare("INSERT INTO wp_commentmeta SET
comment_id = :comment_id,
meta_key = :meta_key,
meta_value = :meta_value");
$insert = $query->execute(array(
      "comment_id" => $_POST['comment_id'],
      "meta_key" => "rating",
      "meta_value" => $_POST['yildiz']
));
if ( $insert ){
    $last_id = $db->lastInsertId();
}
$query = $db->prepare("INSERT INTO wp_commentmeta SET
comment_id = :comment_id,
meta_key = :meta_key,
meta_value = :meta_value");
$insert = $query->execute(array(
		"comment_id" => $_POST['comment_id'],
		"meta_key" => "verified",
		"meta_value" => "0"
));
if ( $insert ){
	$last_id = $db->lastInsertId();
}





$query = $db->prepare("INSERT INTO wp_comments SET
	comment_ID = :comment_ID,
comment_post_ID = :comment_post_ID,
comment_author = :comment_author,
comment_author_email = :comment_author_email,
comment_author_IP = :comment_author_IP,
comment_date = :comment_date,
comment_date_gmt = :comment_date_gmt,
comment_content = :comment_content,
comment_karma = :comment_karma,
comment_approved = :comment_approved,
comment_agent = :comment_agent,
comment_type = :comment_type,
comment_parent = :comment_parent,
user_id = :user_id
");
$insert = $query->execute(array(
	"comment_ID" => $_POST['comment_id'],
		"comment_post_ID" => $_POST['urunid'],
		"comment_author" => $_POST['name'],
			"comment_author_email" => $_POST['mail'],
			"comment_author_IP" => $sayi.".".$sayi2.".".$sayi3.".".$sayi4,
			"comment_date" => "2020-05-22 19:58:03",
				"comment_date_gmt" => "2020-05-22 19:58:05",
				"comment_content" => $_POST['yorum'],
				"comment_karma" => "0",
				"comment_approved" => "0",
								"comment_agent" => "Mozilla/5.0 (Linux; Android 8.1.0; SM-G610F) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.60 Mobile Safari/537.36",
				"comment_type" => "review",
					"comment_parent" => "0",
						"user_id" => "0"
));
if ( $insert ){
	$last_id = $db->lastInsertId();

}
}
$urunsor=$db->prepare("SELECT * FROM wp_posts WHERE post_type = 'product' AND post_name != '' ORDER BY ID ASC");
$urunsor->execute();
?>

<!DOCTYPE html>

<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>FlySquare eCommerce Bot</title>
  <link rel="stylesheet" href="./style.css">

</head>
<body>

<div class="login-page">
  <div class="form">

    <form method="post" class="login-form">
			<input name="comment_id" type="text" placeholder="id" value="<?php echo $row['comment_id']+1; ?>"/>
      <input name="name" type="text" placeholder="İsim" value="<?php echo $isim; ?>"/>
<input name="mail" type="text" placeholder="E-mail" value="<?php echo $sifre=sifreureteci()."@gmail.com"; ?>"/>
<input name="yildiz" type="text" placeholder="Kaç Yıldız" value="<?php echo "5" ?>"/>
<select name="urunid">
  <?php       while($uruncek=$urunsor->fetch(PDO::FETCH_ASSOC)){

    ?>

  <option value="<?php echo $uruncek['ID']; ?>"><?php echo $uruncek['ID']."-".$uruncek['post_name']; ?></option>
<?php } ?>
</select>
<input name="yorum" type="text" placeholder="Yorum"/>
      <button name="yorumekle" type="submit">Ekle</button>
      

    </form>
  </div>
</div>

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script><script  src="./script.js"></script>

</body>
</html>
