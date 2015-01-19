<?php

function db_open() {
    try {
        $dbh = new PDO("mysql:host=" . HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
        /*** echo a message saying we have connected ***/
        /** echo 'Connected to database'; **/
    }
    catch(PDOException $e)
        {
            echo ("error in opening database" . $e->getMessage());
        }
    return $dbh;
}

function test_input($data) {
	 $data = trim($data);
  	 $data = stripslashes($data);
 	  $data = htmlspecialchars($data);
  	  return $data;
}

function reverse_score($data) {
    switch($data) {
    case "1":
        $data = '6';
        break;
    case "2":
        $data = '5';
        break;
    case "3":
        $data = '4';
        break;
    case "4":
        $data = '3';
        break;
    case "5":
        $data = '2';
        break;
    case "6":
        $data = '1';
        break;
    }
    return $data;
}

function get_rating($score)
{
	if ($score < 25)
	{
		return "F5";
	}
	if ($score >= 25 and $score <= 33)
	{
		return "F4";
	}
	if ($score >= 34 and $score <= 42)
	{
		return "F3";
	}
	if ($score >= 43 and $score <= 50)
	{
		return "F2";
	}
	if ($score >= 51 and $score <= 59)
	{
		return "F1";
	}
	if ($score >= 60 and $score <= 68)
	{
		return "G1";
	}
	if ($score >= 69 and $score <= 77)
	{
		return "G2";
	}
	if ($score >= 78 and $score <= 86)
	{
		return "G3";
	}
	if ($score >= 87 and $score <= 95)
	{
		return "G4";
	}
	if ($score >= 96)
	{
		return "G5";;
	}
}

function get_cid($c_id) {
    //echo("qq=" . $c_id);
    $db = db_open();
    $sql  = "SELECT id, name from customers where password='" . $c_id . "'";
    $stmt = $db->prepare($sql);
    //$stmt->execute(array(
    //       ":p"=>$c_id
    //     ));
    $stmt->execute();
    $res = $stmt->fetch();
    return $res;
}

function save_map_form($person_data, $score_data, $score_total, $rating, $pdf_blob) {
    $db = db_open();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //check if person exists
    $sql = "select id from person where (org_id = :org_id and first_name = :f_name and last_name = :surname and email = :email)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
                         ":org_id"=>$person_data['c_id'],
                         ":f_name"=>$person_data['fname'],
                         ":surname"=>$person_data['sname'],
                         ":email"=>$person_data['email']
                         ));
    $res = $stmt->fetch(PDO::FETCH_NUM);
    if ($res > 0) // person exists
        {
            //get person.id
            $person_id = $res[0];
        }
    else
        {
            $sql = "insert into person (org_id, first_name, last_name, email) values (:org_id, :fname, :lname, :email)";
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':org_id', $person_data['c_id']);
            $stmt->bindParam(':fname', $person_data['fname']);
            $stmt->bindParam(':lname', $person_data['sname']);
            $stmt->bindParam(':email', $person_data['email']);
            $stmt->execute();
            $person_id = $db->lastInsertId('person');
        }
    //insert scores
    $sql = "insert into scores (person_id, q1, q2, q3, q4, q5, q6, q7, q8, q9, q10, q11, q12, q13, q14, q15, q16, score, rating, pdf_blob) values (:person_id, :q1, :q2, :q3, :q4, :q5, :q6, :q7, :q8, :q9, :q10, :q11, :q12, :q13, :q14, :q15, :q16, :score, :rating, :pdf_blob)";
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':person_id', $person_id);
    $stmt->bindParam(':q1', $score_data[0]);
    $stmt->bindParam(':q2', $score_data[1]);
    $stmt->bindParam(':q3', $score_data[2]);
    $stmt->bindParam(':q4', $score_data[3]);
    $stmt->bindParam(':q5', $score_data[4]);
    $stmt->bindParam(':q6', $score_data[5]);
    $stmt->bindParam(':q7', $score_data[6]);
    $stmt->bindParam(':q8', $score_data[7]);
    $stmt->bindParam(':q9', $score_data[8]);
    $stmt->bindParam(':q10', $score_data[9]);
    $stmt->bindParam(':q11', $score_data[10]);
    $stmt->bindParam(':q12', $score_data[11]);
    $stmt->bindParam(':q13', $score_data[12]);
    $stmt->bindParam(':q14', $score_data[13]);
    $stmt->bindParam(':q15', $score_data[14]);
    $stmt->bindParam(':q16', $score_data[15]);
    $stmt->bindParam(':score', $score_total);
    $stmt->bindParam(':rating', $rating); 
    $stmt->bindParam(':pdf_blob', $pdf_blob);
    $stmt->execute(); 
}

function get_imed_mail($id) {
	$db = db_open();
	$sql = "select imed_reply from customers where id = :id";
	$stmt = $db->prepare($sql);
    $stmt->execute(array(":id"=>$id));
    $res = $stmt->fetch();
    return $res;
}