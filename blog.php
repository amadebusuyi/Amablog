      <section class="hero-banner hero-banner--sm mb-30px">
         <div class="container">
            <div class="hero-banner--sm__content">
               <h1>Check out the latest posts on Amablog</h1>
               <h6 class="mt-5">A total of <span class="unique-count"><?php 
                     $conn = $pdo->open();

                     $query = $conn->prepare("SELECT count(*) as count from visits");
                     $query->execute();
                     echo $query->fetch()['count'];

                     $pdo->close();

                ?></span> unique visitors</h6>
            </div>
         </div>
      </section>
     
      <section class="blog_area">
         <div class="container">
            <div class="row">
               <div class="col-lg-8">
                  <div class="blog_left_sidebar">
                     <?php 

                        $conn = $pdo->open();

                        $query = $conn->prepare("SELECT * from posts");
                        $query->execute();
                        while($fetch = $query->fetch()){
                           $user = $conn->prepare("SELECT firstname, lastname from users where id = :id");
                           $user->execute(['id'=>$fetch['created_by']]);
                           $info = $user->fetch();

                           $comment = $conn->prepare("SELECT count(*) as count from comments where post = :post");
                           $comment->execute(["post"=>$fetch['id']]);
                           $comment_count = $comment->fetch()['count'];

                           $admin = "";

                           if(isset($_SESSION['user']) && $fetch['created_by'] === $_SESSION['user_id']){
                              $admin = '<li style="border: 1px solid brown">
                                          <a href="edit-post/'.$fetch['slug'].'">
                                          <i class="fa fa-edit"></i>
                                          </a>
                                          <a class="delete-post" href="'.$fetch['slug'].'">
                                          <i class="lnr lnr-trash"></i>
                                          </a>
                                       </li>';
                           }
                           echo '
                              <article class="row blog_item">
                                 <div class="col-md-3">
                                    <div class="blog_info text-right">
                                       <div class="post_tag">
                                          <a class="active" href="category/'.strtolower($fetch['category']).'">'.$fetch['category'].'</a>
                                       </div>
                                       <ul class="blog_meta list">
                                          <li>
                                             <a href="user/'.$fetch['created_by'].'">'.$info['firstname']." ".$info['lastname'].'
                                             <i class="lnr lnr-user"></i>
                                             </a>
                                          </li>
                                          <li>
                                             <a href="#">
                                             <span class="display-time">'.$fetch['created_at'].'</span>
                                             <i class="lnr lnr-calendar-full"></i>
                                             </a>
                                          </li>
                                          <li>
                                             <a href="#">'.$fetch['views'].' Views
                                             <i class="lnr lnr-eye"></i>
                                             </a>
                                          </li>
                                          <li>
                                             <a href="#">'.$comment_count.' Comments
                                             <i class="lnr lnr-bubble"></i>
                                             </a>
                                          </li>
                                          '.
                                             $admin
                                          .'
                                       </ul>
                                    </div>
                                 </div>
                                 <div class="col-md-9">
                                    <div class="blog_post">
                                       <img src="'.$fetch['image'].'" alt="">
                                       <div class="blog_details">
                                          <a href="blog/'.$fetch['slug'].'">
                                             <h2>'.$fetch['title'].'</h2>
                                          </a>
                                          <p>'.$fetch['summary'].'</p>
                                          <a class="button button-blog" href="blog/'.$fetch['slug'].'">View More</a>
                                       </div>
                                    </div>
                                 </div>
                              </article>
                              <hr>
                           ';
                        }

                        $pdo->close();
                      ?>
                     <!-- <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                           <li class="page-item">
                              <a href="#" class="page-link" aria-label="Previous">
                              <span aria-hidden="true">
                              <span class="lnr lnr-chevron-left"></span>
                              </span>
                              </a>
                           </li>
                           <li class="page-item">
                              <a href="#" class="page-link">01</a>
                           </li>
                           <li class="page-item active">
                              <a href="#" class="page-link">02</a>
                           </li>
                           <li class="page-item">
                              <a href="#" class="page-link">03</a>
                           </li>
                           <li class="page-item">
                              <a href="#" class="page-link">04</a>
                           </li>
                           <li class="page-item">
                              <a href="#" class="page-link">09</a>
                           </li>
                           <li class="page-item">
                              <a href="#" class="page-link" aria-label="Next">
                              <span aria-hidden="true">
                              <span class="lnr lnr-chevron-right"></span>
                              </span>
                              </a>
                           </li>
                        </ul>
                     </nav> -->
                  </div>
               </div>
               <?php include "sidebar.php"; ?>
            </div>
         </div>
      </section>

