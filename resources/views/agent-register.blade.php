@extends('layouts.app')
@section('content')
<style type="text/css">
	.add-diploma-btn,.remove-diploma-btn{
		position: relative;
    	top: -5px;
    	left: 5px;
	}
	.remove-diploma-btn{
		left: 10px;
	}
</style>

<div class="contact_panel">
  <div class="container">
    <div class="row"> 
        <div class="col-md-12">
            <div class="contact_box">
                <h3><i class="fa fa-pin"></i> Become An Agent</h3>
                <form id="general_form" method="post" action="{{url('/register_agent')}}" enctype="multipart/form-data" novalidate="novalidate">
                	@csrf
	                <div class="contact_form">
	                  	<div class="row">
		                    <div class="col-md-6">
		                      	<div class="form-group">
			                       	<label>First Name</label>
				                	<input type="text" name="first_name" class="form-control" placeholder="Enter Your First Name" />
			             	  	</div>
		                    </div>
		                    <div class="col-md-6">
		                      <div class="form-group">
				                <label>Last Name</label>
				                <input type="text" name="last_name" class="form-control" placeholder="Enter Your last Name" />
		                      </div>
		                    </div>
	                	</div>

	                    <div class="row">
	     					<div class="col-md-6">
		                      <div class="form-group">
				                <label>Email Address</label>
				                <input type="text" name="email" class="form-control" placeholder="Enter Your Email" />
		                      </div>
		                    </div>
	                      	<div class="col-md-6">
		                      <div class="form-group">
				                <label>Phone Number</label>
				                <input type="text" name="phone" class="form-control" placeholder="Enter Your Phone Number" />
		                      </div>
	                    	</div>
	               		</div>
	                	<div class="row">
	                		<div class="col-md-6">
		                      <div class="form-group">
				                <label>Identity Card</label><br>
				                <input type="file" name="identity_card" class="" placeholder="Upload Your ID Proof Document" />
		                      </div>
	                    	</div>
		                  <div class="col-md-6">
		                      <div class="form-group ">
				                <label>Social Security Number</label><br>
				                <input type="file" name="social_security_number" class="" placeholder="Upload Your Agent Number Document" />
		                      </div>
		                    </div>
	                	</div> 
	                	<div class="row">
	                		<div class="col-md-6">
		                      <div class="form-group">
				                <label>Curriculum Vitae</label><br>
				                <input type="file" name="cv" class="" placeholder="Upload Your Curriculum Vitae" />
		                      </div>
	                    	</div>
		                  <div class="col-md-6">
		                      <div class="form-group ">
				                <label>IBAN Info</label><br>
				                <input type="text" name="iban" class="form-control" placeholder="Enter Your IBAN Info" />
		                      </div>
		                    </div>
	                	</div> 

	                   <div class="row">
		                    <div class="col-md-6">
		                      <div class="form-group ">
					                <label>Agent Type</label>
					                <select class="form-control" name="agent_type" id="select_agent_type">
					                    <option>Select</option>
					                    <option value="1">Agent SIAP 1</option>
					                    <option value="2">Agent SIAP 2</option>
					                    <option value="3">Agent SIAP 3</option>
					                    <option value="4">ADS With Vehicule or Not</option>
					                    <option value="5">Body Guard Without Weapon</option>
					                    <option value="7">Hostesses</option>
					                    <option value="6">Dog Handler</option>
					                </select>
			                    </div>
		                    </div>
							<div class="col-md-6 cnaps_number" >
		                      	<div class="form-group ">
					                <label>CNAPS Number</label>
				                    <input type="text" name="cnaps_number" class="form-control" placeholder="Enter Your CNAPS Number " />
		                     	</div>
		                    </div>
	                  </div>   
	                  <div class="row diploma  d-none">
	                		<div class="col-md-6">
		                      <div class="form-group">
				                <label>Diploma </label><br>
				                <div class=" d-inline" id="diploma-group">
				                	<label for="diploma" class="lbl-diploma btn btn-light"><i class="fa fa-upload"></i></label>
				                </div>

				                <button type="button" class="add-diploma-btn btn btn-secondary" title="Add files">+</button>
				                <button type="button" class="remove-diploma-btn btn btn-danger d-none" title="Remove files">-</button>

				                <input type="file" id="diploma" name="diploma[]" multiple="multiple" class="d-none" placeholder="Upload Your Diploma Certificate" />
		                      </div>
	                    	</div>
	                    </div>
	                   <div class="row">
	                    <div class="col-md-6">
	                      <div class="form-group ">
			                <label>Home Address</label>
		                    <input type="text" name="home_address" class="form-control" placeholder="Enter Your home address " />
	                      </div>
	                    </div>
	                    <div class="col-md-6">
	                      <div class="form-group ">
			                <label>Work Location</label>
			                <input id="autocomplete" name="work_location_address" placeholder="Enter your address" class="form-control"  onFocus="geolocate()" type="text"/>
			                <!--Work Location Lat Longs  -->
			                <input type="hidden" name="work_location[lat]" />
			                <input type="hidden" name="work_location[long]" />
	                      </div>
	                    </div>
	                  </div>  
	                  <div class="row text-center pt-5">
	                    <div class="col-md-12">
		                    <input type="hidden" name="current_location[lat]" />
			                <input type="hidden" name="current_location[long]" />
				            <div class="form-group">
				               <input type="submit" class="yellow_btn" value="Become Agent"/>
				            </div>
	                    </div>
	                  </div>  
	                </div>
            	</form>
            </div>
        </div>        
    </div>  
    </div>
