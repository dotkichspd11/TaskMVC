<?php
require_once './MVC/Views/header.php';
?>
<!-- End of Topbar -->

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Quản Lý Khách Hàng</h1>


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 card-product">
            <div class="sub-card-product" >
                <h6 class="m-0 font-weight-bold text-primary">Tất Cả Các Khách Hàng</h6>

                <div>
                    <!-- <button class="btn btn-primary" type="button" data-toggle="modal"
                        data-target="#exampleModalLong2">Thêm
                        xe </button>

                    <form action="" method="post" enctype="multipart/form-data" class="modal fade"
                        id="exampleModalLong2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle"
                        aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLongTitle">Thêm khach hang</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">

                                    <div class="card-body_item ">
                                        <label for="">Tên khach hang<sup>*</sup></label>
                                        <input class="card-body_input" type="text" id="fullname" name="fullname"
                                            required>

                                    </div>
                                    <div class="card-body_item ">
                                        <label for="">Email<sup>*</sup></label>
                                        <input class="card-body_input" type="email" id="email" name="email" required>

                                    </div>
                                    <div class="card-body_item ">
                                        <label for="">So dien thoai<sup>*</sup></label>
                                        <input class="card-body_input" type="int" id="phone" name="phone" required>

                                    </div>
                                    <div class="card-body_item ">
                                        <label for="">Ngay sinh<sup>*</sup></label>
                                        <input class="card-body_input" type="date" id="dateofbirth" name="dateofbirth"
                                            required>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Đóng</button>
                                        <input type="submit" id="add" name="add" class="btn btn-primary"
                                            value="Thêm mới">
                                    </div>
                                </div>
                            </div>
                    </form> -->
                </div>
            </div>
        </div>


        <div class="card-body">

            <div class="table-responsive">

                <?php 
                    require_once './MVC/Models/config.php';
                    $conn = new DB();
                    $con = $conn->connect();
                    
                    $sql = "SELECT * FROM customer";
                    // $sql = "SELECT rentalinfo.idhd,rentalinfo.idxe,rentalinfo.namecus,rentalinfo.address,rentalinfo.frontimg,rentalinfo.backimg,rentalinfo.datestart,rentalinfo.datefinish,products.name FROM rentalinfo, products WHERE rentalinfo.idxe = products.idxe";
                    //rentalinfo.id,rentalinfo.namecus,rentalinfo.datestart,rentalinfo.datefinish,rentalinfo.namecus, products.name FROM rentalinfo, products where rentalinfo.id = products.id
                    if($result = mysqli_query($con, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered ' id='dataTable' width='100%' cellspacing='0'>" ;
                                echo "<thead>";
                                    echo "<tr>";
                                        
                                        echo "<th>Ten khach hang</th>";
                                        echo "<th>Email</th>";
                                        echo "<th>So dien thoai</th>";
                                        echo "<th>Ngay sinh</th>";
                                        echo "<th>Thao tác</th>";
                                    echo "</tr>";
                                    echo "</thead>";
                                    echo "<tbody>";
                                    ?>
                <?php  while($row = mysqli_fetch_array($result)){ ?>
                <tr>
                    <td><?php echo $row['fullname']; ?> </td>
                    <td> <?php echo $row['email']; ?> </td>
                    <td> <?php echo $row['phone'];?> </td>
                    <td> <?php echo $row['dateofbirth'];?> </td>


                    <td class='card-table-item'>

                        <p class='card-table-link' style='margin-bottom:0;margin-left:15px;cursor:pointer'
                            title='Update Record' data-target='#exampleModalLong<?php echo $row ['id']; ?>'
                            data-toggle='modal'><i class='fas fa-edit card-table-icon update-config'></i>
                        <form action='index.php?controller=customer&action=edit&id=<?php echo $row['id']; ?>'
                            method='POST' enctype='multipart/form-data' class='modal fade'
                            id='exampleModalLong<?php echo $row ['id']; ?>' tabindex='-1' role='dialog'
                            aria-labelledby='exampleModalLongTitle<?php echo $row ['id']; ?>' aria-hidden='true'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <h5 class='modal-title' id='exampleModalLongTitle<?php echo $row ['id']; ?>'>
                                            Cập
                                            nhật khach hang</h5>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'>
                                            <span aria-hidden='true'>&times;</span>
                                        </button>
                                    </div>
                                    <div class='modal-body'>

                                        <div class='card-body_item '>
                                            <label for=''>Tên khach hang<sup>*</sup></label>
                                            <input class='card-body_input' type='text' name='fullname'
                                                value='<?php echo $row ['fullname']; ?>' required>
                                        </div>
                                        <div class='card-body_item '>
                                            <label for=''>Email<sup>*</sup></label>
                                            <input class='card-body_input' type='email' name='email'
                                                value='<?php echo $row ['email']; ?>' required>
                                        </div>
                                        <div class='card-body_item '>
                                            <label for=''>So dien thoai<sup>*</sup></label>
                                            <input class='card-body_input' type='int' name='phone'
                                                value='<?php echo $row ['phone']; ?>' required>
                                        </div>

                                        <div class='card-body_item '>
                                            <label for=''>Ngay sinh<sup>*</sup></label>
                                            <input class='card-body_input' type='date' name='dateofbirth'
                                                value='<?php echo $row ['dateofbirth']; ?>' required>

                                        </div>


                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary'
                                            data-dismiss='modal'>Đóng</button>
                                        <input type='submit' name='update' class='btn btn-primary' value='Cập nhật'>
                                    </div>
                                </div>
                            </div>
                        </form>
                        </p>
                        <a class='card-table-link'
                            href='index.php?controller=customer&action=delete&id=<?php echo $row['id']; ?>'
                            title='Delete Record' data-toggle='tooltip'><i
                                class='fas fa-trash-alt card-table-icon'></i></a>

                    </td>

                </tr>
                <?php  }?>

                </table>
                <?php
                        // Free result set
                        mysqli_free_result($result);
                        } else{
                        echo "<p class='lead'><em>Không có khách hàng nào thuê tại cửa hàng.</em></p>";
                        }
                        } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
                        }
                        ?>
                <?php
                        // Close connection
                        mysqli_close($con);
                        ?>

            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php
require_once './MVC/Views/footer.php';
?>