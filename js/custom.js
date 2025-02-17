$(document).ready(function () {
   
  //key press validation ends
  var now = moment().format("DD / MM / YYYY, h:mm A");
  // Saturday, June 9th, 2007, 5:46:21 PM
  $(".currentdatetime").val(now);

  jQuery("#scheduledon").datetimepicker({
    format: "Y-m-d H:i",
    minDate: new Date(),
    defaultDate: new Date(),
  });

  var d = new Date();
  var formattedDate =
    d.getDate() + "-" + (d.getMonth() + 1) + "-" + d.getFullYear();
  var hours = d.getHours() < 10 ? "0" + d.getHours() : d.getHours();
  var minutes = d.getMinutes() < 10 ? "0" + d.getMinutes() : d.getMinutes();
  var formattedTime = hours + ":" + minutes;
  formattedDate = formattedDate + " " + formattedTime;
  $("input#scheduledon").val(formattedDate);

  $("#svleadphone,#inputvalue").on("keypress", function (evt) {
    var charCode = evt.which ? evt.which : evt.keyCode;
    if (charCode > 31 && (charCode < 48 || charCode > 57)) return false;
    // return true;
  });

  var leadid = "";

  // GET OTP
  const today = new Date();
  const yyyy = today.getFullYear();
  let mm = today.getMonth() + 1; // Months start at 0!
  let dd = today.getDate();

  if (dd < 10) dd = "0" + dd;
  if (mm < 10) mm = "0" + mm;

  const formattedToday = dd + "/" + mm + "/" + yyyy;
  document.getElementById("todaydate").value = formattedToday;
 
  let exisit_msg = "" ;

  $("#checklead").validate({
    submitHandler: function () {
      $("#searchlead").text("Please wait....").attr("disabled", "true");
      $.ajax({
        type: "POST",
        url: "checklead.php",
        data: $(".checklead").serialize(),
        success: function (response, status, xhr) {
          
        // Assuming the response is a JSON string
            const result = JSON.parse(response);  // Parse the JSON response

            $("input#svleadphone").val($("#inputvalue").val());            
                            
            if (result.exists === true) {
                  exisit_msg = true;
                // Assuming result.created_at is a string in ISO format (e.g., "2022-02-03T07:53:10.593Z")
                  let createdAt = new Date(result.lead.created_at); // Convert to a Date object
                  let currentDate = new Date(); // Get the current date
                  let lead_stage = result.lead.stage;

                  // Calculate the difference in milliseconds
                  let differenceInMs = currentDate - createdAt;
                  // Convert the difference to days
                  let differenceInDays = Math.floor(differenceInMs / (1000 * 60 * 60 * 24));

                  console.log(`Difference in days: ${differenceInDays}`);
                  console.log(`Lead stage is : ${lead_stage}`);
  
                  // Compare the dates
                  if (differenceInDays < 30 ) {
                        if(lead_stage =="lost" || lead_stage =="unqualified"){
                          $('#re_enagamenent').val("yes"); 
                          console.log("lead less than 30 but lost/unqualified so, will be re-enagaged");
                        }else{
                          $('#re_enagamenent').val("no"); // Set the value of the input field
                          console.log("lead will NO re-enagage");
                        }

                  } else {
                      $('#re_enagamenent').val("yes"); 
                      console.log("lead will be re-enagaged");
                  }
                //SHOW FORM 
                $("#formselldo").show();
                $("#checklead").hide();
                 // Populate details on the form
                 if (result.lead.salutation) $('#salutation').val(result.lead.salutation);
                 if (result.lead.name) $('#name').val(result.lead.name);
                 if (result.lead.email) $('#mail').val(result.lead.email);
            }  
          // IF THE LEAD IS NEW 
            if(result.exists === false) {
              $('#re_enagamenent').val("yes");
              $("#formselldo").show();
              $("#checklead").hide();
              $(".leadexist").hide();
              exisit_msg = false;            
            }         
        },
        error: function (resp, status, xhr) {
          // Handle error
        }
      });
    }, // End submitHandler
  });

  

  $("#formselldo").validate({
      rules: {
            wd: {
              required: true,
            },
            sourcing_manager: {
              required: function (element) {
                var abtaction = $("#about_us").val();
                if (
                  abtaction == "Channel Partner" ||
                  abtaction == "Presales" ||
                  abtaction == "Referral" ||
                  abtaction == "Others"
                ) {
                  return true;
                } else {
                  return false;
                }
              },
            }, 
      },

      submitHandler: function () {
        // alert("lv1");
        $("#free-crm-submit-sv").attr("disabled", true).html("Please wait...");
        $.ajax({
          url: "sitevisit.php",
          type: "POST",
          data: $("#formselldo").serialize(),
          success: function (response) {
            // alert("lv2");
            // alert("Lead has been submitted");
            response = JSON.parse(response);
            console.log(response);
            $(".lead_id").append(
              `<p style="margin:20px 0px;">Lead ID : ${response}</p>`,
            );
            $("#formselldo").hide();
            console.log("console: "+exisit_msg);
            if(exisit_msg)
              $(".leadexist").show();
            else
              $(".leadthankyou").show();
          },
        });
      },

  });


    var countryData = window.intlTelInputGlobals.getCountryData();
    var input = document.querySelector("#leaddialcode");
    window.intlTelInput(input, {
      initialCountry: "in",
      nationalMode: true,
      utilsScript: "",
    });

    input.addEventListener("countrychange", function () {
      var currentVal = $("#leaddialcode").val();
      // console.log(currentVal);

      if (currentVal != "+91") {
        $("#leadphone").attr("minlength", 7);
        $("#leadphone").attr("maxlength", 12);
      } else {
        $("#leadphone").attr("minlength", 10);
        $("#leadphone").attr("maxlength", 10);
      }
    });

});


var users = "";
var project = "";

function formdata() {
  $.ajax({
    type: "POST",
    url: "formdata.php",
    data: {
      flaga: 1,
    },
    success: function (resp) {
      var response = JSON.parse(resp);

      project = JSON.parse(response["project"]);
      //console.log(project);
      users = JSON.parse(response["user"]);
    
      project["results"].forEach(function (element) {
        $("#project_lists").append(
          '<option value="' +
          element._id +
          "--" +
          element.name +
          '">' +
          element.name +
          "</option>",
        );
      });

      // $.each(users.all_users, function (k) {
      //   // console.log(users.all_users[k]);
      //   if ((users.all_users[k].role == "sales") && (users.all_users[k].is_active)) {
      //     $("#sales").append(
      //       '<option value="' +
      //       users.all_users[k].id + '--' + users.all_users[k].text +
      //       '">' +
      //       users.all_users[k].text +
      //       "</option>",
      //     );
      //   }

      // });
    },
    error: function (resp, status, xhr) {
      // alert(resp);
    },
  });
} 
formdata();
