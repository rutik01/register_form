<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once ('insert.php');
// update data in 
if(isset($_GET['u_id']))
{
    $u_id = $_GET['u_id'];
    $sel_update_query = "SELECT * FROM form_data WHERE Id ='$u_id'";
   $updata_data = mysqli_query($conn , $sel_update_query);
   $up = mysqli_fetch_assoc($updata_data);


//   echo $img_data;
}
//insert data into the database
if(isset($_POST['submit']))
{
    $Name = $_POST['name'];
    $S_name = $_POST['surname'];
    $Address  = $_POST['address'];
    $Email = $_POST['email'];
    $Password = $_POST['Password'];
    $Dob = $_POST['dob'];
    $City = $_POST['City'];
    $Document = $_POST['Document']; 
    // Image into Folder and Image address Store into the data base;
    $Image = $_FILES['image']['name'];
    $path = "img/".$Image;
    if (isset($_GET['u_id']))
    {
        $img_data = $up['Image'];
//        echo $img_data;
        if ($Image == '')
        {
            $img_up_data = $img_data;
        }
        else{
            $img_up_data = $Image;
            unlink("img/".$img_data);
            move_uploaded_file($_FILES['image']['tmp_name'], $path);
            header('location:registerform.php');

        }
        $update_query = "UPDATE form_data SET Name = '$Name',Surname = '$S_name',Address ='$Address',Email='$Email ',Password='$Password',Dob='$Dob',City='$City',Document='$Document',Image='$img_up_data' WHERE Id = '$u_id'";
        mysqli_query($conn,$update_query);
    }
    else
    {


        $query = "INSERT INTO form_data (Name,Surname,Address,Email,Password,Dob,City,Document,Image) VALUES ('$Name','$S_name','$Address','$Email','$Password','$Dob','$City','$Document','$Image')";
        if(mysqli_query($conn,$query))
        {
            if( $Image !='')
            {
                move_uploaded_file($_FILES['image']['tmp_name'], $path);
            }
//            header("Location:registerform.php");
        }
    }
}
//fetch data in the table
    $sel = "select * from form_data";
    $result = mysqli_query($conn,$sel);




