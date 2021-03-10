      <main class="side-main">
         <section class="hero-banner auth-banner">
            <div class="container">
               <div class="row">

                  <div class="auth-form">
                     <div>
                        <form class="py-5 px-2" style="background: rgba(255,255,255,0.7); border-radius: 10px;">
                           <h2 class="text-center icon"><a href="./">AMABLOG</a></h2>
                           <div class="form-data mt-5">
                              <h3 class="text-center">Enter the six digits code sent to your email </h3>
                              <p class="text-center"><small><strong>(<?php echo $_SESSION['email'] ?>)</strong></small></p>
                              <div class="mt-3 px-4 mb-2" id="inputCodes" data-form-code="data-form-code">
                                 <input class="form-control custom-input" type="tel" maxlength="1" id="first_input"/>
                                 <input class="form-control custom-input" type="tel" maxlength="1" id="second_input"/>
                                 <input class="form-control custom-input" type="tel" maxlength="1" id="third_input"/>
                                 <input class="form-control custom-input" type="tel" maxlength="1" id="fourth_input"/>
                                 <input class="form-control custom-input" type="tel" maxlength="1" id="fifth_input"/>
                                 <input class="form-control custom-input" type="tel" maxlength="1" id="last_input"/>
                              </div>
                              <p class="err-logger text-center" style="font-size: 12px; color: red; position: relative; top: -10px;"></p>
                              <div class="text-center mt-4 pt-2">
                                 <button style="cursor: pointer" class="mb-3 reset-code button button-light" id="continue">Continue</button>
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