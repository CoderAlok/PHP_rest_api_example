<!doctype html>
<html lang="en">

<head>
  <title>Admin | Orders</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
  <!-- Material Kit CSS -->
  <link href="<?=base_url('assets/css/material-dashboard.css?v=2.1.2')?>" rel="stylesheet" />

  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
  <script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css" />
  <link href='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css'>
  <script src='https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js'></script>

</head>

<body>
  <div class="wrapper ">
    
    <!-- Sidebar started -->
    <?php require_once('common/nav.php')?>
    <!-- Sidebar ended -->

    <div class="main-panel">
      <!-- Navbar -->
      <?php require_once('common/navbar.php');?>
      <!-- End Navbar -->
      <div class="content">
        <!-- Button trigger modal -->
        <!-- <button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#basicExampleModal">
          Add stocks
        </button> -->
        
        <div class="container-fluid">
          <!-- your content here -->
          
          <table id="example" class="display" style="width:100%">
            <thead>
                <tr>
                    <th>SlNo</th>
                    <th>Product</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Remain Qty</th>
                    <th>Total Qty</th>
                </tr>
            </thead>
            <tbody>

              <?php //foreach($data['data'] as $key => $value) { ?>
                <tr>
                    <td><?//=$key+1?></td>
                    <td><?//=$value['pid']?></td>
                    <td><?//=date('Y/m/d', strtotime($value['stock_in_dt']))?></td>
                    <td><?//=date('Y/m/d', strtotime($value['stock_out_dt']))?></td>
                    <td><?//=$value['unit']?></td>
                    <td><?//=$value['qnty']?></td>
                    <td><?//=$value['remain_qty']?></td>
                    <td><?//=$value['total_qty']?></td>
                </tr>

              <?php //} ?>
 
            </tbody>
            <tfoot>
                <tr>
                    <th>SlNo</th>
                    <th>Product</th>
                    <th>In</th>
                    <th>Out</th>
                    <th>Unit</th>
                    <th>Quantity</th>
                    <th>Remain Qty</th>
                    <th>Total Qty</th>
                </tr>
            </tfoot>
          </table>
        </div>
      </div>
      
      <?php require_once('common/footer.php') ?>
    
    </div>
  </div>
</body>
  
  <script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable( {
            "pagingType": "full_numbers"
        } );
    } );
  </script>

</html>