<?php
// namespace vng\core;

/**
 *
 */
class DB {

    private $dsn;
    private $con = false;
    private $user;
    private $pass;

    public function __construct()
    {
        if ( isset( $_SESSION["DBM_LOGIN"] ) && $_SESSION["DBM_LOGIN"] === true ) {

            $this->dsn = $_SESSION["DBM_DSN"];
            $this->user = $_SESSION["DBM_USER"];
            $this->pass = $_SESSION["DBM_PASS"];

        } elseif ( $_POST ) {

            $this->dsn = "mysql:host=".$_POST['host'];
            $this->user = $_POST["user"];
            $this->pass = $_POST["pass"];
        }

        $this->con = new PDO($this->dsn, $this->user, $this->pass);
        $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getCon()
    {
        return $this->con;
    }

    public function paginate($perpage)
    {
        $dbName = isset($_GET['db']) ? $_GET['db'] : null;
        $table = isset($_GET['table']) ? $_GET['table'] : null;

        if ( isset($_GET["page"]))
            $start = $_GET["page"];

        if ( $this->con )
        {
            $total = $this->con->query("SELECT * FROM $dbName.$table")->rowCount();

            $pages = ceil($total / $perpage);
            $getPage = isset($_GET['page']) ? $_GET["page"] : 1;

            $data = [
                'options'   => [
                    'default'   => 1,
                    'min_range'   => 1,
                    'max_range'   => $pages,
                ],
            ];

            $number = trim($getPage);
            $number = filter_var($number, FILTER_VALIDATE_INT, $data);
            $range = $perpage * ($number - 1);

            $prev = $number - 1;
            $next = $number + 1;

            $stm = $this->con->prepare("SELECT * FROM $dbName.$table LIMIT :limit, :perpage");
            $stm->bindParam(':perpage', $perpage, PDO::PARAM_INT);
            $stm->bindParam(':limit', $range, PDO::PARAM_INT);
            $stm->execute();

            $result = [
                'result'    => $stm->fetchAll(),
                'pages'     => $pages,
                'number'    => $number,
                'prev'      => $prev,
                'next'      => $next,
                'total'      => $total,
            ];

            return $result;

        }
    }

    public function isConnected()
    {
        return ( $this->con != false );
    }

    public function query($query) {

        if ( $this->con )
        {
            $q = $this->con->prepare($query);

            if ($q)
                $q->execute();

            if (!$q)
                $q->errorInfo();

            return $q;

        }

        return 'no connection';

    }
}