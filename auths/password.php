      <?php include "controllers/auth/auth.php"; ?>

      <main class="side-main">
         <section class="hero-banner auth-banner">
            <div class="container">
               <div class="row">

                  <div class="auth-form">
                     <div>
                        <form class="py-5 px-2 mb-5" method="POST" style="background: rgba(255,255,255,0.7); border-radius: 10px;">
                           <h2 class="text-center icon"><a href="./">AMABLOG</a></h2>
                           <div class="form-data mt-5">
                              <h3 class="text-center">Register Account</h3>

                              <p class="text-center alert-danger"><?php if(isset($error)){echo $error; unset($error);} ?></p>

                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" name="firstname" minlength="3" id="firstname" type="text" placeholder="First Name" style="height: 50px" required/>
                              </div>

                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" name="lastname" minlength="3" id="lastname" type="text" placeholder="Last Name" style="height: 50px" required/>
                              </div>

                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" name="email" id="email" type="email" placeholder="e.g hello@gmail.com" style="height: 50px; padding-right: 30px" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" required/><span class="email-ok" data-toggle="tooltip" data-placement="left"><i class="fa animate__animated"></i></span>
                              </div>

                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" name="password" minlength="8" id="password" type="password" placeholder="Account password" style="height: 50px" required/><span class="show-password email-ok"><i class="fa fa-eye"></i></span>
                              </div>
                              <div class="text-center mt-4 pt-2">
                                 <button style="cursor: pointer" name="create_account" class="mb-3 stage-three button button-light">Create account</button>
                              </div>
                              <p class="mt-4 text-center returning-user">
                                 Already have an account? <a href="./sign-in" class="color-light"> Sign In</a>
                               </p>
                           </div>
                        </form>

                           <div class="text-center col-12" style="bottom: 10px;">
                              <p style="color: #fff">By continuing on our website, you agree to our <a href="./terms-and-condition">terms and conditions</a> and <a href="./privacy">privacy policy</a></p>
                           </div>

                     </div>
                  </div>

               </div>
            </div>
         </section>
      </main>  