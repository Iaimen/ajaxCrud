<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!---Bootstrap css--->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<title>PHP Ajax CRUD</title>
</head>

<body>

    <!-- Modal -->
    <div class="modal fade" id="completeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="completename">Name</label>
                        <input type="text" class="form-control" id="completename" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="completemail">Email</label>
                        <input type="text" class="form-control" id="completemail" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="completemobile">Mobile</label>
                        <input type="text" class="form-control" id="completemobile"
                            placeholder="Enter your mobile number">
                    </div>
                    <div class="form-group">
                        <label for="completeplace">Place</label>
                        <input type="text" class="form-control" id="completeplace" placeholder="Enter your place">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <!---Update Modal--->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="updatename">Name</label>
                        <input type="text" class="form-control" id="updatename" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="updateemail">Email</label>
                        <input type="text" class="form-control" id="updateemail" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="updatemobile">Mobile</label>
                        <input type="text" class="form-control" id="updatemobile"
                            placeholder="Enter your mobile number">
                    </div>
                    <div class="form-group">
                        <label for="updateplace">Place</label>
                        <input type="text" class="form-control" id="updateplace" placeholder="Enter your place">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" value="submit" onclick="updateDetails()">Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddendata">

                </div>
            </div>
        </div>
    </div>



    <div class="container my-3">
        <h1 class="text-center">PHP CRUD operations using Bootstrap Modal</h1>
        <button type="button" class="btn btn-dark my-3" data-bs-toggle="modal" data-bs-target="#completeModal">
            Add new users
        </button>
        <div id="displayDataTable"></div>
        <!---jQuery--->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

        <!---bootstrap javascript--->
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>

        <script>
            $(document).ready(function () {
                displayData();
            });

            function displayData() {
                var displayData = "true";
                $.ajax({
                    url: "display.php",
                    type: "POST",
                    data: {
                        displaySend: displayData
                    },
                    success: function (data, status) {
                        $('#displayDataTable').html(data);

                    }
                });
            }

            function adduser() {
                //display function
                var nameAdd = $('#completename').val();
                var emailAdd = $('#completemail').val();
                var mobileAdd = $('#completemobile').val();
                var placeAdd = $('#completeplace').val();

                $.ajax({
                    url: "insert.php",
                    type: "POST",
                    data: {
                        nameSend: nameAdd,
                        emailSend: emailAdd,
                        mobileSend: mobileAdd,
                        placeSend: placeAdd,
                    },
                    success: function (data, status) {
                        //function to display data
                        //console.log(status);
                        $('#completeModal').modal('hide');
                        displayData();
                    },

                });
            }

            //Delete User
            function DeleteUser(deleteid) {
                $.ajax({
                    url: "delete.php",
                    type: 'POST',
                    data: {
                        deletesend: deleteid,
                    },
                    success: function (data, status) {
                        displayData();
                    }
                });
            }

            //Update function

            function GetDetails(updateid) {
                $('#hiddendata').val(updateid);

                $.post("update.php", { updateid: updateid }, function (data, status) {
                    var userid = JSON.parse(data);
                    $('#updatename').val(userid.name);
                    $('#updateemail').val(userid.email);
                    $('#updatemobile').val(userid.mobile);
                    $('#updateplace').val(userid.place);
                });
                $('#updateModal').modal("show");

            }

            //onclick update event function
            function updateDetails() {
                var updatename = $('#updatename').val();
                var updateemail = $('#updateemail').val();
                var updatemobile = $('#updatemobile').val();
                var updateplace = $('#updateplace').val();
                var hiddendata = $("#hiddendata").val();

                $.post("update.php", {
                    updatename: updatename,
                    updateemail: updateemail,
                    updatemobile: updatemobile,
                    updateplace: updateplace,
                    hiddendata: hiddendata

                }, function (data, status) {
                    $('#updateModal').modal("hide");
                    displayData();

                });

            }
        </script>

</body>

</html>