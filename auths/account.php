      <?php include "controllers/auth/auth.php"; ?>
      <main class="side-main">
         <section class="hero-banner auth-banner">
            <div class="container">
               <div class="row">

                  <div class="auth-form">
                     <div>
                        <form class="py-5 px-2 mb-5" method="POST" style="background: rgba(255,255,255,0.7); border-radius: 10px; margin-bottom: -10px">
                           <h2 class="text-center icon"><a href="./">AMABLOG</a></h2>
                           <div class="form-data mt-5">
                              <h3 class="text-center">Sign in to continue </h3>
                              <p class="text-center alert-danger"><?php if(isset($error)){echo $error; unset($error);} ?></p>
                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" name="email" id="email" type="text" placeholder="e.g hello@amablog.com" style="height: 50px; padding-right: 30px" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" required/><span class="email-ok" data-toggle="tooltip" data-placement="left"><i class="fa animate__animated"></i></span>
                              </div>
                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" name="password" id="password" minlength="8" type="password" placeholder="Account password" style="height: 50px" required /><span class="show-password email-ok"><i class="fa fa-eye"></i></span>
                              </div>
                              <div class="text-center mt-4 pt-2">
                                 <button type="submit" name="user_login" style="cursor: pointer" class="mb-3 button button-light">Sign In</button>
                              </div>

                              <p class="mt-4 text-center returning-user">
                                 <a href="./register" class="color-light"> Create an account instead</a>
                               </p>
                           </div>
                        </form>
                        
                     </div>
                  </div>

               </div>
            </div>
         </section>
      </main>