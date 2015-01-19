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

function update_user($id, $first_name, $last_name, $email) {
	$db = db_open();
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "update person set first_name = :fname, last_name = :lname, email = :email where id = :id";
	$stmt = $db->prepare($sql);
	$stmt->execute(array(
                        ":id"=>$id,
                        ":fname"=>$first_name,
						":lname"=>$last_name,
                        ":email"=>$email
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

function delete_user($id) {
	$db = db_open();
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "delete from person where id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
                         ":id"=>$id
                         ));
}

	
function list_customers() {
    $res = array();
    $db = db_open();
    $sql = "select c.*,(select count(*) from person where org_id = c.id) person_count from customers c order by c.name";
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
                   
            //$sql = "select count(s.id) as score_count from customers c inner join person p on c.id = p.org_id inner join scores s on p.id = s.person_id where c.id =" . $row['id'];

            //$stmt = $db->prepare($sql);
            //$stmt->execute();
            //$rows3 =  $stmt->fetch();
            //$reply_count = $rows3[0];

            //$ans = array(
            //             'person_count'=>$p_count,
            //             'reply_count'=>$reply_count
            //             );
            
            $res[] = $row;// + $ans;
           
           }
    //}
    return $res;    
}



function get_user($id) {
	$db = db_open();
	$sql = "select * from person where id = :id";
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
             $sql = "select score, rating from scores where person_id = " . $row['id'];
             $stmt = $db->prepare($sql);
             $stmt->execute();
             $s_count = $stmt->fetch();
             $res[] = $row + $s_count;
         }
     return $res;
}
function generate_password($len = 12) {  
    $chars = str_split('0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ');  
    $pwd = '';  
      
    for($i=0; $i < $len; $i++)  
    $pwd .= $chars[rand(1, sizeof($chars)) -1];  
    return $pwd;  
    }  


function get_scores($id) {

    $db = db_open();
    $sql = "select * from scores where person_id = :id";
    $stmt = $db->prepare($sql);
    $stmt->execute(array(
           ":id"=>$id
         ));
    $res = $stmt->fetch();
    return $res;
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



