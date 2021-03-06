<?php
require_once("functions.php");
$internship = false;
if (isset($_GET['internship_id']) && $_GET['internship_id']) $internship = getInternship($_GET['internship_id']);
if (!$internship) { header("Location: search.php"); exit; }


$required_fields = array("mobile", "internship_id");
if ($_POST)
{
	$errors = checkRequiredFields($required_fields, $_POST);
	if (!$errors)
	{
		$mobile = $_POST['mobile'];
		$show_email = isset($_POST['show_email'])? 1 : 0;
		$internship_id = $_POST['internship_id'];
		$application = getApplication($internship_id, $_SESSION['user']['id']);
		if (!$application)
		{
			$poster = getPoster($internship_id);
			if ($poster)
			{
				if (isset($_FILES['cv_file']) && $_FILES['cv_file'])
				{
					$temp_path = $_FILES['cv_file']['tmp_name'];
					$finfo = finfo_open(FILEINFO_MIME_TYPE);
					if (finfo_file($finfo, $temp_path) == "application/pdf")
					{
						mysql_insert("application", array(
							"user_id" => $_SESSION['user']['id'],
							"internship_id" => $internship_id,
							"mobile" => $mobile,
							"show_email" => $show_email,
							"cv" => file_get_contents($temp_path)
						));
						sendNotification($poster['user_id'], "You received a new application for <b>".$poster['role']."</b> at <b>".$poster['company']."</b>", "application.php?internship_id=".$internship_id);
						$_SESSION['success'][] = "You have applied to this internship successfully";
					}
					else
					{
						$errors[] = "Your CV has to be a valid PDF file. Please try again.";
					}
				}
				else 
				{
					$errors[] = "The CV file was left blank.";
				}
			}
			else
			{
				$errors[] = "You cannot apply to a position you posted.";
			}
		}
		else
		{
			$errors[] = "You have already applied for this position";
		}
	}

}
else if (isset($_GET['internship_id']) && $_GET['internship_id'])
{
	$application = getApplication($_GET['internship_id'], $_SESSION['user']['id']);
	if ($application) $errors[] = "You have already applied for this position";
	if (getPoster($_GET['internship_id']) == $_SESSION['user']['id']) $errors[] = "You cannot apply to a position you posted.";
}
?>