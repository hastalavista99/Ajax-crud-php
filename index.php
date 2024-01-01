<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AJAX try</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="ajaxModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="completeName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="completeName" placeholder="Enter your name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="completeEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="completeEmail" placeholder="Enter your email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="completeMobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="completeMobile" placeholder="Enter your mobile">
                    </div>
                    <div class="form-group mb-3">
                        <label for="completePlace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="completePlace" placeholder="Enter your place">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="addUser()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    
                </div>
            </div>
        </div>
    </div>

    <!-- update modal -->
    <div class="modal fade" id="updateModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Update Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="updateName" class="form-label">Name</label>
                        <input type="text" class="form-control" id="updateName" placeholder="Enter your name">
                    </div>
                    <div class="form-group mb-3">
                        <label for="updateEmail" class="form-label">Email</label>
                        <input type="text" class="form-control" id="updateEmail" placeholder="Enter your email">
                    </div>
                    <div class="form-group mb-3">
                        <label for="updateMobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="updateMobile" placeholder="Enter your mobile">
                    </div>
                    <div class="form-group mb-3">
                        <label for="updatePlace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="updatePlace" placeholder="Enter your place">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="updateDetails()">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddenData">
                    
                </div>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <h1 class="text-center">PHP AJAX CRUD</h1>
        <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#ajaxModal">
            Add New Users
        </button>
        <div id="displayDataTable"></div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        $(document).ready(function(){
            displayData();
        });

        // display function
    function displayData(){
        var displayData = "true";
        $.ajax({
            url: "display.php",
            type: 'post',
            data: {
                displaySend:displayData
            },
            success: function(data, status){
                $('#displayDataTable').html(data);
            }
        })
    }

        function addUser(){
            var name = $('#completeName').val();
            var email = $('#completeEmail').val();
            var mobile = $('#completeMobile').val();
            var place = $('#completePlace').val();


            $.ajax({
                url:"insert.php",
                type:'post',
                data: {
                    nameSend: name,
                    emailSend: email,
                    mobileSend: mobile,
                    placeSend: place
                },
                success: function(data, status){
                    // function to display data
                    // console.log(status);
                    $('#ajaxModal').modal('hide');
                    displayData();
                }
            })
        }

        // delete record
        function deleteUser(deleteid){
            $.ajax({
                url: "delete.php",
                type: 'post',
                data: {
                    deletesend: deleteid
                },
                success:function(data,status) {
                    displayData();
                }
            });
        }

        // update function
        function getDetails(updateid){
            $('#hiddenData').val(updateid);

            $.post("update.php", {updateid:updateid}, function(data, status){
                var userid = JSON.parse(data);
                $('#updateName').val(userid.name);
                $('#updateEmail').val(userid.email);
                $('#updateMobile').val(userid.mobile);
                $('#updatePlace').val(userid.place);
            });

            $('#updateModal').modal("show");

        }
        // update 
        function updateDetails(){
            var updatename = $('#updateName').val();
            var updateemail = $('#updateEmail').val();
            var updatemobile = $('#updateMobile').val();
            var updateplace = $('#updatePlace').val();
            var hiddendata = $('#hiddenData').val();

            $.post("update.php", {
                updatename:updatename,
                updateemail:updateemail,
                updatemobile:updatemobile,
                updateplace:updateplace,
                hiddendata:hiddendata
            }, function(data,status){
                $('#updateModal').modal('hide');
                displayData();
            });
        }
    </script>
</body>

</html>