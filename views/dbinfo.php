<table class="table table-bordered table-hover table-striped">
  <thead>
    <tr>
        <th>TABLES</th>
        <th>ACTIONS</th>
        <th>ROWS</th>
        <th>SIZE</th>
        <th>ENGINE</th>
        <th>COLLATION</th>
        <th>CREATED TIME</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($data as $d) { ?>
      <tr class="dbTable" id="<?php echo $d["Name"]; ?>">
        <td class="tname">
            <a href="/tableData?db=<?php echo $dbName; ?>&table=<?php echo $d["Name"]; ?>">
                <?php echo $d["Name"]; ?>
            </a>
        </td>
        <td align="center" class="tname">
            <div class="btn-group">
                <a href="/tableData?db=<?php echo $dbName; ?>&table=<?php echo $d["Name"]; ?>" class="browse btn btn-success tname">Browse</a>
                <a class="browse btn btn-info">Structure</a>
                <a class="browse btn btn-warning">Edit</a>
                <a class="browse btn btn-danger">Delete</a>
            </div>
        </td>
        <td>
          <?php echo $d["Rows"]; ?>
        </td>
        <td>
          <?php echo $d["Data_length"]; ?>
        </td>
        <td>
          <?php echo $d["Engine"]; ?>
        </td>
        <td>
          <?php echo $d['Collation']; ?>
        </td>
        <td>
          <?php echo $d["Create_time"]; ?>
        </td>
      </tr>
    <?php } ?>
  </tbody>
</table>

<script>
    $(document).ready(function() {

      //    Database Table Management
      $("table tr .tname a").click(function(e) {
          e.preventDefault();

//          var table = $(this).parent('td').parent('tr').attr('id');

          var url = $(this).attr('href');

          viewTable("/viewTable" + url.split('tableData')[1]);

      });
  });
</script>