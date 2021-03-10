      <main class="side-main">
         <section class="hero-banner auth-banner">
            <div class="container">
               <div class="row">

                  <div class="auth-form">
                     <div>
                        <form class="py-5 px-2">
                           <h2 class="text-center icon"><a href="./">AMABLOG</a></h2>
                           <div class="form-data mt-5">
                                 <h3 class="text-center">Create a new password to secure your account</h3>
                              <p class="text-center"><small><strong>(<?php echo $_SESSION['email'] ?>)</strong></small></p>
                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" id="password" type="password" placeholder="Account password" style="height: 50px" /><span class="show-password email-ok"><i class="fa fa-eye"></i></span>
                              </div>
                              <p class="text-center" style="font-size: 12px; color: var(--lighter); position: relative; top: -10px; margin-right: 10px; margin-left: 10px;"> Min. of 8 characters, at least one uppercase letter, lowercase letter, number and special character</p>
                              <div class="text-center mt-4 pt-2">
                                 <button style="cursor: pointer" class="mb-3 reset-pass button button-light" id="continue">Reset Password</button>
                              </div>
                              <p class="text-center mt-4">You can <a href="<?php echo $path; ?>account">Register or Sign in</a> instead</p>
                           </div>
                        </form>
                     </div>
                  </div>

               </div>
            </div>
         </section>
      </main>  