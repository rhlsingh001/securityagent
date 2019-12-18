@extends('layouts.app')
@section('content')
<div class="banner">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="banner_cont">
                    <h1>Votre agent de securite des que possible</h1>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="map_panel text-center contact_box ">
                    <h2>Les Meilleurs sont pres de chez vous</h2>    
                    <p>Search by city, address, postalcode, etc...</p>
                    <form method="get" action="{{url('/available-agents')}}">
                    <div class="locationSearch">
                        <input id="autocomplete" placeholder="Enter your location" class="form-control"  onFocus="geolocate()" type="text"/>
                            <!--Work Location Lat Longs  -->
                        <input type="hidden" name="latitude" />
                        <input type="hidden" name="longitude" />
                        <span><i class="fa fa-paper-plane"></i></span>
                    </div>
                    <button class="yellow_btn">Search Now</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="comment_panel">
    <div class="container">
        <div class="heading text-center">
            <h2>Comment Ca Marche ?</h2>
            <img src="{{asset('assets/images/heading_bottom.png')}}"/>
        </div>
        <p>Lorem Ipsum est un générateur de faux textes aléatoires. Vous choisissez le nombre de paragraphes, de mots ou de listes. Vous obtenez alors un texte aléatoire que vous pourrez ensuite utiliser librement dans vos maquettes. Lorem Ipsum est un générateur de faux textes aléatoires. Vous choisissez  Vous obtenez alors un librement dans vos maquettes.</p>
    </div>
</div>    
<div class="how_works">
    <div class="container">
        <div class="heading text-center">
            <h2>How It Works?</h2>
            <img src="{{asset('assets/images/heading_bottom.png')}}"/>
        </div> 
        <div class="row">
            <div class="col-md-6">
                <div class="agent">
                    <h4>I’m an Agent</h4>
                    <img src="{{asset('assets/images/agent.jpg')}}"/>
                </div>
            </div>
            <div class="col-md-6">
                <div class="customer">
                    <img src="{{asset('assets/images/customer.jpg')}}"/>
                    <h4>I’m an User</h4>                        
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="how_work_listing">
                    <ul>
                        <li><a href="#"><span><i class="fa fa-search"></i></span> Find an agent available right now or schedule a mission</a></li>
                        <li><a href="#"><span><i class="fa fa-copy"></i></span>  Register and post your mission requested</a></li>
                        <li><a href="#"><span><i class="fa fa-phone"></i></span> Receive a quick answer with quotation</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="testimonial_panel">
    <div class="container">
        <div class="heading text-center">
            <h2>Nos Derniers Temoigna</h2>
            <img src="{{asset('assets/images/heading_bottom.png')}}"/>
        </div>  
        <div class="row">
            <div class="col-md-4">
                <div class="testimonial_box">
                    <div class="testimonial_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>
                    </div>
                    <div class="testimonial_img_name">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="testimonial_img">
                                    <img src="{{asset('assets/images/testi_person1.jpg')}}"/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="testimonial_name">
                                    <h4>Robert Peterson</h4>
                                    <div class="star">
                                        <img src="{{asset('assets/images/star.jpg')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial_box">
                    <div class="testimonial_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>
                    </div>
                    <div class="testimonial_img_name">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="testimonial_img">
                                    <img src="{{asset('assets/images/testi_person2.jpg')}}"/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="testimonial_name">
                                    <h4>Evelyn Martinez</h4>
                                    <div class="star">
                                        <img src="{{asset('assets/images/star.jpg')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="testimonial_box">
                    <div class="testimonial_cont">
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquid, suscipit, rerum quos facilis repellat architecto commodi officia atque nemo facere eum non illo voluptatem quae delectus odit vel itaque amet.</p>
                    </div>
                    <div class="testimonial_img_name">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="testimonial_img">
                                    <img src="{{asset('assets/images/testi_person3.jpg')}}"/>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="testimonial_name">
                                    <h4>Dan Hodges</h4>
                                    <div class="star">
                                        <img src="{{asset('assets/images/star.jpg')}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div> 
<script>
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
  var search_location_lat = document.querySelector("input[name='latitude']");
  var search_location_long = document.querySelector("input[name='longitude']");
  search_location_lat.value = place.geometry.location.lat(); 
  search_location_long.value = place.geometry.location.lng(); 
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
      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCqV_RbB8pVKnMhqiIYYuwuz_25qazoILA&libraries=places&callback=initAutocomplete"
    async defer></script>    
@endsection  
