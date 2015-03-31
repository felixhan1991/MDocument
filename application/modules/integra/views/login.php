<form class="form-signin" method="post" action="<?php echo site_url()?>/integra/login/verifylogin">
        <h2 class="form-signin-heading">Selamat Datang <img style="display: block;
    margin-left: auto;
    margin-right: auto; margin-top:10px; margin-bottom:-20px"src="<?php echo base_url().APPPATH.'themes/default/views/'?>/images/logo2.png"
	width="250px" height="80px"/></h2>
		
        <div class="login-wrap">
            <?php echo validation_errors()?>
            <div class="user-login-info">
                <input name="username" type="text" class="form-control" placeholder="User Name" autofocus>
                <input name="password" type="password" class="form-control" placeholder="Kata Sandi">
            </div>
            <label class="checkbox">
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Lupa Password?</a>

                </span>
            </label>
            <button class="btn btn-lg btn-login btn-block" type="submit">Masuk</button>

            <div class="registration">
                Belum terdaftar?
                    Hubungi pihak Personalia
                
            </div>

        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->

</form>

