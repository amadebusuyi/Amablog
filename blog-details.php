      <section class="hero-banner hero-banner--sm mb-30px">
         <div class="container">
            <div class="hero-banner--sm__content">
               <h1><?php 
                     $conn = $pdo->open();

                     $query = $conn->prepare("SELECT * from posts where slug = :slug");
                     $query->execute(["slug"=> $_link2]);

                     $blog = $query->fetch();

                     $blog['views'] = $blog['views'] + 1;

                     $update = $conn->prepare("UPDATE posts set views = :views where id = :id");
                     $update->execute([
                        "views" => $blog['views'],
                        "id" => $blog['id'],
                     ]);

                     echo $blog['title'];

                     $pdo->close();

                ?></h1>
               <nav aria-label="breadcrumb" class="banner-breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?php echo $path.'blog'; ?>">Blog Posts</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Blog Details</li>
                  </ol>
               </nav>
            </div>
         </div>
      </section>
      <section class="blog_area single-post-area section-margin--medium">
         <div class="container">
            <div class="row">
               <div class="col-lg-8 posts-list">
                  <div class="single-post row">
                     <div class="col-lg-12">
                        <div class="feature-img">
                           <img class="img-fluid" src="img/blog/feature-img1.jpg" alt="">
                        </div>
                     </div>
                     <div class="col-lg-3  col-md-3">
                        <div class="blog_info text-right">
                           <div class="post_tag">
                              <a class="active" href="category/<?php echo strtolower($blog['category']); ?>"><?php echo $blog['category'] ?></a>
                           </div>
                           <ul class="blog_meta list">
                              <li>
                                 <a href="#"><?php 
                                    $conn = $pdo->open();

                                    $query = $conn->prepare("SELECT firstname, lastname from users where id = :id");
                                    $query->execute(['id'=>$blog['created_by']]);

                                    $name = $query->fetch();

                                    echo $name['firstname']." ".$name['lastname'];

                                    $pdo->close();
                                  ?>
                                 <i class="lnr lnr-user"></i>
                                 </a>
                              </li>
                              <li>
                                 <a href="#"><span class="display-time"><?php echo $blog['created_at']; ?></span>
                                 <i class="lnr lnr-calendar-full"></i>
                                 </a>
                              </li>
                              <li>
                                 <a href="#"><?php echo $blog['views'] ?> Views
                                 <i class="lnr lnr-eye"></i>
                                 </a>
                              </li>
                              <li>
                                 <a href="#"><?php 
                                    $conn = $pdo->open();

                                    $query = $conn->prepare("SELECT * from comments where post = :post");
                                    $query->execute(["post"=>$blog['id']]);
                                    $comments_count = 0;
                                    $comments = array(); 
                                    while($result = $query->fetch()){
                                       $users = $conn->prepare("SELECT firstname, lastname from users where id = :id");
                                       $users->execute(["id"=>$result["user"]]);
                                       
                                       $uname = $users->fetch();

                                       $comment["name"] = $uname['firstname']." ".$uname['lastname'];
                                       $comment['comment'] = $result['comment'];
                                       $comment['date'] = $result['created_at'];
                                       array_push($comments, $comment);
                                       $comments_count++;
                                    }

                                    echo $comments_count;

                                    $pdo->close();
                                  ?> Comments
                                 <i class="lnr lnr-bubble"></i>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-lg-9 col-md-9 blog_details">
                        <h2><?php echo $blog['title']; ?></h2>
                        <?php echo $blog['post']; ?>
                     </div>
                  </div>
                  <div class="comments-area">
                     <h4><?php echo $comments_count; ?> Comments</h4>
                     <?php 
                       
                        for ($i=0; $i < count($comments); $i++) { 
                           echo '
                                 <div class="comment-list">
                                    <div class="single-comment justify-content-between d-flex">
                                       <div class="user justify-content-between d-flex">
                                          <div class="thumb">
                                             
                                          </div>
                                          <div class="desc">
                                             <h5>
                                                <a href="#">'.$comments[$i]["name"].'</a>
                                             </h5>
                                             <p class="date display-time">'.$comments[$i]["date"].'</p>
                                             <p class="comment">
                                                '.$comments[$i]["comment"].'
                                             </p>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                           ';
                        }

                      ?>
                  </div>
                  <?php if(isset($_SESSION['user'])): ?>
                  <div class="comment-form">
                     <h4>Leave a Comment</h4>
                     <form>
                        <span id="post-id" class="d-none"><?php echo $blog['id']; ?></span>
                        <div class="form-group">
                           <textarea class="form-control mb-10" rows="5" name="message" id="comment" placeholder="Comment" onfocus="this.placeholder = 'Add a comment...'" onblur="this.placeholder = 'Add a comment...'" required=""></textarea>
                        </div>
                        <a href="#" class="button button-postComment" id="postComment">Post Comment</a>
                     </form>
                  </div>
                  <?php else: ?>
                     <p>Only logged in users can add comments</p>
                  <?php endif; ?>
               </div>
               <?php include "sidebar.php"; ?>
            </div>
         </div>
      </section>
