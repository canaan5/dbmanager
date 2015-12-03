<?php
if ( isset($error) )
    var_dump($error);
?>

<?php $self = $_SERVER['REQUEST_URI']; ?>

<h3>Showing page <?php echo $number .' of '. $pages; ?> ( in <?php echo $total ?> rows returned )</h3>


<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
        <?php foreach ( $description as $row ) { ?>

            <th><?php echo $row['Field']; ?></th>

        <?php } ?>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($result as $d) { ?>
      <tr class="tableInfo">
        <?php foreach ($description as $td) { ?>

          <td><?php echo substr($d[$td["Field"]], 0, 30); ?></td>

        <?php } ?>

        </tr>
    <?php } ?>
  </tbody>
    <tfoot>
    <tr>
        <?php foreach ( $description as $row ) { ?>

            <th><?php echo $row['Field']; ?></th>

        <?php } ?>
    </tr>
    </tfoot>
</table>


<?php

if ( $pages > 1 ) {

?>

    <nav>
        <ul class="pager">

            <li class="<?php if ($prev == 0 | $number <= 1 ) echo 'disabled'; ?>">
                <a href="/viewTable?db=<?php echo $_GET['db']; ?>&table=<?php echo $_GET['table']; ?>&page=<?php echo $prev; ?>">
                    <span aria-hidden="true">&larr;</span>
                    Previous
                </a>
            </li>

            <li class="">
                <a href="/viewTable?db=<?php echo $_GET['db']; ?>&table=<?php echo $_GET['table']; ?>&page=<?php echo $next; ?>">
                    <span aria-hidden="true">&rarr;</span>
                    Next
                </a>
            </li>

            <?php if ( intval($number) === intval($pages) ) { ?>
            <li class="">
                <a href="/viewTable?db=<?php echo $_GET['db']; ?>&table=<?php echo $_GET['table']; ?>&page=1">
                    Back to First
                </a>
            </li>

            <?php } else { ?>

            <li class="">
                <a href="/viewTable?db=<?php echo $_GET['db']; ?>&table=<?php echo $_GET['table']; ?>&page=<?php echo $pages; ?>">
                    Last Page
                </a>
            </li>


           <?php } ?>
        </ul>
    </nav>

<?php } ?>




<script>
    $(document).ready(function() {

        //    Database Table Management
        $(".pager li a").click(function(e) {
            e.preventDefault();

//          var table = $(this).parent('td').parent('tr').attr('id');

            var url = $(this).attr('href');
            
            viewTable(url);

        });
    });
</script>