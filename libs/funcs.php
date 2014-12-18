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

function save_customer($company_name, $email, $contact_name, $passwd, $imed_reply) {
    $db = db_open();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "INSERT INTO customers(name, email, contact, password, imed_reply) VALUES (
    :name, :email, :contact_name, :passwd, :imed_reply)";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
                         ":name"=>$company_name,
                         ":email"=>$email,
                         ":contact_name"=>$contact_name,
                         ":passwd"=>$passwd,
                         ":imed_reply"=>$imed_reply
                         ));
}

function update_customer($id, $company_name, $email, $contact_name, $passwd, $imed_reply) {
    $db = db_open();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "update customers set name = :name, email = :email, contact = :contact_name, password = :passwd, imed_reply = :imed_reply where id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
                         ":id"=>$id,
                         ":name"=>$company_name,
                         ":email"=>$email,
                         ":contact_name"=>$contact_name,
                         ":passwd"=>$passwd,
                         ":imed_reply"=>$imed_reply
                         ));
}

function delete_customer($id) {

    $db = db_open();
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "delete from customers where id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
                         ":id"=>$id
                         ));
}

function list_customers() {
    $res = array();
    $db = db_open();
    $sql = "select * from customers order by name asc";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $rows = $stmt->fetchall();
    
    foreach ($rows as $row)
        {
            $sql = "select count(p.id) as person_count from customers c inner join person p on c.id = p.org_id where c.id =" . $row['id'];
            $stmt = $db->prepare($sql);
            $stmt->execute();
            $rows2 = $stmt->fetch();
            $p_count = $rows2[0];
                   
            $sql = "select count(s.id) as score_count from customers c inner join person p on c.id = p.org_id inner join scores s on p.id = s.person_id where c.id =" . $row['id'];

            $stmt = $db->prepare($sql);
            $stmt->execute();
            $rows3 =  $stmt->fetch();
            $reply_count = $rows3[0];

            $ans = array(
                         'person_count'=>$p_count,
                         'reply_count'=>$reply_count
                         );
            
            $res[] = $row + $ans;
           
           }
    //}
    return $res;    
}

function get_imed_mail($id) {
	$db = db_open();
	$sql = "select imed_reply from customers where id = :id";
	$stmt = $db->prepare($sql);
    $stmt->execute(array(":id"=>$id));
    $res = $stmt->fetch();
    return $res;
}

function get_users($id) {
    $res = array();
    $db = db_open();
    $sql = "select p.id, p.first_name, p.last_name, p.email from customers c inner join person p on c.id = p.org_id where c.id = :id";
    $stmt = $db->prepare($sql);
     $stmt->execute(array(
           ":id"=>$id
         ));
     $rows = $stmt->fetchall();
     foreach ($rows as $row)
         {
             $sql = "select count(*) as score_count from scores where person_id = " . $row['id'];
             $stmt = $db->prepare($sql);
             $stmt->execute();
             $s_count = $stmt->fetch();
             $res[] = $row + $s_count;
         }
     return $res;
}
function generate_password($len = 8) {  
    $chars = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ!@#');  
    $pwd = '';  
      
    for($i=0; $i < $len; $i++)  
    $pwd .= $chars[rand(1, sizeof($chars)) -1];  
    return $pwd;  
    }  

function get_cid($c_id) {
    $db = db_open();
    $sql  = "SELECT id, name from customers where password=:p";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
           ":p"=>$c_id
         ));
    $res = $stmt->fetch();
    return $res;
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

function get_customer($id) {
    $db = db_open();
    $sql  = "SELECT * from customers where id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
           ":id"=>$id
         ));
    $res = $stmt->fetch();
    return $res;
}

function cust_graph_data($id) {
    
    $db = db_open();
    $f5 = 0;
    $f4 = 0;
    $f3 = 0;
    $f2 = 0;
    $f1 = 0;
    $g1 = 0;
    $g2 = 0;
    $g3 = 0;
    $g4 = 0;
    $g5 = 0;
    $sql = "select id from person where org_id = :c_id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
           ":c_id"=>$id
         ));
    $rows = $stmt->fetchall();
    foreach ($rows as $row)
        {
            $sql = "select score from scores where person_id = :p_id";
            $stmt = $db->prepare($sql);
            $stmt->execute(array(
                           ":p_id"=>$row['id']
                                 ));
            $rows2 = $stmt->fetchall();
            foreach ($rows2 as $row2)
                {
                    
                    if ($row2['score'] < 25)
                        {
                            $f5 = $f5 + 1;
                        }
                    elseif ($row2['score'] >= 25 and $row2['score'] <= 33)
                        {
                            $f4 = $f4 + 1;
                        }
                    elseif ($row2['score'] >= 34 and $row2['score'] <= 42)
                        {
                            $f3 = $f3 + 1;
                        }
                    elseif ($row2['score'] >= 43 and $row2['score'] <= 50)
                        {
                            $f2 = $f2 + 1;
                        }
                    elseif ($row2['score'] >= 51 and $row2['score'] <= 59)
                        {
                            $f1 = $f1 + 1;
                        }
                    elseif ($row2['score'] >= 60 and $row2['score'] <= 68)
                        {
                            $g1 = $g1 + 1;
                        }
                    elseif ($row2['score'] >= 69 and $row2['score'] <= 77)
                        {
                            $g2 = $g2 + 1;
                        }
                    elseif ($row2['score'] >= 78 and $row2['score'] <= 86)
                        {
                            $g3 = $g3 + 1;
                        }
                    elseif ($row2['score'] >= 87 and $row2['score'] <= 95)
                        {
                            $pg = "G4";
                        }
                    elseif ($row2['score'] >= 96)
                        {
                            $g5 = $g5 + 1;
                        }
                }
        }
    $res = array(
                 'F5'=>$f5,
                 'F4'=>$f4,
                 'F3'=>$f3,
                 'F2'=>$f2,
                 'F1'=>$f1,
                 'G1'=>$g1,
                 'G2'=>$g2,
                 'G3'=>$g3,
                 'G4'=>$g4,
                 'G5'=>$g5
                 );
    return $res;
    
}

function get_rating($score)
{
	if ($row2['score'] < 25)
	{
		return "F5";
	}
	if ($row2['score'] >= 25 and $row2['score'] <= 33)
	{
		return "F4";
	}
	if ($row2['score'] >= 34 and $row2['score'] <= 42)
	{
		return "F3";
	}
	if ($row2['score'] >= 43 and $row2['score'] <= 50)
	{
		return "F2";
	}
	if ($row2['score'] >= 51 and $row2['score'] <= 59)
	{
		return "F1";
	}
	if ($row2['score'] >= 60 and $row2['score'] <= 68)
	{
		return "G1";
	}
	if ($row2['score'] >= 69 and $row2['score'] <= 77)
	{
		return "G2";
	}
	if ($row2['score'] >= 78 and $row2['score'] <= 86)
	{
		return "G3";
	}
	if ($row2['score'] >= 87 and $row2['score'] <= 95)
	{
		return "G4";
	}
	if ($row2['score'] >= 96)
	{
		return "G5";;
	}
}

