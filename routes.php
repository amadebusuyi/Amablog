<?php 
// Application name
$sitename = "Amablog";

require "phpassets/functions.php";

$url = $_SERVER['REQUEST_URI'];
$link = explode("/", $url);
$lch = is_present($link, $sitename);
$l1 = $lch+1;
$l2 =  $lch+2;


/*
Start First Level URI Auth routes and processes
*/

if(count($link) === $l2){
	$_link = strtolower($link[$l1]);

	if($_link === "sign-out"){
		require "signout.php";
	}

	elseif($_link !== ''){

		if($_link === "blog-details"){
			$title = "Blog posts details";
			load_page(fetch_page("blog-details.php"), $title);
		}

		elseif($_link === "blog"){
			$title = "Blog posts";
			load_page(fetch_page("blog.php"), $title);
		}

		elseif($_link === "new-post"){
			$title = "Create a new post";
			load_page(fetch_page("new-blog.php"), $title);
		}

		elseif($_link === "sign-in"){
			if(isset($_SESSION['user']))
				redirect("blog");
			$title = "Login";
			load_page(fetch_page("auths/account.php"), $title);
		}

		elseif($_link === "create-account"){
			if(isset($_SESSION['user']))
				redirect("blog");
			else{
				$title = "Register";
				load_page(fetch_page("auths/password.php"), $title);
			}
		}

		elseif($_link === "account-verify"){
			if(isset($_SESSION['user']))
				redirect("blog");
			if($_SESSION['login_state'] !== "token")
				redirect("./account");
			else{
				$title = "Verify Account";
				load_page(fetch_page("auths/verify.php"), $title);	
			}
		} 

		elseif($_link === "forgot-password"){
			if(isset($_SESSION['user']))
				redirect("blog");
			$title = "Forgot password";
			load_page(fetch_page("auths/forgot.php"), $title);
		}

		elseif($_link === "verify-reset"){
			if(isset($_SESSION['user']))
				redirect("blog");
			if(!isset($_SESSION['reset_code']))
				redirect("./account");
			else{
				$title = "Verify Email";
				load_page(fetch_page("auths/reset-verify.php"), $title);	
			}
		} 

		elseif($_link === "reset-password"){
			if(isset($_SESSION['user']))
				redirect("blog");
			if(!isset($_SESSION['reset_pass']))
				redirect("./account");
			else{
				$title = "Reset Password";
				load_page(fetch_page("auths/reset.php"), $title);	
			}
		} 

		else{
			error_page();
		} 
	}
	else{
		redirect("blog");
	}
}

/*
	End First Level URI Auth routes and processes
*/

elseif(count($link) > $l2){
//second level route
/*
	Start Second Level URI Auth routes and processes
*/
	$_link = strtolower($link[$l1]);
	$_link2 = strtolower($link[$l2]);

	if($_link === "sign-out"){
		require "signout.php";
	}
	elseif($_link !== ''){
		if($_link === "blog"){
			load_page(fetch_page("./blog-details.php"), "Blog Details");
		}

		elseif($_link === "edit-post"){
			load_page(fetch_page("./edit-post.php"), "Blog Details");
		}

		else{
			error_page();
		}

	}
	else{
		error_page();
	}

}

// include "inc/footer.php";


 ?>