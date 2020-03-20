<?php 
error_reporting(0);
require('class/News.php');
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.min.css" />
	<link rel="shortcut icon" href="images/favicon.png">
    <title>NAMDEVEL - Informasi Berita Terupdate Hari Ini</title>
  </head>
  <body style="background-color:rgb(247, 247, 247);">
<div class="container">
<div class="row justify-content-center">
<div class="col-md-6">
<div class="card">
  <div class="card-body">
  <div class="row">
    <div class="col-md-12 mb-4">
	  <center><img src="images/logo.png" style="width:80%" class="img-responsive mb-3"></center>
      <form action="" accept-charset="UTF-8" method="get">
        <div class="input-group">
          <input type="text" name="search" id="search"placeholder="Cari.." class="form-control mr-2">
          <span class="input-group-btn">
            <input type="submit" class="btn btn-warning">
          </span> 
        </div>
      </form>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12 mb-4">
	 <div class="alert alert-warning" style="padding:20px" role="alert">
 <button type="button" class="btn btn-success">Click this Ads</button><span class="text-muted float-right">Ad Placement</span>
</div>
    </div>
  </div>

<ul class="list-unstyled">
<?php 
$news = new News();
if(isset($_GET['search']) && !empty($_GET['search'])){
	$json = json_decode($news->search($_GET['search']), true);
}else{
	$json = json_decode($news->getLastesNews(), true);
}
foreach($json['News'] as $nws){
	$img = preg_match_all('|src="(.*?)"|', $nws['Html'], $out);
	$img = isset($nws['ImageGuids'][0]) ? 'https://raw.cdn.baca.co.id/' . $nws['ImageGuids'][0] : str_replace('http://','https://',$out[1][0]);
	if (filter_var($img, FILTER_VALIDATE_URL) === FALSE || preg_match('/youtube|instagram/', $img)) {
		$img = "https://encrypted-tbn0.gstatic.com/images?q=tbn%3AANd9GcSJu5uTakr8tXjBPXtRV6-iJIvR8KOSgl2Q6hmXFkvxJx2blE2G";
	}
	$article = !empty(strip_tags($nws['Html'])) ? substr(strip_tags($nws['Html']), 0, 80) : $nws['Title'];
	echo '<li class="media">
    <img src="'.$img.'" style="width:150px;height:100px" class="mr-3 img-thumbnail img-responsive" alt="'.$nws['Title'].'">
    <div class="media-body">
      <h6 class="mt-0 mb-1"><a href="'.$nws['Url'].'" title="'.$nws['Title'].'">'.$nws['Title'].'</a></h6>
	  <span class="badge badge-info mr-2"><i class="fa fa-rss mr-2"></i>'.$nws['Media'].'</span>
      '.$article.'...
    </div>
  </li><hr>';
}
?>
  

</ul>
  <div class="row">
    <div class="col-md-12 mb-4">
	 <div class="alert alert-warning" style="padding:20px" role="alert">
 <button type="button" class="btn btn-success">Click this Ads</button><span class="text-muted float-right">Ad Placement</span>
</div>
    </div>
  </div>
<a href="" class="btn btn-warning btn-block btn-lg">Reload latest news</a>
 </div>
</div>
</div>
</div>
</div>
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  </body>
</html>