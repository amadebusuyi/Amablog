<?php 

	if(isset($_POST["user_login"])){
		$email = strtolower(trim($_POST['email']));
		$password = $_POST['password'];

		$conn = $pdo->open();

		$query = $conn->prepare("SELECT * from users where email = :email");
		$query->execute(["email"=>$email]);
		$result = $query->fetch();

		if($result){

			if(password_verify($_POST['password'], $result['password'])){
				$_SESSION['user'] = true;
				$_SESSION['user_id'] = $result['id'];
				$_SESSION['email'] = $email;
				$_SESSION['firstname'] = $result['firstname'];
				$_SESSION['lastname'] = $result['lastname'];
				redirect("./blog");
			}

			else{
				$error = "Invalid email/password";
			}

		}

		else{
			$error = "Invalid email/password";
		}


		$pdo->close();
	}


	elseif(isset($_POST['create_account'])){

		$conn = $pdo->open();

		$query = $conn->prepare("SELECT count(*) as count from users where email = :email");
		$query->execute(["email"=>$_POST['email']]);
		$count = $query->fetch()['count'];

		if($count == 0){
			$password = password_hash($_POST['password'], PASSWORD_BCRYPT);
			try{
				$query = $conn->prepare("INSERT into users (email, password, firstname, lastname) values(:email, :password, :firstname, :lastname)");
				$query->execute([
					'email'=>$_POST['email'], 
					"password"=>$password,
					"firstname"=>trim($_POST["firstname"]),
					"lastname"=>trim($_POST["lastname"])
				]);
				$_SESSION['user_id'] = $conn->lastInsertId();
				$_SESSION['user'] = true;
				$_SESSION['firstname'] = trim($_POST["firstname"]);
				$_SESSION['email'] = trim($_POST["email"]);
				$_SESSION['lastname'] = trim($_POST["lastname"]);
				redirect("./blog");
			}

			catch(PDOException $e){
				$error = $e;
			}
		}

		else{
			$error = "Email already used by another user";
		}

		$pdo->close();

	}

 ?>