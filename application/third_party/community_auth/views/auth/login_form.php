<style>
    :root {
        --color-blue: #1777E5;
        --color-blue-light: #D7E8FC;
        --color-blue-ultra-light: #EDF4FC;
        --color-dark-grey: #46494D;
        --color-border: #C2D8F2;
        --color-red-light: #F2DDDA;
        --color-red: #E0351B;

        --container-width: 1080px;
        --form-control-height: 50px;

        --base-font: 'Roboto', sans-serif;
    }

    .eye {
        width: 13px;
        height: 13px;
        border: solid 1px #1777e5;
        border-radius: 75% 15%;
        transform: rotate(45deg);
        opacity: .75;
        position: absolute;
        top: 19px;
        right: 13px;
        cursor: pointer;
        z-index: 200;
    }

    .eye.closed {
        background: #1777e5;
        opacity: .5;
    }

    .eye:before {
        content: '';
        display: block;
        position: absolute;
        width: 5px;
        height: 5px;
        border: solid 1px #1777e5;
        border-radius: 50%;
        left: 3px;
        top: 3px;
    }


    .form-control {
        background-color: #fff;
        min-height: var(--form-control-height);
        color: var(--color-dark-grey);
        border: 1px solid var(--color-border);
        border-radius: 5px;
        font-size: 15px;
        padding: 12px 20px;
        font-family: var(--base-font);
        box-sizing: border-box;
    }

    .control {
        position: relative;
    }

    button.form-control {
        background: royalblue;
        color: #fff;

    }

    .rez {
        width: 200px;
        margin: 10px 0;
    }
</style>
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Community Auth - Login Form View
 *
 * Community Auth is an open source authentication application for CodeIgniter 3
 *
 * @package     Community Auth
 * @author      Robert B Gottier
 * @copyright   Copyright (c) 2011 - 2018, Robert B Gottier. (http://brianswebdesign.com/)
 * @license     BSD - http://www.opensource.org/licenses/BSD-3-Clause
 * @link        http://community-auth.com
 */

if (!isset($optional_login)) {
	echo '<h4 class="text-center mb-4">Sign in your account</h4>';
}

if (!isset($on_hold_message)) {
	if (isset($login_error_mesg)) {
		echo '
			<div class="alert alert-danger">
				<p>
					Login Error #' . $this->authentication->login_errors_count . '/' . config_item('max_allowed_attempts') . ': Invalid Username, Email Address, or Password.
				</p>
				<p>
					Username, email address and password are all case sensitive.
				</p>
			</div>
		';
	}

	if ($this->input->get(AUTH_LOGOUT_PARAM)) {
		echo '
			<div class="alert alert-success">
				<p>
					You have successfully logged out.
				</p>
			</div>
		';
	}

	echo form_open($login_url);
?>

	<div class="form-group">
		<label class="mb-1"><strong>Email Address</strong></label>
		<input type="email" name="login_string" id="login_string" class="form-control" autocomplete="off" maxlength="255">
	</div>


	<div class="form-group">
		<label class="mb-1"><strong>Password</strong></label>


		<div class="control">
			<input type="password" name="login_pass" id="login_pass" class="form-control password" <?php
																									if (config_item('max_chars_for_password') > 0)
																										echo 'maxlength="' . config_item('max_chars_for_password') . '"';
																									?> readonly="readonly" onfocus="this.removeAttribute('readonly');">
			<i class="eye showPwd"></i>
		</div>
	</div>


	<div class="form-row d-flex justify-content-between mt-4 mb-2">
		<?php
		if (config_item('allow_remember_me')) {
		?>
			<div class="form-group">
				<div class="custom-control custom-checkbox ml-1">
					<input type="checkbox" class="custom-control-input" id="remember_me" name="remember_me" value="yes">
					<label class="custom-control-label" for="remember_me">Remember my preference</label>
				</div>
			</div>

            <!-- <div class="form-group">
				<div class="custom-control custom-checkbox ml-1">
					<a href="<?php echo site_url('recover');?>">Forgot Password?</a>
				</div>
			</div> -->
		<?php
		}
		?>
		<!-- <div class="form-group">
			<a href="<?php echo site_url('recover'); ?>">Forgot Password?</a>
		</div> -->
	</div>
	<div class="text-center">
		<button type="submit" name="submit" class="btn btn-primary btn-block">Sign Me In</button>
	</div>
	</form>

<?php

} else {
	// EXCESSIVE LOGIN ATTEMPTS ERROR MESSAGE
	echo '
			<div class="alert alert-danger">
				<p>
					Excessive Login Attempts
				</p>
				<p>
					You have exceeded the maximum number of failed login<br />
					attempts that this website will allow.
				<p>
				<p>
					Your access to login and account recovery has been blocked for ' . ((int) config_item('seconds_on_hold') / 60) . ' minutes.
				</p>
				<p>
					Please use the <a href="/examples/recover">Account Recovery</a> after ' . ((int) config_item('seconds_on_hold') / 60) . ' minutes has passed,<br />
					or contact us if you require assistance gaining access to your account.
				</p>
			</div>
		';
}

/* End of file login_form.php */
/* Location: /community_auth/views/examples/login_form.php */
?>
<script>
	        let pwd = document.getElementById('login_pass'),
            eye = document.querySelector('.showPwd'),
            rez = document.querySelector('.rez'),
            btn = document.querySelector('button');

        eye.addEventListener('click', function() {
            toggleType();
        })

        pwd.addEventListener('change', function() {
            pwd.value = pwd.value.replace(/\s/g, '');
        })
        btn.addEventListener('click', function() {
            console.log('clk');
            rez.innerText = '_' + pwd.value + '_';
        })

        console.log(btn, rez, eye);


        function toggleType() {
            console.log('toggle');
            if (eye.classList.contains('closed')) {
                pwd.type = 'password';
            } else {
                pwd.type = 'text';
            }
            eye.classList.toggle('closed');
        }
</script>