</div>


          
<!-- Google Place API -->
<script>
//script for SIAP 
$('#select_agent_type').change(function(){
	let value = $(this).val();
	$('.cnaps_number').removeClass('d-none');
	$('.diploma').addClass('d-none');
	if(value <=3){
		$('.cnaps_number').addClass('d-none');
		$('.diploma').removeClass('d-none');
	}
});

// $('#diploma').change(function(){
// 	let value = $(this).val();
// 	return false;
// 	let lbl_length = $('#diploma-group').children().length;
// 	if(lbl_length == ''){
// 		let last_label = $('#diploma-group').children().last();
// 		last_label.attr('for','');
// 	}
// });

$('.add-diploma-btn').click(function(){
	let diploma_label = '<label for="diploma" class="lbl-diploma btn btn-light"><i class="fa fa-upload"></i></label>';
	$('#diploma-group').append(diploma_label);
	$('.remove-diploma-btn').removeClass('d-none');
});

$('.remove-diploma-btn').click(function(){
	let lbl_length = $('#diploma-group').children().length;
	let last_label = $('#diploma-group').children().last();
	if(lbl_length == 2){
		$(this).addClass('d-none');
		last_label.remove();
		return false;
	}
	last_label.remove();
});

var placeSearch, autocomplete;

function initAutocomplete() {
  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.
  autocomplete = new google.maps.places.Autocomplete(
      document.getElementById('autocomplete'), {types: ['geocode']});

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  // autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}

function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();
  var work_location_lat = document.querySelector("input[name='work_location[lat]']");
  var work_location_long = document.querySelector("input[name='work_location[long]']");
  work_location_lat.value = place.geometry.location.lat(); 
  work_location_long.value = place.geometry.location.lng(); 
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var geolocation = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      // set current position
      var current_location_lat = document.querySelector("input[name='current_location[lat]']");
      var current_location_long = document.querySelector("input[name='current_location[long]']");
      current_location_lat.value = position.coords.latitude; 
      current_location_long.value = position.coords.longitude;
      
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}

// function getLocation() {
//   if (navigator.geolocation) {
//     navigator.geolocation.getCurrentPosition(showPosition);
//   } 
// }
// getLocation();
// function showPosition(position) {
//   var current_location_lat = document.querySelector("input[name='current_location[lat]']");
//   var current_location_long = document.querySelector("input[name='current_location[long]']");
//   current_location_lat.value = position.coords.latitude; 
//   current_location_long.value = position.coords.longitude;
// }
// function initialize(){
//   initAutocomplete();
// }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqV_RbB8pVKnMhqiIYYuwuz_25qazoILA&libraries=places&callback=initAutocomplete"
    async defer></script>
<!-- Bootstrap core JavaScript -->
@endsection