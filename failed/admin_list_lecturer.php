<?php
    require "common/conn.php";
    if (!isset($_SESSION["userID"])) {
        echo '<script>alert("Please login before you access this page.");
        window.location.href="guest_home_page.php";</script>';
    }
    $action = "Lecturer";
    $fetched = mysqli_query($con, "SELECT * FROM lecturer WHERE CompanyID = ".$_SESSION['companyID']."");
    $numOfRow = mysqli_num_rows($fetched);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php";
    ?>
    <link rel="stylesheet" href="css/commonCSS.css">
    <link rel="stylesheet" href="css/mingliangCSS.css">
    <title>Lecturer | <?php echo $action;?> List</title>
</head>
<body>
    <?php require "common/header_admin.php";?>
    <h1 class="text-center font-caveat fw-bold mb-3"><?php echo $action;?> List</h1>
    <div class="d-flex flex-row justify-content-between mx-auto m-5" style="width:80%">
        <input class="form-control me-2" type="text" v-model="query" placeholder="Search By Name" @keyup="fetchData()" />        
        <div>
           <a href="" class="btn btn-primary ms-3">Add new user</a>
        </div>
    </div>

    <table class="table table-light table-hover mx-auto align-middle " style="width:90%" id="tableApp">
        <caption>List of <?php echo $action;?> : <?php echo $numOfRow;?> in Total</caption>
        <thead class="table-dark">
            <tr>
                <th>Lecturer ID</th>
                <th>Lecturer Name</th>
                <th>Lecturer Gender</th>
                <th>Lecturer Email</th>
                <th>Lecturer Password</th>
                <th>Related Module</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for"row in allData">
                <td>{{ row.LecturerID }}</td>
                <td>{{ row.LecturerName }}</td>
                <td>{{ row.LecturerGender }}</td>
                <td>{{ row.LecturerEmail }}</td>
                <td>{{ row.LecturerPassword }}</td>
                <td>{{ modules }}</td>
                <td >
                    <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger" ><i class="bi bi-trash"></i></button>
                </td>
            </tr>
            <tr v-if="nodata">
                <td colspan="7" align="center">No data Found</td>
            </tr>
        </tbody>

    </table>
    <?php require "common/footer_Lecturer.php";?>
    <script src="https://unpkg.com/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/mingliangJS.js"></script>
    <script>
        var application = new Vue({
            el:'#tableApp',
            data:{
                allData:'',
                query:'',
                modules:'',
                nodata:false
            },
            methods: {
                fetchData:function(){
                    axios.post('backend_lecturer_list.php', {
                        query:this.query
                    }).then(function(response){
                        if(response.data.length > 0)
                        {
                            application.allData = response.data;
                            application.modules = response.moduleString;
                            application.nodata = false;
                        }
                        else
                        {
                            application.allData = '';
                            application.modules = response.moduleString;
                            application.nodata = true;
                        }
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            created:function(){
                this.fetchData();
            }
        });

    </script>
</body>
</html>