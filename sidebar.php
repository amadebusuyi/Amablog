<div class="col-lg-4">
                  <div class="blog_right_sidebar">
                     <!-- <aside class="single_sidebar_widget search_widget">
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="Search Posts">
                           <span class="input-group-btn">
                           <button class="btn btn-default" type="button">
                           <i class="lnr lnr-magnifier"></i>
                           </button>
                           </span>
                        </div>
                        <div class="br"></div>
                     </aside> -->
                     <?php if(isset($_SESSION['user'])): ?>
                        <aside class="single_sidebar_widget author_widget">
                           <img class="author_img rounded-circle" src="https://preview.colorlib.com/theme/parason/img/blog/author.png" alt="">
                           <h4><?php echo $_SESSION['firstname']." ".$_SESSION['lastname']; ?></h4>
                           <h6><small><?php echo $_SESSION['email']; ?></small></h6>
                           <p>Total posts count: <?php 
                                 $conn = $pdo->open();

                                 $query = $conn->prepare("SELECT count(*) as count from posts where created_by = :user");
                                 $query->execute(["user"=>$_SESSION['user_id']]);

                                 echo $query->fetch()['count'];

                                 $pdo->close();
                            ?>
                           </p>
                           <p><a href="<?php echo $path."sign-out"; ?>" style="color: #700895">Sign Out</a></p>
                           <div class="br"></div>
                        </aside>
                     <?php endif; ?>
                     <aside class="single_sidebar_widget popular_post_widget">
                        <h3 class="widget_title">Popular Posts</h3>
                        <?php 

                           $conn = $pdo->open();

                           $query = $conn->prepare("SELECT * from posts order by views desc limit 5");
                           $query->execute();
                           while($fetch = $query->fetch()){
                              echo '<div class="media post_item">
                                       <img src="'.$fetch['image'].'" alt="post">
                                       <div class="media-body">
                                          <a href="blog/'.$fetch['slug'].'">
                                             <h3>'.$fetch['title'].'</h3>
                                          </a>
                                          <p class="display-time">'.$fetch['created_at'].'</p>
                                       </div>
                                    </div>';
                           }

                           $pdo->close();

                         ?>
                        <div class="br"></div>
                     </aside>
                     
                     <aside class="single_sidebar_widget post_category_widget">
                        <h4 class="widget_title">Post Catgories</h4>
                        <ul class="list cat-list">
                           <?php 

                              $conn = $pdo->open();

                              $query = $conn->prepare("SELECT * from categories");
                              $query->execute();
                              while($fetch = $query->fetch()){
                                 $check = $conn->prepare("SELECT count(*) as count from posts where category = :cat");
                                 $check->execute(['cat'=>$fetch['name']]);
                                 $count = $check->fetch()['count'];
                                 echo '<li>
                                          <a href="category/'.strtolower($fetch['name']).'" class="d-flex justify-content-between">
                                             <p>'.$fetch['name'].'</p>
                                             <p>'.$count.'</p>
                                          </a>
                                       </li>';
                              }

                              $pdo->close();

                            ?>
                           
                        </ul>
                        <div class="br"></div>
                     </aside>
                  </div>
               </div>