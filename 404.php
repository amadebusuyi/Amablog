    <?php 
        $home_page = $path."blog";
        $home_name = "Blog Posts";

        GLOBAL $url;
    ?>

      <main class="side-main">
         <section class="hero-banner auth-banner">
            <div class="container" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0;">
               <div class="row" style="height: 100vh; position: relative;">

                  <div class="auth-form">
                     <div>
                        <div class="py-5 px-2" style="background: rgba(255,255,255,0.7); border-radius: 10px; margin-bottom: -10px">
                           <h2 class="text-center icon"><a href="./">AMABLOG</a></h2>
                           <div class="form-data mt-5">
                              <h2 class="text-center">404 | Page not found</h2>
                              <h5 class="my-5 text-center">Oops! The page you requested for was not found, we'll probably put it up soon ):</h5>
                              <p class="text-center">...<?php echo $url; ?></p>
                              <div class="text-center mt-4 pt-2">
                                 <button style="cursor: pointer" class="mb-3 button button-light 404btn" onclick="history.back();">Take me back</button>
                              </div>
                              <div class="mt-4 text-center">
                                <a href="<?php echo $home_page.""; ?>" style="cursor: pointer" class="mb-3 404btn">Go to <?php echo $home_name; ?> </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </section>
      </main>