//delete data in database
if(isset($_GET['ID']))
{
    $id = $_GET['ID'];
    $delete_query =  "DELETE FROM form_data where Id = '$id'";


    $data = mysqli_query($conn,$delete_query);
//    header("location:registerform.php");
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        .container { 
            border: 1px solid black;
            border-radius: 20px;
        }
        table{
            margin-left: 20px;
            text-align: center;
        }
    </style>
</head>
<body>
    <form  method="POST" enctype="multipart/form-data" >
        <div class="container bg-white border border-white-1">
            <hr>
            <div class="row card-header bg-dark text-white">
                <div class="col-12 text-center mt-4">
                    <h3>!! 🆁🅴🅶🅸🆂🆃🅴🆁-🅵🅾🆁🅼 !!</h3>
                </div>
            </div>
            <hr>
            <div class="row-12">
                <div class=" col-12">
                    <div class="row mt-5">
                        <div class="col-2">
                            <h5 class="p-2">*First Name:</h5>
                        </div>
                        <div class="col-auto m-0">
                            <input type="text" name="name" id="" class="p-2 rounded-3" value="<?php echo @$up['Name'] ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2">
                            <h5 class="p-2">*Surname:</h5>
                        </div>
                        <div class="col-auto">
                            <input type="text" name="surname" id="" class="p-2 rounded-3" value="<?php echo @$up['Surname']  ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <h5 class="p-2">*Address:</h5>
                        </div>
                        <div class="col-auto">
                            <input type="text" name="address" id="" class="p-2 rounded-3"  value="<?php echo @$up['Address']  ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <h5 class="p-2">*Email:</h5>
                        </div>
                        <div class="col-auto">
                            <input type="email" name="email" id="" class="p-2 rounded-3"  value="<?php echo @$up['Email']  ?>">
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-2">
                            <h5 class="p-2">*Password:</h5>
                        </div>
                        <div class="col-auto">
                            <input type="password" name="Password"  class="p-2 rounded-3"  value="<?php echo @$up['Password']  ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <h5 class="p-2">*DOB:</h5>
                        </div>
                        <div class="col-auto">
                            <input type="date" name="dob" id="" class="p-2 rounded-3"  value="<?php echo @$up['Dob']  ?>">
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <h5 class="p-2">*City:</h5>
                        </div>
                        <div class="col-auto">
                            <select class="p-2 rounded-2 text-bold" name="City"  value="<?php echo @$up['City']  ?>">
                                <option class="font-weight-bold">Surat</option>
                                <option class="font-weight-bold">Ahemdabad</option>
                                <option class="font-weight-bold">Baroda</option>
                                <option class="font-weight-bold">Bharuch</option>
                                <option class="font-weight-bold">Vapi</option>
                                <option class="font-weight-bold">Valsad</option>
                                <option class="font-weight-bold">Navsari</option>
                                <option class="font-weight-bold">Aanad</option>
                                <option class="font-weight-bold">Gandhinagar</option>
                                <option class="font-weight-bold">Banglore</option>
                                <option class="font-weight-bold">Rajkot</option>
                                <option class="font-weight-bold">Jamnagsr</option>
                                <option class="font-weight-bold">Porbander</option>
                                <option class="font-weight-bold">Bhavnagar</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-2">
                            <h5 class="p-2">*Document:</h5>
                        </div>
                        <div class="col-auto">
                            <select class="p-2 rounded-3" name="Document"  value="<?php echo @$up['Document']  ?>">
                                <option>Water Bill</option>
                                <option>Telephone (mobile bill)</option>
                                <option>Electricity bill</option>
                                <option>Income Tax Assessment Order</option>
                                <option>Election  ID card</option>
                                <option>Proof of Gas Connection</option>
                                <option>Certificate from Employe</option>
                                <option>Spouse's passport copy </option>
                                <option>Parent's passport copy</option>
                                <option>Aadhaar Card</option>
                                <option>Rent Agreement</option>
                                <option>Photo Passbook</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3 mb-5">
                        <div class="col-2">
                            <h5 class="p-2">*Image:</h5>
                        </div>
                        <div class="col-auto rounded-3">
                            <input type="file" name="image" id="" class="p-2"  value="<?php echo @$up['Image']  ?>">
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <div class="row card-footer bg-dark text-white">
                <div class="col-12">
                    <div class="col-2">
                        <input type="submit" value="submit" class="btn btn-dark m-3" name="submit" >
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fetch Data Into the Database in php</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>
</head>
<body>

<div class="container mt-5 border border-1 border-white">
    <div class="row">
        <div class="col">
            <div class="card mt-5">
                <div class="card-header">
                    <div class="display-6 text-center">
                        Fetch Data From Database in php
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-border text-center">
                        <tr class="bg-dark text-white">
                            <td>User ID</td>
                            <td>First Name</td>
                            <td>Surname</td>
                            <td>Address</td>
                            <td>Email</td>
                            <td>Password</td>
                            <td>Dob</td>
                            <td>City</td>
                            <td>Document</td>
                            <td>Image</td>
                            <td>Update</td>
                            <td>Delete</td>
                        </tr>
                        <tr class=" \text-dark">
                            <?php
                            while($row = mysqli_fetch_assoc($result))  {   ?>

                            <td><?php echo $row['Id'];  ?></td>
                            <td><?php echo $row['Name'];  ?></td>
                            <td><?php echo $row['Surname'];  ?></td>
                            <td><?php echo $row['Address'];  ?></td>
                            <td><?php echo $row['Email'];  ?></td>
                            <td><?php echo $row['Password']; ?></td>
                            <td><?php echo $row['Dob']; ?></td>
                            <td><?php echo $row['City']; ?></td>
                            <td><?php echo $row['Document']; ?></td>
                            <td><img src="img/<?php echo $row['Image'] ?>" height="100px" width="100px"></td>
                            <td>
                                <a href="registerform.php?u_id=<?php echo $row['Id']; ?>">
                                    Update
                                </a>
                            </td>
                            <td><a href="registerform.php?ID=<?php echo  @$row['Id'];?>">Delete</a></td>
                        </tr>
                        <?php   } ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>