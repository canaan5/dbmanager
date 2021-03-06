<?php
// namespace vng\classs;

/**
 *
 */
class Dbman extends Controller {

    public function dbInfo()
    {
        $dbName = $_GET['db'];

        $d = $this->db->query("USE $dbName");
        $q = $this->db->query("SHOW TABLE STATUS");

        $data = $q->fetchAll();
        require 'views/dbinfo.php';

    }

    public function viewTable()
    {
        $dbName = $_GET['db'];
        $table = $_GET['table'];

        $q = $this->db->query("DESCRIBE $dbName.$table");

        try {

            $results = $this->db->paginate(20);

            $result = $results["result"];

            $pages = $results["pages"];
            $number = $results["number"];
            $prev = $results["prev"];
            $next = $results["next"];
            $total = $results["total"];

        } catch ( PDOException $e ) {

            $error = $e->getMessage();

        }


        $description = $q->fetchAll();
        require 'views/tableinfo.php';
    }

    public function crud() {

        echo "<pre>";
        var_dump($_REQUEST);
    }

    public function test()
    {
        // $d = $this->db->query("USE verifynigeria");
        // $d->execute();

//		$q = $this->db->query("SELECT * FROM master.user limit 1,2");

        $q = $this->db->paginate(2);

        $rows = $q->fetchAll();

        var_dump($rows);


        die;
    }
}