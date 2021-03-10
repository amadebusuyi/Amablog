<?php

    include "conn.php";

    GLOBAL $link;
    GLOBAL $_link2;
    GLOBAL $l2;
    GLOBAL $l1;
    $lcount = count($link) - $l2;
    $path = "";
    for ($i=0; $i < $lcount; $i++) { 
        $path .="../";
    }

    if(!isset($_SESSION['visited'])){
      $conn = $pdo->open();

      $query = $conn->prepare("SELECT count(*) as count from visits where token = :token");
      $query->execute(["token"=>$_SERVER['REMOTE_ADDR']]);
      $v_count = $query->fetch()['count'];  

      if($v_count == 0){

        try{
          $query = $conn->prepare("INSERT into visits (token) values (:token)");
          $query->execute(["token"=>$_SERVER['REMOTE_ADDR']]);
          $_SESSION['visited'] = true;
        }
        catch(PDOException $e){}

      }



      $pdo->close();
    }

 ?>

<!DOCTYPE html>
<html lang="en" style="background: #700895">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
      <title><?php echo $title; ?></title>
      <link rel="preconnect" href="https://fonts.gstatic.com">
      <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
      <link rel="icon" href="img/Fevicon.png" type="image/png">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/themify-icons/themify-icons.css">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/linearicons/webfont/style.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
      <!-- <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet"> -->
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/summernote/summernote.min.css">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/notifier/dist/css/notifier.css">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/animate.css/animate.min.css">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/vendor/node-waves/waves.min.css">
      <link rel="stylesheet" href="<?php echo $path; ?>assets/css/style.css">
    
   </head>
  <?php if($link[$l1] === "blog-details" || $link[$l1] === "blog" || $link[$l1] === "category"  || $link[$l1] === "new-post" ): ?>
   <body>
    <span style="display: none" id="path-route"><?php echo $path; ?></span>
      <header class="header_area">
         <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light">
               <div class="container box_1620">
                  <a class="navbar-brand logo_h" href="<?php echo $path; ?>" style="font-size: 24px; color: #fbfbfb">Amablog</a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  <span class="icon-bar"></span>
                  </button>
                  <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                     <ul class="nav navbar-nav menu_nav justify-content-end">
                        <li class="nav-item active"><a class="nav-link" href="<?php echo $path.'blog'; ?>">Blog Posts</a></li>
                        <?php if(!isset($_SESSION['user'])): ?>
                          <li class="nav-item"><a class="nav-link" href="<?php echo $path; ?>sign-in">Sign in</a></li>
                        <?php endif; ?>
                        
                     </ul>
                     <ul class="navbar-right">
                        <li class="nav-item">
                          <?php if(!isset($_SESSION['user'])): ?>
                           <a class="button button-header btn-sm bg text-center" href="<?php echo $path; ?>create-account">Get Started</a>
                          <?php else: ?>
                           <a class="button button-header btn-sm bg text-center" href="<?php echo $path; ?>new-post">+ New Post</a>
                         <?php endif; ?>
                        </li>
                     </ul>
                  </div>
               </div>
            </nav>
         </div>
      </header>
  <?php else: ?>
    <body style="overflow-y: auto;">
      
  <?php endif; ?>