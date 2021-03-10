     <section class="hero-banner hero-banner--sm mb-30px">
         <div class="container">
            <div class="hero-banner--sm__content">
               <h1>Create a New Blog Post</h1>
               <nav aria-label="breadcrumb" class="banner-breadcrumb">
                  <ol class="breadcrumb">
                     <li class="breadcrumb-item"><a href="<?php echo $path.'blog'; ?>">Blog Posts</a></li>
                     <li class="breadcrumb-item active" aria-current="page">Create New Post</li>
                  </ol>
               </nav>
            </div>
         </div>
      </section>

      <section class="my-5">
         <div class="container">
            <div class="row">
               <div class="comment-form col-12">
                  <!-- <h4>Leave a Reply</h4> -->
                  <form>
                     <div class="form-inline">
                        <div class="form-group col-lg-6 col-md-6 title">
                           <input type="text" class="form-control" id="title" placeholder="Enter Title" onfocus="this.placeholder = 'Title goes here'" onblur="this.placeholder = 'Enter Title'">
                        </div>
                        <div class="form-group col-lg-6 col-md-6">
                           <select class="form-control" id="category">
                              <option value="" selected disabled>Select Category</option>
                              <?php 

                                 $conn = $pdo->open();

                                 $query = $conn->prepare("SELECT * from categories");
                                 $query->execute();
                                 while($result = $query->fetch()){
                                    echo "<option>".$result['name']."</option>";
                                 }

                                 $pdo->close();

                               ?>
                           </select>
                        </div>
                        <div class="form-group col-lg-12 col-md-12 image">
                           <input type="text" class="form-control" id="image-link" placeholder="Enter image url" onfocus="this.placeholder = 'Image url goes here'" onblur="this.placeholder = 'Enter image url'">
                        </div>
                     </div>
                     <div class="form-group col-12">
                        <div id="blog-post"></div>
                     </div>
                     <a href="#" class="button button-postComment" id="createPost">Create Post</a>
                  </form>
               </div>
            </div>
         </div>
      </section>