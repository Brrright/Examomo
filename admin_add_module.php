<?php require"common/conn.php"?>

<!DOCTYPE html>
<html lang="en">
    <head>
      <?php require "common/HeadImportInfo.php" ?>
        <link rel="stylesheet" href="css/weestyle.css">
        <link rel="stylesheet" href="css/commonCSS.css">
    </head>
<body>      
  <?php require "common/header_admin.php"  ?>
  <center><h1 style="font-family: 'Caveat';">Add Modules</h1></center>
  <div class="container">
    <div class="row g-0">
      <div class="col-sm-2">
        <div class="profilecontainer my-4 shadow p-3 mb-5 font-caveat">
          <div class="pill-nav">
            <a href="admin_module_list.php">View Module List</a>
              <br>
            <a class="active">Add Modules</a>
          </div>
        </div>
      </div>
      <div class="col-sm-10">
        <form class="was-validated" action ="admin_add_module_backend.php" method ="post">
          <div class="profilecontainer my-4 p-4 shadow p-3 mb-5">
            <p class="text-uppercase fw-bold main-color m-2  ">
                module name
            </p>
            <div class="form-floating" id="name-field">
              <input type="text" v-model="name" @keyup="checkName()" class="form-control shadow-sm" id="mod-floatingInput" name="moduleName" placeholder="Module Name" pattern="[a-zA-Z][a-zA-Z0-9 ]{5,}" required>
                <label class="text-secondary" for="mod-floatingInput">Module Name</label>
                  <div class="valid-feedback">Valid <i class="bi bi-check2-circle"></i>.</div>
                  <div class="invalid-feedback">Please fill out this field with valid input.</div>
                  <span class="text-danger" v-bind:id="[isAvailable?'notavailable':'available']">{{responseMessage}}</span>
                  <br>
                    <div class= "d-flex flex-wrap justify-content-around">
                    <button id="submit-btn" type="submit" value="submit" class="btn btn-primary" style="border:none;">Submit</button>
                    </div>      
            </div>
          </div>
        </form>
      </div>
    </div>
  <?php require "common/footer_admin.php"  ?>
  <script src="https://unpkg.com/vue@2"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="js/mingliangJS.js"></script>
    <script>
        var app = new Vue({
            el: '#name-field',
            data: {
                name: '',
                isAvailable: 0,
                responseMessage: ''
            },
            methods: {
                checkName: function(){
                    var name = this.name.trim();
                    if(name != ''){
                
                    axios.get('backend_check_name.php?action=module', {
                        params: {
                          name: name
                        }
                    })
                    .then(function (response) {
                        app.isAvailable = response.data;
                        if(response.data == 0){
                        app.responseMessage = "";
                        document.getElementById("submit-btn").disabled = false;
                        }else{
                        app.responseMessage = "Name Has been used.";
                        }
                    })
                    .then(function() {
                      var checkEmail = document.getElementById("notavailable");
                      if (checkEmail != null) {
                        document.getElementById("submit-btn").disabled = true;
                      }
                    })
                    .catch(function (error) {
                        console.log(error);
                    });

                    }else{
                        this.responseMessage = "";
                        
                    }
                }
            }
        })
    </script>
</body>
</html>