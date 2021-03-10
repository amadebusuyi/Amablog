<?php 

include "../../inc/conn.php";
include "../../phpassets/functions.php";

session_start();

if(!isset($_SESSION['user'])){
	echo json_encode(["status"=>"failed", "code"=>500, "message"=>"You must be logged in to create a blog post"]);
}

else{

	if(isset($_POST["create_post"])){
		$conn = $pdo->open();

		try{
			$query = $conn->prepare("INSERT into posts (title, slug, image, post, summary, category, created_by) VALUES(:title, :slug, :image, :post, :summary, :category, :created_by)");
			$query->execute([
				"title" => trim($_POST['title']),
				"image" => trim($_POST['image']),
				"post" => trim($_POST['post']),
				"slug" => trim($_POST['slug']),
				"summary" => trim($_POST['summary']),
				"category" => trim($_POST['category']),
				"created_by" => $_SESSION['user_id'],
			]);

			echo json_encode(["status"=>"success", "message"=>"Post created successfully"]);
		}

		catch(PDOException $e){
			echo json_encode(["status"=>"failed", "message"=>"An error prevented creation of post", "error"=>$e]);
		}

		$pdo->close();
	}

	if(isset($_GET['check_slug'])){
		$conn = $pdo->open();

		$query = $conn->prepare("SELECT count(*) as count from posts where slug = :slug");
		$query->execute(["slug"=>trim($_GET['check_slug'])]);
		$count = $query->fetch()['count'];

		if($count > 0){
			echo json_encode(["status"=>"failed", "message"=>"Slug already in use"]);
		}

		else{
			echo json_encode(["status"=>"success", "message"=>"Slug is available"]);
		}


		$pdo->close();
	}

	elseif(isset($_GET['post_comment'])){
		$conn = $pdo->open();

		try{
			$query = $conn->prepare("INSERT into comments(comment, post, user) values(:comment, :post, :user)");
			$query->execute([
				"comment"=>trim($_GET['post_comment']),
				"post"=>trim($_GET['post']),
				"user"=>$_SESSION['user_id']
			]);

			echo json_encode(["status"=>"success", "message"=>"Comment was added to post"]);
		}

		catch(PDOException $e){
			echo json_encode(["status"=>"failed", "message"=>"An error prevented adding comment to post", "error"=>$e]);
		}

		$pdo->close();
	}
}

 ?>