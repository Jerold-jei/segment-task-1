<html>
    <head>    
       <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
       <link rel="stylesheet" href="style.css">      
    </head>
<body>
<div class="container demo">	
	<div class="text-center">	
		<button type="button" class="btn btn-demo" data-toggle="modal" data-target="#myModal2">
			Save Segment
		</button>
	</div>
	<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
		<div class="modal-dialog" role="document">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel2">Save Segment</h4>
				</div>

				<div class="modal-body">
					<div class="modal-form">
                        <div class="row">
                            <div class="col-md-12">
                                <form class="segmentForm" id="segment_form" action="" method="post" enctype="multipart/form-data">
                                    <div class="row">
                                       <div class="col-md-12">
                                            <label>Enter the Name of the Segment</label>
                                       </div> 
                                        <div class="col-md-12">
                                         <input placeholder="Name of the Segment*" type="text" id="segmentname" name="segmentname" class="form-control" value="" onkeypress="return (event.charCode > 64 && 
                                            event.charCode < 91) || (event.charCode > 96 && event.charCode < 123)"> 
                                         <span class="form-error" id="segment_name-error"></span>                                          
                                        </div> 
                                       <div class="col-md-12" id="append-label">
                                       <br><label>To save your segment, you need to add the schemas to build the query </label>
                                       </div>
                                       <div class="col-md-12">
                                            <select class="form-control form-select" id="segment_select" name="segment_select">
                                                    <option value="">Add schema to segment</option>
                                                    <option value="first_name">First Name</option>
                                                    <option value="last_name">Last Name</option>
                                                    <option value="gender">Gender</option>
                                                    <option value="age">Age</option>
                                                    <option value="account_name">Account Name</option>
                                                    <option value="city">City</option>
                                                    <option value="state">State</option>
                                            </select>
                                            <span class="form-error" id="segment_select-error"></span><br> 
                                       </div>                                  
                                       <div class="col-md-12">
                                            <a class="seg-link" id="add_new_schema" >Add new Schema</a>
                                       </div>
                                    
                                       <div class="col-md-12">
                                            <div class="form-buttons">
                                                <button type="submit" id="btn-submit" class="btn  btn-success">Save Segment</button>
                                                <button type="button" class="btn  btn-danger">Cancel</button>
                                            </div>
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
	
</div>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>  
<script src="https://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $('#btn-submit').click(function(v){   

            var dd1 = $("#append-label");
            const schemas = []; 

            if (dd1.childElementCount > 0) {   
                    console.log('has child');                   
                }else{  
                    var firstname = $("#segment_select_2").val();    
                    var lastname = $("#segment_select_3").val();
                    var gender = $("#segment_select_4").val();
                    var age = $("#segment_select_5").val();
                    var accountname = $("#segment_select_6").val();
                    var city = $("#segment_select_7").val();
                    var state = $("#segment_select_8").val();  

                    if((firstname != '') && (lastname != '') && (gender != '') && (age != '') && (accountname != '') && (city != '') && (state != '')){
                        schemas.push({FirstName : firstname , LastName : lastname, Gender : gender, Age : age, AccountName : accountname, City : city, State : state});
                    }
                    // console.log(schemas);
                } 
            const filter = {
                    segmentname: $("#segmentname").val(),
                    schemas:schemas,                    
                };
                console.log(filter);
           });

        $('#add_new_schema').click(function(v){            
            if ($('#segment_form').valid()) {

                let name = $('#segment_select').val();
                // alert(name);

                var index = $("#segment_form select").length + 1;
                var dd1 = $("#append-label");
                
                var ddl = $("#segment_select").clone();        
                
                ddl.attr("id", "segment_select_" + index);
                ddl.attr("name", "segment_select_" + index);                
                var selectedValue = $("#segment_select option:selected").val();
                ddl.find("option[value = '" + selectedValue + "']").attr("selected", "selected");
                        
                $("#segment_select option:selected").remove();
                $("#append-label").append(ddl);
                $("#append-label").append("<br />");

                if (dd1.childElementCount > 0) {   
                    console.log('has child');                   
                }else{                   
                    $('#segment_select').prop('selectedIndex',0);
                }    
                
               
                

            } else {
                alert('Please select the segment');
            }                           
        });  

        $('#segment_form').validate({                         
                    rules: {   
                        segmentname:{
                            required:true
                        },                     
                        segment_select:{
                            required:true
                        }                       
                    },
                    messages: {                        
                        segment_select:'*Please Select Segment',  
                        segmentname:'Please Enter Segment Name',
                                             
                    },
                    
                    errorPlacement: function(error, element) {
                        var placement = $(element).attr("name");
                        // console.log(placement);
                        
                        if(placement == "segment_select"){
                            $('#segment_select-error').html(error);
                        }else if(placement == "segmentname") {
                            $('#segment_name-error').html(error);
                        }                     
                        else {
                            error.insertAfter(element);
                        }
                        },
                        
                    submitHandler: function (form) {                       
                            return false;                            
                    }
                    }); 
        
    });
</script> 
</body>
</html>