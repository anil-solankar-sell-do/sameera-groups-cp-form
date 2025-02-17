<?php session_start();

header("Location: form.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
</head>
<style>
    a {
        color: #000;
        text-decoration: none;
    }

    a.disabled {
        background-color: grey;
        pointer-events: none;
    }

    .list-group {
        max-height: 400px;
        overflow-y: scroll;
    }
</style>




<body>
    <div id="selldoform">
        <div class="row">
            <div class="col-12 popupright mt-3">
                <div class="col-12 form-wrapper">
                    <!-- <h2 class="form-title text-center"><img src="images/logo.png" width="200"></h2> -->

                    <div class="container ">
                        <div class="row justify-content-center">
                            <div class="col-lg-9">

                                <form class="checklead my-5 position-relative">
                                    <div class="loading" style="display:none"><img src="./images/loading-gif.gif" alt="" width="50" height="50"></div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12">
                                            <div class="signupform-wrapper ">
                                                <h2 class="h4">Projects</h2>
                                                <ul class="list-group">
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12">
                                            <a href="form.php?" type="submit" class="btn btn-primary w-100 fw-bold mt-3 disabled" id="build-url">Proceed</a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        var page = 1;
        var total = 0;

        function formdata() {
    // $("#loadmore").html("Loading...");
    $(".loading").show();
    if (total == 0) {
        $.ajax({
            type: "POST",
            url: 'formdata.php',
            data: {
                flaga: 1,
                page: 1
            },
            success: function(resp) {
                var response = JSON.parse(resp);
                project = JSON.parse(response['project']);
                console.log(project);
                total = 1;

                if (total != 0) {
                    for (i = 0; i < total; i++) {
                        $.ajax({
                            type: "POST",
                            url: 'formdata.php',
                            data: {
                                flaga: 1,
                                page: i + 1
                            },
                            success: function(resp) {
                                var response = JSON.parse(resp);
                                console.log(response);
                                project = JSON.parse(response['project']);
                                console.log(project);

                                // Excluded project IDs
                                const excludedIds = ["66f97dc0735dafb2e7687d25", "66f97df358f1e7825932df4c"];

                                project.results.forEach(function(element) {
                                    // Check if the project's ID is in the excluded list
                                    if (!excludedIds.includes(element._id)) {
                                        console.log(element.name);
                                        $(".signupform-wrapper ul").append(`<li class="list-group-item" data-projectid='${element._id}' data-projectname='${element.name}'><a>${element.name}</a></li>`);
                                    }
                                });

                                $(".loading").hide();
                                if (project.results.length === 0) {
                                    $("#loadmore").hide();
                                }
                            },
                            error: function(resp, status, xhr) {
                                // alert(resp);
                            }
                        });
                    }
                }
            },
            error: function(resp, status, xhr) {
                // alert(resp);
            }
        });
    }
} // End submitHandler

formdata();

        var click_check = 0;
        var cpdata = "";
        $(document).on('click', '.list-group-item', function() {
            $(".list-group-item").removeClass("active")
            $(this).addClass("active");
            let projectid = $(this).attr("data-projectid")
            let projectname = $(this).attr("data-projectname")
            $("#build-url").attr("href", function() {
                this.href = this.href.split('?')[0];
                click_check++;
                if (click_check > 0) {
                    $("#build-url").removeClass("disabled")
                }
                return (
                    this.href +
                    "?projectid=" +
                    projectid +
                    "&projectname=" + projectname
                );
            });

        })
    </script>
</body>

</html>