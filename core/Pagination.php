<?php

/**
 * Created by PhpStorm.
 * User: kesty
 * Date: 12/3/15
 * Time: 11:01 AM
 */
class Pagination
{

    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function paging($query, $perPage)
    {
        $start = 0;
        if ( isset($_GET["page"]) )
        {
            $start = ($_GET["page"] - 1) * $perPage;
        }

        $query2 = $query." limit $start, $perPage";

        return $query2;
    }

    public function paginglink($query, $perPage)
    {

        $self = $_SERVER['REQUEST_URI'];

        $stmt = $this->db->prepare($query);
        $stmt->execute();

        $records = $stmt->rowCount();

        if($records > 0)
        { ?>
            <tr><td colspan="3">
                <?php
                $pages = ceil( $records/$perPage );
                $curPage = 1;


                if( isset( $_GET["page"] ) )
                {
                    $curPage = $_GET["page"];
                }

                if( $curPage !=1 )
                {
                    $previous = $curPage -1;
                    echo "<a href='".$self."?page_no=1'>First</a>&nbsp;&nbsp;";
                    echo "<a href='".$self."?page_no=".$previous."'>Previous</a>&nbsp;&nbsp;";
                }

                for ( $i=1; $i <= $pages; $i++ )
                {
                    if ( $i == $curPage )
                    {
                        echo "<strong><a href='".$self."?page_no=".$i."' style='color:red;text-decoration:none'>".$i."</a></strong>&nbsp;&nbsp;";
                    }
                    else
                    {
                        echo "<a href='".$self."?page_no=".$i."'>".$i."</a>&nbsp;&nbsp;";
                    }
                }
                if ( $curPage != $pages )
                {
                    $next = $curPage + 1;
                    echo "<a href='".$self."?page_no=".$next."'>Next</a>&nbsp;&nbsp;";
                    echo "<a href='".$self."?page_no=".$pages."'>Last</a>&nbsp;&nbsp;";
                }
                ?>
            </td></tr>
            <?php
        }
    }

}