      <main class="side-main">
         <section class="hero-banner auth-banner">
            <div class="container" style="position: fixed; top: 0; left: 0; right: 0; bottom: 0; overflow-y: auto">
               <div class="row" style="height: 100vh; position: relative;">

                  <div class="auth-form">
                     <div>
                        <form class="py-5 px-2" style="background: rgba(255,255,255,0.7); border-radius: 10px; margin-bottom: -10px">
                           <h2 class="text-center icon"><a href="./">AMABLOG</a></h2>
                           <div class="form-data mt-5">
                              <h3 class="text-center">Enter your registered email address to continue </h3>
                              <div class="mt-4 px-4 mb-2 form" style="position: relative">
                                 <input class="mb-3 form-control custom-input" id="email" type="text" placeholder="e.g trader@coinxcrow.com" style="height: 50px; padding-right: 30px" value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email'];} ?>" /><span class="email-ok" data-toggle="tooltip" data-placement="left"><i class="fa animate__animated"></i></span>
                              </div>
                              <div class="text-center mt-4 pt-2">
                                 <button style="cursor: pointer" class="mb-3 send-code button button-light" id="continue">Send code</button>
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