<?php
require_once("functions.php");
$internship = false;
if (isset($_GET['internship_id']) && $_GET['internship_id']) $internship = getInternship($_GET['internship_id']);
if (!$internship) { header("Location: search.php"); exit; }

$application = getApplication($_REQUEST['internship_id'], $_SESSION['user']['id']);
if ($application) $errors[] = "You have already applied for this position";

$required_fields = array("mobile", "internship_id");
if ($_POST)
{
	$errors = checkRequiredFields($required_fields, $_POST);
	if (!$errors)
	{
		$mobile = $_POST['mobile'];
		$internship_id = $_POST['internship_id'];
			if (isset($_FILES['cv_file']) && $_FILES['cv_file'])
			{
				mysql_insert("application", array(
					"user_id" => $_SESSION['user']['id'],
					"internship_id" => $internship_id,
					"mobile" => $mobile,
					"cv" => file_get_contents($_FILES['cv_file']['tmp_name'])
				));
			}
			else 
			{
				$errors[] = "The CV file was left blank.";
			}
	}

}
?>