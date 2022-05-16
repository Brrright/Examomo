<?php
    require "common/conn.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php 
        require "common/HeadImportInfo.php";
    ?>
    <link rel="stylesheet" href="css/commonCSS.css">
    <link rel="stylesheet" href="css/mingliangCSS.css">
    <title>Admin | Student List</title>
</head>
<body>
    <?php require "common/header_admin.php";?>
    <h1 class="text-center font-caveat fw-bold mb-3">Student List</h1>
    <div class="d-flex flex-row justify-content-between mx-auto m-5" style="width:80%">
        <input class="form-control me-2" type="text" v-model="username" placeholder="Search" aria-label="Search">        
        <div>
           <button class="btn btn-primary ms-3">Add new user</button>
        </div>
    </div>

    <table class="table table-light table-hover mx-auto" style="width:90%" id="table-app">
        <thead>
            <tr>
                <th>Student ID</th>
                <th>Student Name</th>
                <th>Student Gender</th>
                <th>Student Email</th>
                <th>Student Password</th>
                <th>Management tools</th>
            </tr>
        </thead>
        <table-list v-for="each in user" :username="username"></table-list>
    </table>


    <script type="text/x-template" id="table-template">
        <tbody>
            <tr>
                <td>{{user.id}}</td>
            </tr>
            <tr>
                <td>{{user.name}}</td>
            </tr>
            <tr>
                <td>{{user.gender}}</td>
            </tr>
            <tr>
                <td>{{user.email}}</td>
            </tr>
            <tr>
                <td>{{user.password}}</td>
            </tr>
            <tr>
                <td>
                    <button class="btn btn-primary"><i class="bi bi-pencil-fill"></i></button>
                    <button class="btn btn-danger"><i class="bi bi-trash"></i></button>
                </td>
            </tr>
        </tbody>
    </script>

    <?php require "common/footer_admin.php";?>
    <script src="https://unpkg.com/vue@3"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/mingliangJS.js"></script>
    <script>
    Vue.createApp ({
        data(){
            return {
                username: '',
                responseMessage: ''
            }
        }
    })
    .component('table-list', {
        template: '#table-template',
        props: {
            username:{type:String, required:true}
        },
        data() {
            return {
                user: {}
            }
        },
        created() {
            axios.get('backend_fetch_all_data.php')
            .then(function(res) {
                return res.json()
            })
            .then(function(response) {
                this.user = response.data
            })
            
        },
    })
    .mount('#table-app')
    </script>
</body>
</html>