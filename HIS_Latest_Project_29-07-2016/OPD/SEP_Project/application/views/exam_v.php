<br />
<br />
<div class="container-fluid">
    <div class="row-fluid">
        <div class="span1"></div>
        <div class="span10">
        <h3 align="center">Examination</h3>
<table class="table table-bordered table-striped table-hover">
    <thead>
      <tr>
        <th></th>
        <th>Height</th>
        <th>Weight</th>
        <th>Temperature</th>
        <th>Systolic BP</th>
        <th>Diastolic BP</th>
      </tr>
    </thead>
    <tbody>
    <?php foreach($exams as $row){ ?>
      <tr>
        <td></td>
        <td><?php echo $row->height; ?></td>
        <td><?php echo $row->weight?></td>
        <td><?php echo $row->temprature; ?></td>
        <td><?php echo $row->sys_BP; ?></td>
        <td><?php echo $row->diast_BP; ?></td>
      </tr>
      <?php } ?>
    </tbody>
  </table>
        </div>
</div>
</div>