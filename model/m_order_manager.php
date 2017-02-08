<?php
if (!defined('INCLUDE_CHECK')) {
    http_response_code(404); die;
}

//Database connection
require_once ($_SERVER['DOCUMENT_ROOT'] . "/config/db_connection.php");

class OrderManager {
    //Construction
	public function __construct() {
		global $db;
		$this -> setDb($db);
	}

    //INSERT DB FUNCTION
	public function insert(Order $order) {
            $q = $this -> _db -> prepare('INSERT INTO t_order (user, status, total_price, bookqnt, deleted, order_date)
                VALUES(:user, :status, :total_price, :bookqnt, :deleted, :order_date)');
            $q -> bindValue(':user', $order ->getuser());
			$q -> bindValue(':order_date', $order ->getorder_date());
            $q -> bindValue(':status', $order -> getstatus());
            $q -> bindValue(':total_price', $order -> gettotal_price());
            $q -> bindValue(':bookqnt', $order -> getbookqnt());
            $q -> bindValue(':deleted', $order -> getdeleted());
            if ($q -> execute()) {
                //execution successfull: return last inserted id
                $return = $this -> _db -> lastInsertId();
            } else {
                //execution failed: return FALSE
                $return = FALSE;
            }
        return $return;
	}

	//UPDATE DB FUNCTION
    public function update(order $order) {
		//update table deleted attr.
		$q = $this -> _db -> prepare('UPDATE t_order SET status = :status WHERE id=:id AND deleted = 0');
		$q -> bindValue(':id', $order -> getid());
                $q -> bindValue(':status', $order -> getstatus());
                if ($q -> execute()) {
            //execution successfull: return TRUE
			$return = TRUE;
		} else {
            //execution failed: return FALSE
			$return = FALSE;
		}
		return $return;
	}

    //SELECT DB FUNCTION
	public function select() {
		$output = array();
		$q = $this -> _db -> prepare("SELECT *
                                              FROM t_order
                                              WHERE deleted = 0");
		$result = $q -> fetch(PDO::FETCH_ASSOC);
		if ($q -> execute()) {
			//execution successfull: return DB data
                        $result = $q -> fetchAll();
			$return = $result;
		} else
			//execution failed: return FALSE
			$return = FALSE;
		return $return;
	}

	//SELECT item DB FUNCTION
	public function select_item($id) {
		$q = $this -> _db -> prepare("SELECT o.id as oid, o.order_date as oorder_date, o.user as ouser, o.qnt as oqnt, o.status as ostatus, o.total_price as ototal_price, o.FK_book as oFK_book, o.deleted as odeleted, u.name as uname, u.username as uusername, u.adress as uadresse, u.npa as unpa, u.city as ucity, u.email as uemail
                                              FROM t_order as o
                                              INNER JOIN t_user as u on o.user = u.id
                                              WHERE o.deleted = 0 AND o.id = :oid");
		$q -> bindValue(':oid', $id);		
		$result = $q -> fetch(PDO::FETCH_ASSOC);
		if ($q -> execute()) {
			//execution successfull: return DB data
			$result = $q -> fetch();
			$return = $result;
		} else
			//execution failed: return FALSE
			$return = FALSE;
		return $return;
	}
        
        //SELECT item DB FUNCTION
	public function select_items(array $idArray) {
		
                //  Création de la requete
                $query = "SELECT * FROM t_order WHERE deleted = 0 AND ";
                $nbId = 1;
                foreach($idArray as $key => $value){
                    if($nbId > 1)
                        $query.= " OR ";
                    $query.= "id = :id".$nbId;
                    $nbId++;
                }
                
                //  Préparation de la requete
                $q = $this -> _db -> prepare($query);
                $nbId = 1;
                foreach($idArray as $key => $value){
                    $q -> bindValue(':id'.$nbId, $value['id']);
                    $nbId++;
                }
                
                //  Execution de la requete
		$result = $q -> fetchall(PDO::FETCH_ASSOC);
		if ($q -> execute()) {
			//execution successfull: return DB data
			$result = $q -> fetchall();
			$return = $result;
		} else
			//execution failed: return FALSE
			$return = FALSE;
                
		return $return;
	}

        public function select_by_id( $value) {
		$q = $this -> _db -> prepare("SELECT *
                                              FROM t_order
                                              WHERE deleted = 0 AND id = :id");
		$q -> bindValue(':id', $value);
		$result = $q -> fetch(PDO::FETCH_ASSOC);
		if ($q -> execute()) {
			//execution successfull: return DB data
			$result = $q -> fetchAll();
			$return = $result;
		} else
			//execution failed: return FALSE
			$return = FALSE;
		return $return;
	}
        
        public function select_by_user( $value) {
		$q = $this -> _db -> prepare("SELECT *
                                              FROM t_order
                                              WHERE deleted = 0 AND user = :user");
		$q -> bindValue(':user', $value);
		$result = $q -> fetch(PDO::FETCH_ASSOC);
		if ($q -> execute()) {
			//execution successfull: return DB data
			$result = $q -> fetchAll();
			$return = $result;
		} else
			//execution failed: return FALSE
			$return = FALSE;
		return $return;
	}
        
        public function select_by_status( $value) {
		$q = $this -> _db -> prepare("SELECT *
                                              FROM t_order
                                              WHERE deleted = 0 AND status = :status");
		$q -> bindValue(':status', $value);
		$result = $q -> fetch(PDO::FETCH_ASSOC);
		if ($q -> execute()) {
			//execution successfull: return DB data
			$result = $q -> fetchAll();
			$return = $result;
		} else
			//execution failed: return FALSE
			$return = FALSE;
		return $return;
	}
        
    //setDB
	public function setDb(PDO $db) {
		$this -> _db = $db;
	}
}

?>