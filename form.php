<?php session_start();
if (!($_GET['projectid'])) {
    // header("Location: index.php");
} ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <link rel="stylesheet" type="text/css" href="css/intlTelInput.css">
    <link rel="stylesheet" href="css/jquery.datetimepicker.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <style>
        .select2-container{
            width: 100% !important;
        } 
    </style>
</head>

<body>
    <section>
        <div id="selldoform">
            <div class="row">
                <div class="col-12 popupright mt-5">
                    <div class="col-12 form-wrapper">
                        <h2 class="form-title text-center">
                            <img src="images/logo.png"  alt="Logo">
                            <!-- SAMEERA GROUPS -->
                        </h2>
                        <h1 class="h3 text-center mt-3">CP Form</h1>
                        <div class="signupform-wrapper">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <!-- First Form: Lead Check -->
                                        <form class="checklead my-4" id="checklead" method="post">
                                            <div class="loading" style="display:none">
                                                <img src="./images/loading-gif.gif" alt="Loading" width="50" height="50">
                                            </div>
                                            <div class="row g-3">
                                                <div class="col-md-12">
                                                                                                    
                                                    <label for="your-name" class="form-label">Phone Number:</label>
                                                    <input class="required samewidth form-control" type="text" name="inputvalue" id="inputvalue" placeholder="Enter your phone" pattern="[1-9]{1}[0-9]{9}" minlength="10" maxlength="10">                                                    
                                                    <input type="hidden" name="todaydate" id="todaydate">
                                                    <input type="hidden" name="scheduledon" id="scheduledon">
                                                    <input type="hidden" id="withincptat" name="withincptat" value="no" class=" form-control">
                                                    
                                                </div>
                                                <div class="col-12">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <button type="submit" class="btn btn-primary w-100 fw-bold free-crm-submit" id="searchlead">Check</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End of First Form -->

                                        <!-- Main Form -->
                                        <form class="my-5" method="post" id="formselldo" style="display:none;" novalidate>
                                            <input type="hidden" id="selldoid" name="selldoid">
                                            <input type="hidden" id="leadtype" name="leadtype">
                                            <input type="hidden" id="channelpartnername" name="channelpartnername">
                                            <input type="hidden" id="currently_in" name="currently_in">
                                            <input type="hidden" id="re_enagamenent" name="re_enagamenent" value="check" >  

                                            <h2 class="h4 mt-4">Applicant Details:</h2>

                                            <!-- Name Field -->
                                            <div class="col-md-12 mt-3">
                                                <label class="form-label" for="name">Lead Name*</label>
                                                <div class="row g-3">
                                                    <div class="col-md-2">
                                                        <select name="salutation" class="form-select" id="salutation">
                                                            <option value="Mr">Mr</option>
                                                            <option value="Dr">Dr</option>
                                                            <option value="Ms">Ms</option>
                                                            <option value="Mrs">Mrs</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <input type="text" id="name" name="name" value="" class="required form-control " >
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Mobile and Email Fields -->
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label" for="mob">Mobile No*</label>
                                                    <div class="row g-3">
                                                        <div class="col-md-2">
                                                            <input class="form-control" name="dial_code" id="leaddialcode" type="text" value="+91">
                                                        </div>
                                                        <div class="col-md-10">
                                                            <input class="required number ph-num form-control" type="text" name="phone" id="svleadphone" placeholder="Enter your phone" readonly>
                                                        </div>
                                                    </div>
                                                    <input name="country" id="leadcountry" type="hidden" value="IN">
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label" for="mail">Mail id</label>
                                                    <input type="text" id="mail" name="mail_id" value="" class="form-control">
                                                </div>
                                            </div>

                                            <div class="col-md-12 mt-3">
                                                <label class="form-label" for="project_lists">Projects*</label>
                                                <select name="project_lists" id="project_lists" class="form-select required" >
                                                    <option value="">Select</option>
                                                </select>
                                            </div>                                                
                                            
                                            <div class="row">
                                                <div class="col-md-6 mt-3">
                                                    <input type="hidden" name="cpnamecpcode" id="cpnamecpcode">
                                                    <label class="form-label" for="cpname">CP Name*</label>
                                                    <select id="cpname" name="cpname" class="form-control required" required>
                                                        <option value="">Select</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-6 mt-3">
                                                    <label class="form-label" for="cpfirmname">CP Code*</label>   
                                                    <input type="text" id="cpcode" name="cpcode" class="form-control required" readonly>
                                                </div>                        
                                            </div>

                                            <div class="col-md-12 mt-3 ">
                                                <label class="form-label" for="sales">Sales*:</label>
                                                <select class="form-select" name="sales" id="sales">
                                                    <option value="">Select</option>
                                                    <option value="664c2a715d8def351e4525cf--Arun Kumar S">Arun Kumar S</option>
                                                    <option value="6645dce30d18513f74eeebf8--Chidambaram S">Chidambaram S</option>
                                                    <option value="644302028eb6d871ac745dcc--Dhanasekar A">Dhanasekar A</option>
                                                    <option value="6442f9f38eb6d85b4713114f--Dinesh .">Dinesh .</option>
                                                    <option value="6442f71f8eb6d871ac745d37--Divya Shanmugam">Divya Shanmugam</option>
                                                    <option value="61b1e0e1ed23e939c4a6a429--Ganesh S">Ganesh S</option>
                                                    <option value="6442f2338eb6d871ac745d05--Gopal Krishnanan">Gopal Krishnanan</option>
                                                    <option value="663a0f22a3d85563ba7ef80d--Jamuna Rani">Jamuna Rani</option>
                                                    <option value="647325fcc825610c157fb3e0--Mahalakshmi E">Mahalakshmi E</option>
                                                    <option value="61b1e4eaed23e931ec009a5f--Manikandan M">Manikandan M</option>
                                                    <option value="663c7103735daf7ced7afde7--Manoj Kumar G">Manoj Kumar G</option>
                                                    <option value="61b1e121ed23e95dbc800724--R Gopala Krishnan">R Gopala Krishnan</option>
                                                    <option value="61b1e043ed23e939c4a6a3a9--Ramesh V">Ramesh V</option>
                                                    <option value="61b1e159ed23e9069fad49aa--Sakthivel P">Sakthivel P</option>
                                                    <option value="61b1e3daed23e9460ca01225--Sandhiya P">Sandhiya P</option>
                                                    <option value="663e0b1b0d18511080013bac--Sangeetha R">Sangeetha R</option>
                                                    <option value="66c6eb27a3d855deac9fccd2--Santhosh Kumar">Santhosh Kumar</option>
                                                    <option value="675424baa3d855a4d760c682--Sarath S">Sarath S</option>
                                                    <option value="61b1d61da6bbc942090883e5--Selvaganapathy A">Selvaganapathy A</option>
                                                    <option value="6442f2de8eb6d871ac745d0a--Suresh D">Suresh D</option>
                                                    <option value="6442fa968eb6d871ac745d63--Vignesh K">Vignesh K</option>
                                                    <option value="6442ec938eb6d871ac745cb2--Vijay A">Vijay A</option>
                                                    <option value="6442edf38eb6d871ac745ccb--Viswaraj G">Viswaraj G</option>
                                                    <option value="6442f62c8eb6d871ac745d1e--Kalaivani T">Kalaivani T</option>
						    <option value="6442fd868eb6d871ac745d8b--Ponnumani">Ponnumani</option>
						    <option value="63e9d3e9c8256101d2321209--Dineshraj">Dineshraj</option>
						    <option value="65ab78b258f1e7048bf57ea3--Thiripura Sundari K">Thiripura Sundari K</option>

                                                </select>
                                            </div>                       
                                           
                                            <div class="col-md-12 mt-3 ">
                                                <label class="form-label" for="remarks">Remarks</label>
                                                <input type="text" id="remarks" name="remarks" value="" class="form-control" placeholder="Feedback">
                                            </div>                                       


                                            <!-- Submit Button -->
                                            <div class="row mt-4">
                                                <div class="col-md-12">
                                                    <button type="submit" id="free-crm-submit-sv" class="btn btn-primary w-100 fw-bold">Submit</button>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- End of Second Form -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <div class="leadexist" style="display: none;">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 form-wrapper  text-center">
                        <div class="warapperform mt-5">
                            <div class="lead_id text-success"></div>
                            <p>Existing lead</p>
                            <p class="leadidshow"></p>
                            <p>Lead already exists. Thank you! </p>
                            
                            <a href="form.php">Back to Visit</a>
                            <br>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

    <div class="leadthankyou" style="display: none;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 form-wrapper  text-center">
                    <div class="warapperform mt-5">
                        <div class="lead_id text-success"></div>
                            <p> New lead </p>
                            <p class="leadidshow"></p>
                            <p>Lead successfully registered. Thank you! </p>
                        <a href="form.php">Back to Visit</a>
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script type="text/javascript" defer src="js/validate.js"></script>
    <script type="text/javascript" defer src="js/intlTelInput.js"></script>
    <script src="js//jquery.datetimepicker.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="./js/moments.js"></script>
    <script src="./js/custom.js"></script>
    <script>   
    $(document).ready(function () {
    // Fetch CSV file
    $.ajax({
        url: 'csv/cpname_3.csv',
        dataType: 'text',
        success: function (data) {
            const cpData = parseCSV(data); // Parse the CSV data
            setupSelect2(cpData); // Initialize Select2 with parsed data
        },
        error: function () {
            alert("Error loading CSV file.");
        }
    });

    // Function to parse CSV data
    function parseCSV(data) {
        const rows = data.split('\n');
        const cpData = [];
        rows.forEach((row, index) => {
            if (index > 0 && row.trim() !== '') { // Skip header and empty rows
                const cols = row.split(',');
                cpData.push({
                    id: cols[1].trim(), // CP Id
                    authorisedName: cols[3].trim(), // Authorised Name
                    companyName: cols[2].trim() // Company Name
                });
            }
        });
        return cpData;
    }


    // Setup Select2 with a minimum input length
    function setupSelect2(cpData) {
        $('#cpname').select2({
            placeholder: "Search by Authorised Name",
            minimumInputLength: 3, // Requires typing at least 3 characters
            data: cpData.map(cp => ({
                id: cp.id, // CP Code
                text: `${cp.authorisedName} (${cp.companyName}) ${cp.id}`, // Display Authorised Name with Company Name
                fullname: `${cp.authorisedName} (${cp.companyName}) ${cp.id}` // Keep the name accessible
            })),
            multiple: false
        });

        // Handle selection and autofill CP Code
        $('#cpname').on('select2:select', function (e) {
            const selectedId = e.params.data.id;
            console.log("clickede" + selectedId)
            const selectedCp = cpData.find(cp => cp.id === selectedId);
            if (selectedCp) {
                // Autofill CP Code
                $('#cpcode').val(selectedCp.id);
                // Update the Select2 displayed value
                $('#cpname').val(selectedCp.id).trigger('change'); // Ensure Select2 reflects the change
                $('#cpnamecpcode').val(e.params.data.fullname);
                
            } else {
                // Clear if nothing is selected
                $('#cpcode').val('');
            }
        });

        // Clear CP Code when cleared
        $('#cpname').on('select2:clear', function () {
            $('#cpcode').val('');
        });
    }
});

    </script>

</body>

</html>
