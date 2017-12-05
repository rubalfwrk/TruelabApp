<?php
/**
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       Cake.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!doctype html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <title><?php echo "Truelab ".$title_for_layout; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
        <link href="<?php echo $this->webroot; ?>home/css/base.css" rel="stylesheet">
        
       
        <link href="<?php echo $this->webroot; ?>home/css/skins/square/grey.css" rel="stylesheet">
       
         
        <script src="<?php echo $this->webroot; ?>home/js/modernizr.js"></script> 

       
        
        <script src="<?php echo $this->webroot; ?>js/instrument.js"></script>
<script id="failure-capture">
      docReady(function() {
        setTimeout(function() {
          if (!window.React) {
            instrumentJS();
          }
        }, 3000);
      });
    </script>
<script>
      window.ga=window.ga||function(){(ga.q=ga.q||[]).push(arguments)};ga.l=+new Date;
      ga('create', 'UA-57200812-1', 'auto');
      ga('send', 'pageview');
    </script>
<script async src="<?php echo $this->webroot; ?>js/analytics.js"></script>
<script>
      /* <![CDATA[ */
      goog_snippet_vars = function() {
        var w = window;
        w.google_conversion_id = 940748023;
        w.google_conversion_label = "H0qkCKzNzWIQ99nKwAM";
        w.google_remarketing_only = false;
      }
      // DO NOT CHANGE THE CODE BELOW.
      goog_report_conversion = function(url) {
        goog_snippet_vars();
        window.google_conversion_format = "3";
        window.google_is_call = true;
        var opt = new Object();
        opt.onload_callback = function() {
          if (typeof(url) != 'undefined') {
            window.location = url;
          }
        }
        var conv_handler = window['google_trackConversion'];
        if (typeof(conv_handler) == 'function') {
          conv_handler(opt);
        }
      }
      /* ]]> */
    </script>
<script src="<?php echo $this->webroot; ?>js/conversion_async.js"></script>
<script src="<?php echo $this->webroot; ?>js/4853820972.js"></script>
                  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>

        
        <style> 

            .glyphicon-unchecked,.glyphicon-check{
                font-size: 23px !important;
                color: #dedede !important;
                margin-bottom: -21px !important;
                padding-bottom: 0;
                font-weight: normal;
                margin: 0;
                padding: 0;
                width: 29px !important;
                float: left;
                margin-top: -4px;
            }
   
            .chk{
                width: 23px !important;
                height: 23px;
                float:left;

            }
            .lable1{
                margin-left: 7px !important;	
            }
            .bs-checkbox{
                width: 23px !important;
                height: 23px;
                float: left;
                /* margin-top: -4px; */	
            }
            .search_n > button{
                background: none;
                border: none;
                padding: 7px 0;	
                outline: none; 

            }
            #autocomplete_a,#autocomplete_b{
                margin-left: -7px; 
            }
            .search_n {
                color: #fff !important;
                float: left;
                margin: 4px 0 4px 0;
                text-align: center;
                height: 35px;
                width: 98%;
            }
            .tab-content,.nav-tabs {

                border: none; 
            }
            .span2{    height: 37px;  left: -7px ;
                       }
            .tab-pane {
                padding: 0;
                margin: 0;
                width: 99.8%;
                margin-left: 1px;	
            }

header {
   width: 100%;
float: left;
background: rgb(96, 96, 96) none repeat scroll 0% 0%;
padding: 0px 10%;
box-shadow: 0px 0px 2px #c2c2c2;
text-align:center;
}
footer {
width: 100%;
float: left;
background: rgb(248, 248, 248) none repeat scroll 0% 0%;
padding: 0px 10%;
box-shadow: 0px 0px 2px #c2c2c2;
position: fixed;
bottom: 0;
}
.login_frm {
    background: #fff none repeat scroll 0 0;
    border-radius: 7px;
    box-shadow: 0 0 5px #ccc;
    margin-bottom: 11vh;
    margin-top: 9vh;
    padding: 15px;
    width: 100%;
}
 .Footer-links {
    float: left;
}
.Footer-legalInfo {
    color: #333;
    line-height: 5;
}   
	    </style>

    </head>

    
    <body>
    <div id="React">
  <div data-reactroot="" class="App">
    <header class="Header Menu Header--hero Menu--hero">
  
    <a class="Menu-rootLink" href="">
       <img src="<?php echo FULL_BASE_URL . $this->webroot . 'home/logo.png'; ?>" style=" width:138px;padding: 11px 0 2px 0;">
    	
    </a>
      <!--<button class="Menu-toggle Menu-toggle--open">Menu</button>
      <button class="Menu-toggle Menu-toggle--close icon icon-close"></button>
       <div class="Menu-mobileNav">
        <div class="Menu-mobileNavContainer">
        <a href="#" class="Menu-mobileNavItem login_shw">Log In</a>
        <a href="#" class="Menu-mobileNavItem signup_hde">Sign Up</a>
        <!-- react-empty: 16 </div>
      </div>
      <nav class="Menu-nav">
      <a href="#" class="Menu-navItem1 login_shw active11">Log In</a>
      <a href="#" class="Menu-navItem1 signup_hde ">Sign Up</a>
      <!-- react-empty: 21 
      </nav>-->
      
      
      <ul class="btn_log">
      <?php /* if (empty($loggeduser)) { ?>
     
                                    <li><a href="#0" data-toggle="modal" data-target="#register" class="signup_hde active11">Register</a></li>
                                    <li> <a href="#0" data-toggle="modal" data-target="#login_2" class="login_shw active11">Log In</a></li>
                                <?php } else { ?>
                        <li style="position:relative;"><a href="#" class="login_shw myacc_hde active11">My Account</a>
                        
                        <ul class="account_child"> 
                        <li> <a href="https://www.readytodropin.com/users/myaccount"> My Profile </a> </li>
                        	<li> <a href="https://www.readytodropin.com/users/changepassword"> Change Password </a> </li>
                            <li> <a href="https://www.readytodropin.com/restaurants/orderhistory"> Order History </a> </li>
                            <li> <a href="https://www.readytodropin.com/restaurants/reservationhistory"> Reservation History </a> </li>
                          
                            <li> <a href="https://www.readytodropin.com/pages/privacyandpolicy"> Privacy Policy </a> </li>
                        </ul>
                        
                        
                        </li>        
                                    <li><a href="<?php echo $this->webroot ?>users/logout" class="login_shw active11" >Log Out</a></li>
                              <!--      <li style=" list-style:none;"><a href="<?php // echo $this->webroot; ?>users/myaccount">Myaccount</a></li>-->
                            
                                <?php } */ ?>
  </ul>

     
    </header>
    </div>
    </div>
    
    
    <br/> <br/>
    
    
    
    
    
    
    
    
    
    
    
        <!-- End Header =============================================== -->   
        <?php echo $this->fetch('content'); ?>
        
        
        
 <?php  @$latitudex = $restaurant['Restaurant']['latitude']; 
        @$longitudex = $restaurant['Restaurant']['longitude'];
	   ?>
        <!-- Footer ================================================== -->
        <footer class="Footer">
      <div class="Container">
      <div class="col-md-12">
      <a href="https://www.readytodropin.com" style=" text-align: center;  text-decoration: none; display:block;">
      <img src="<?php echo FULL_BASE_URL . $this->webroot . 'home/logo.png'; ?>" style=" width: 94px; padding: 13px 0px 2px;" >
      </a>
        <div class="Footer-links">
          <nav class="Footer-nav">
          

          <!-- <a class="Footer-navLink" href="https://www.readytodropin.com/pages/about">About</a><a class="Footer-navLink" href="https://www.readytodropin.com/pages/team">Team</a>
          <a class="Footer-navLink" href="https://www.readytodropin.com/pages/career">Careers</a>
          <a class="Footer-navLink" href="https://www.readytodropin.com/pages/contact">Contact</a>
          <a class="Footer-navLink" href="https://www.readytodropin.com/pages/faq"> FAQ </a> -->
         <!-- <a class="Footer-navLink" href="#/contact">APPLY AS RESTAURANT</a>--></nav>
          <nav class="Footer-socialNav">
          
          <!-- <?php foreach($social as $s){?>
		  <a href="<?php echo  $s['Social']['link']; ?>" class="Footer-socialNavItem icon <?php if($s['Social']['name'] == 'Facebook'){ echo 'icon-facebook';}elseif($s['Social']['name'] == 'Twitter'){ echo 'icon-twitter'; }elseif($s['Social']['name'] == 'Instagarm'){ echo 'icon-instagram'; }elseif($s['Social']['name'] == 'Linkedin'){ echo 'icon-linkedin'; } ?>" target="_blank"></a>
		  <?php }?> -->
          </nav>
        </div>
        <div class="Footer-legal" style="float: left; text-align: center; width: 100%; padding: 0px; height: 56px; line-height: 1px ! important; margin: -19px 0px 0px;"><span class="Footer-legalInfo">Copyright©2016</span>
        <!-- <a class="Footer-legalLink" href="https://www.readytodropin.com/pages/terms">Terms of Use</a>
        <a class="Footer-legalLink" href="https://www.readytodropin.com/pages/privacyandpolicy">Privacy Policy</a>
         --></div>
        </div>
      </div>
    </footer>
  </div>
</div>
 <script type='text/javascript' src='<?php echo $this->webroot; ?>js/jquery.js'></script>
 

 
<script src="<?php echo $this->webroot; ?>js/settings.js"></script> 
<script src="<?php echo $this->webroot; ?>js/index.js"></script>
<script src="<?php echo $this->webroot; ?>js/instrument.js"></script>
 <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXL1lHwsMrAD1zNspu_oCDGimxsP-Plbw&libraries=places&callback=initialize"
         async defer></script>
<script type="text/javascript">
                                // Google Map
                                function initialize()
                                {
                                    var geocoder  = new google.maps.Geocoder();
                                    var map;
                                    var latlng = new google.maps.LatLng(<?php echo $latitudex.','.$longitudex;?>);
                                    var infowindow = new google.maps.InfoWindow();
                                    var myOptions = {
                                        zoom: 17,
                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                    };

                                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

                                    geocoder.geocode( { 'location': latlng },
                                        function(results, status) {
                                            if (status == google.maps.GeocoderStatus.OK)
                                            {
                                                map.setCenter(results[0].geometry.location);
                                                var marker = new google.maps.Marker({
                                                    map: map,
                                                    position: results[0].geometry.location
                                                });
                                                //alert(results[0].formatted_address);
                                                //infowindow.setContent(results[0].formatted_address);
                                                //infowindow.open(map, marker);
                                            }
                                            else
                                            {
                                                alert("Geocode was not successful for the following reason: " + status);
                                            }
                                        });

                                }

                                initialize();
                            </script> 
        
        
        
     
     
     
     
     <!-- COMMON SCRIPTS -->
     
<script src="<?php echo $this->webroot; ?>home/js/addtocart.js"></script>
       <script src="<?php echo $this->webroot; ?>home/js/jquery-1.11.2.min.js"></script>
          
        <!-- SPECIFIC SCRIPTS -->
               <script src="<?php echo $this->webroot; ?>home/js/functions.js"></script>
        <script src="<?php echo $this->webroot; ?>home/assets/validate.js"></script>
        <script src="https://maps.googleapis.com/maps/api/js"></script>
        <script src="<?php echo $this->webroot; ?>home/js/map.js"></script>
        <script src="<?php echo $this->webroot; ?>home/js/infobox.js"></script>
       <script src="<?php echo $this->webroot; ?>home/js/video_header.js"></script>
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
        
    
      
        <script src="<?php echo $this->webroot; ?>home/js/common_scripts_min.js"></script>
        
        
       <script>
		   
		    
            function getQueryStringValue(key) {
                return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(key).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
            }
            var myURL = document.location;
            $(function () {
               $("#slider-range-max").slider({
                    range: "max",
                    min: 1,
                    max: 15,
                    value: 1,
                    slide: function (event, ui) {
                        $("#amount").val(ui.value);
                        var amt = ui.value;
                        //alert(amt);
                       
                       if (getQueryStringValue("distance")) { 
                                              
                            document.location=myURL.search.replace('&distance='+/\d+/+'','&distance='+amt+'');
                     
                            
                        } else {
                           
                            document.location = myURL + "&distance=" + amt;
                        }
                    }
                });
                HeaderVideo.init({
                    container: $('.header-video'),
                    header: $('.header-video--media'),
                    videoTrigger: $("#video-trigger"),
                    autoPlayVideo: true
                });
            });
            $('.alltype').on("click", function () {
                var checkboxes = document.getElementsByName('location[]');

                var vals = "";
                for (var i = 0, n = checkboxes.length; i < n; i++)
                {
                    
                    if (checkboxes[i].checked)
                    {
                        vals += "," + checkboxes[i].value;
                    }
                }
                if (vals)
                    vals = vals.substring(1);

                if (getQueryStringValue("type")) {
                    document.location = "<?php echo $_SERVER['PHP_SELF']?>/restaurants/restaurantsearch?search&type=" + vals;
                } else {
                    document.location = '<?php echo $_SERVER['PHP_SELF']?>/restaurants/restaurantsearch?search' + "&type=" + vals;
                }

            });

            $('.rtngs').on("click", function () {
                var checkboxes = document.getElementsByName('ratings[]');
                var vals = "";
                for (var i = 0, n = checkboxes.length; i < n; i++)
                {
                    if (checkboxes[i].checked)
                    {
                        vals += "," + checkboxes[i].value;
                    }
                }
                if (vals)
                    vals = vals.substring(1);
                
                if (getQueryStringValue("rate")) {
                    document.location = "&rate=" + vals;
                } else {
                    document.location = '<?php echo $_SERVER['PHP_SELF']?>/restaurants/restaurantsearch?search' + "&rate=" + vals;
                    
                }


            });
            
            $('#dlchk').on("click", function () {
                 var vals= $(this).val();
                
                if (getQueryStringValue("dlchk")) {
                    document.location = myURL.search.replace('&dlchk=delivery',''); 
                } else {
                    document.location = myURL + "&dlchk=" + vals;
                    
                }


            });
            $('#tkchk').on("click", function () {
                         var vals= $(this).val();
                
                if (getQueryStringValue("tkchk")) {
                           
                     document.location = myURL.search.replace('&tkchk=takeaway','') ;
                } else {
                    document.location = myURL + "&tkchk=" + vals;
                    
                }


            });
              
        </script>
        
      
        
        
     <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDXL1lHwsMrAD1zNspu_oCDGimxsP-Plbw&libraries=places&callback=initialize"
         async defer></script>   
        
        <script type="text/javascript">
      $("#autocomplete").on('focus', function () {
           geolocate();
       
               
            });
                        var placeSearch, autocomplete;
            var componentForm = {
                street_number: 'short_name',
                route: 'long_name',
                locality: 'long_name',
                administrative_area_level_1: 'short_name',
                country: 'long_name',
                postal_code: 'short_name'
            };
            function initialize() {
                             var options = {
  types: ['(cities)'],
  componentRestrictions: {country: "kw"}
 };
                // Create the autocomplete object, restricting the search
                // to geographical location types.
             autocomplete = new google.maps.places.Autocomplete(
                        /** @type {HTMLInputElement} */ (document.getElementById('autocomplete')),options);
         
             
                // When the user selects an address from the dropdown,
                // populate the address fields in the form.
                google.maps.event.addListener(autocomplete, 'place_changed', function () {
                    fillInAddress();
                });
           
           
            }


            // [START region_fillform]
            function fillInAddress() {
                // Get the place details from the autocomplete object.
                var place = autocomplete.getPlace();
                document.getElementById("latitude").value = place.geometry.location.lat();
                document.getElementById("longitude").value = place.geometry.location.lng();
                localStorage.setItem("lat", place.geometry.location.lat());
                localStorage.setItem("long", place.geometry.location.lng());

                for (var component in componentForm) {
                    document.getElementById(component).value = '';
                    document.getElementById(component).disabled = false;
                }

                // Get each component of the address from the place details
                // and fill the corresponding field on the form.
                for (var i = 0; i < place.address_components.length; i++) {
                    var addressType = place.address_components[i].types[0];
                    if (componentForm[addressType]) {
                        var val = place.address_components[i][componentForm[addressType]];
                        document.getElementById(addressType).value = val;
                    }
                }


            }
     
            // [END region_fillform]

            // [START region_geolocation]
            // Bias the autocomplete object to the user's geographical location,
            // as supplied by the browser's 'navigator.geolocation' object.
            function geolocate() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(function (position) {

                        var geolocation = new google.maps.LatLng(
                                position.coords.latitude, position.coords.longitude);


                        var latitude = position.coords.latitude;
                        var longitude = position.coords.longitude;

                        document.getElementById("latitude").value = latitude;
                        document.getElementById("longitude").value = longitude;

                        autocomplete.setBounds(new google.maps.LatLngBounds(geolocation, geolocation));

                    });
                }



            }
  

            initialize();

            // [END region_geolocation]

            $('#grd').on('click', function (e) {
                e.preventDefault();
                $('.lst,#grd').hide();
                $('.grd,#lst').show();
            });
            $('#lst').on('click', function (e) {
                e.preventDefault();


                $('.grd,#lst').hide();
                $('.lst,#grd').show();
            });
            function verhoz() {
                $('#grd').on('click', function (e) {
                    e.preventDefault();
                    $('.lst,#grd').hide();
                    $('.grd,#lst').show();
                });
                $('#lst').on('click', function (e) {
                    e.preventDefault();
                    $('.grd,#lst').hide();
                    $('.lst,#grd').show();
                });
            }
			
			

//var history = jQuery.noConflict(); 


	$(".btn.btn-primary.old_ord").click(function(){
		
	$(".resevation_history tbody").animate({"height":"470px"},800)
	});
	




        </script>
        <script>
            /*
             * bsCheckbox 0.2
             * Docs: https://github.com/ktasos/bs-checkbox
             * Author: Tasos Karagiannis
             * Website: http://codingstill.com
             * Twitter: https://twitter.com/codingstill
             */

            (function ($) {
                $.fn.bsCheckbox = function (options) {
                    options = $.extend({}, $.fn.bsCheckbox.defaultOptions, options);

                    this.each(function (idx, item) {
                        var jThis = jQuery(item);
                        var jCheck = jThis.find('input');
                        jThis.addClass('glyphicon').addClass(jCheck[0].checked ? 'glyphicon-check' : 'glyphicon-unchecked');

                        if (jThis.closest('label').length === 0) {
                            jThis.click(function () {
                                jCheck[0].checked = !jCheck[0].checked;
                                jThis.removeClass('glyphicon-check').removeClass('glyphicon-unchecked');
                                jThis.addClass(jCheck[0].checked ? 'glyphicon-check' : 'glyphicon-unchecked');
                                jCheck.trigger('change');
                            });
                        }

                        if (jThis.closest('.checkbox').length === 0 && jThis.closest('.form-group').length > 0) {
                            jThis.addClass('checkbox');
                        }

                        jCheck.change(function () {
                            jThis.removeClass('glyphicon-check').removeClass('glyphicon-unchecked');
                            jThis.addClass(jCheck[0].checked ? 'glyphicon-check' : 'glyphicon-unchecked');
                        });
                    });
                };

                $.fn.bsCheckbox.defaultOptions = {};
            })(jQuery);
        </script>

        <script>
            jQuery('.bs-checkbox').bsCheckbox();
        </script>
    </body>

    <script type="text/javascript">
        function valid_email_address(email)
        {
            var pattern = new RegExp(/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i);
            return pattern.test(email);
        }
        $('#nwsltr').on("click", function () {
            if (!valid_email_address($("#email").val()))
            {
                $(".message").html('Please make sure you enter a valid email address.');
            }
            else
            {
                $(".message").html("<span style='color:green;'>Almost done, please check your email address to confirmation.</span>");
                $.ajax({
                    url: 'https://www.readytodropin.com/shop/newsletter',
                    data: $('#subscribe').serialize(),
                    type: 'POST',
                    success: function (msg) {
                        if (msg == "success")
                        {
                            $("#email").val("");
                            $(".message").html('<span style="color:green;">You have successfully subscribed to our mailing list.</span>');

                        }
                        else
                        {
                            $(".message").html('Please make sure you enter a valid email address.');
                        }
                    }
                });
            }
            return false;
        });
    </script> 
   <!--<div class="login_popup">
    	<div class="frm_popup"> 
        <a href="#" class="close-link"><i class="icon_close_alt2"></i></a>
    	<form action="http://rajdeep.crystalbiltech.com/cart_new/abc/users/login" method="post" class="popup-form" id="myLogin">
                        <div class="login_icon"><i class="icon_lock_alt"></i></div>
                        <input type="text" name="data[User][username]" class="form-control form-white" placeholder="Username">
                        <input type="password" name="data[User][password]" class="form-control form-white" placeholder="Password">
                        <input type="hidden" name="data[User][server]" value="rajdeep.crystalbiltech.com/cart_new/abc/">
                        <div class="text-left">
                            <a href="/cart_new/abc/users/forgetpwd">Forgot Password?</a>
                        </div>
                        <button type="submit" class="btn btn-submit btn-submit1">Submit</button>
                    </form>
    </div> </div>
    


 <div class="login_popup1">
    	<div class="frm_popup1"> 
        <a href="#" class="close-link1"><i class="icon_close_alt2"></i></a>
    	<form action="http://rajdeep.crystalbiltech.com/cart_new/abc/users/add" class="popup-form" method="post" id="myRegister">
                        <div class="login_icon"><i class="icon_lock_alt"></i></div>
                        <input type="text" class="form-control form-white" name="data[User][fname]" placeholder="First Name">
                        <input type="text" class="form-control form-white" name="data[User][lname]" placeholder="Last Name">
                        <input type="email" class="form-control form-white" name="data[User][username]" placeholder="Email">
                        <input type="password" class="form-control form-white" name="data[User][password]" placeholder="Password" id="password1">
                        <input type="password" class="form-control form-white" placeholder="Confirm password" id="password2">
                        <input type="hidden" name="data[User][server]" value="rajdeep.crystalbiltech.com/cart_new/abc/">
                        <div id="pass-info" class="clearfix"></div>
                        <div class="checkbox-holder text-left">
                            <div class="checkbox checkbox1">
                                <input type="checkbox" value="accept_2" id="check_2" name="check_2">
                                <label for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-submit btn-submit1">Register</button>
                    </form>
    </div> </div>-->
   
                
<div class="layer"></div><!-- Mobile menu overlay mask -->

        <!-- Login modal -->   

        <div class="modal fade " id="login_2" tabindex="-1" role="dialog" aria-labelledby="myLogin" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-popup">
                    <a href="#" class="close-link guri" data-dismiss="modal" aria-label="Close"><i class="icon_close_alt2"></i></a>
                    <!--<p class="guri">rrrrrrrrrrrrr</p>-->
                    <form action="<?php echo $this->webroot; ?>users/login" method="post" class="popup-form" id="myLogin">
                        <div class="login_icon"><i class="icon_lock_alt"></i></div>
                        <input type="text" name="data[User][username]" class="form-control form-white" placeholder="Username">
                        <input type="password" name="data[User][password]" class="form-control form-white" placeholder="Password">
                        <input type="hidden" name="data[User][server]" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                        <div class="text-left">
                            <a href="<?php echo $this->webroot; ?>users/forgetpwd">Forgot Password?</a>
                        </div>
                        <button  class="btnwale" type="submit" class="btn btn-submit">Submit</button>
                    </form>
                </div>
            </div>

        </div>
        <!-- End modal -->   

        <!-- Register modal -->   
        <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="myRegister" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content modal-popup">
                    <a href="#" class="close-link guri" data-dismiss="modal" aria-label="Close"><i class="icon_close_alt2"></i></a>
                    <form action="<?php echo $this->webroot; ?>users/add" class="popup-form" method="post" id="myRegister">
                        <div class="login_icon"><i class="icon_lock_alt"></i></div>
                        <input type="text" required class="form-control form-white" name="data[User][name]" placeholder="Full Name" maxlength="50" pattern="[a-zA-Z][a-zA-Z0-9\s]*">
                        <input type="Email" required class="form-control form-white" name="data[User][email]"  placeholder="Email" maxlength="50">
                        <input type="text" required class="form-control form-white" name="data[User][username]" placeholder="Username" maxlength="50">
                        <input type="password" required class="form-control form-white" name="data[User][password]" placeholder="Password"  id="password1" maxlength="50">
                        <input type="password" class="form-control form-white" placeholder="Confirm password"  id="password2" maxlength="50" required name="data[User][cpassword]">
                        <input type="hidden" class="form-control form-white" name="data[User][role]" value="customer">
                        <!--<input type="hidden" class="form-control form-white" name="data[User][name]" value="gurpreet Singh">-->
                        <input type="hidden" class="form-control form-white" name="data[User][active]" value="1">
                        <!--<input type="hidden" class="form-control form-white" name="data[User][password]" value="customer">-->
                        <input type="hidden" name="data[User][server]" value="<?php echo $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']; ?>">
                        <div id="pass-info" class="clearfix"></div>
                        <div class="checkbox-holder text-left">
                            <div class="checkbox checkbox1">
                                <input  type="checkbox" value="accept_2" id="check_2" name="check_2" required />
                                <label class="checkwale" for="check_2"><span>I Agree to the <strong>Terms &amp; Conditions</strong></span></label>
                            </div>
                        </div>
                        <button class="btnwale" type="submit" class="btn btn-submit">Register</button>
                    </form>
                </div>
            </div>
        </div><!-- End review modal --> 
       
       
       
       
  
       
       
       
        
        <script type="text/javascript">	   

		//  $('.close-link').click(function(){
		 // $(".modal-popup ").fadeOut(300)
		  //alert('aaaaaaaaa');
		//	});	


 $.getJSON('https://www.readytodropin.com/api/shop/webtime', function (d) {
        html = '';
        html += '<option value="" selected>Select date</option>';
        $.each(d.day, function (index, value) {
            html += '<option value="' + value + '">' + value + '</option>';

        });
        $('#delivery_schedule_day').html(html);
        console.log(html);
    });

    var date = '27';
    $('#delivery_schedule_day').off("change").on('change', function () {
        var a = $(this).val();
        var d=a.split('-');
        // alert(a);
        if (date == d[0]) {

            $.post('https://www.readytodropin.com/api/shop/webtime', {id: "1"}, function (data) {
                var daa = JSON.parse(data);
                htmlac = '';
                htmlac += '<option value="" selected>Select Time</option>';
                $.each(daa.time, function (i, v) {
                    htmlac += '<option value="' + v + '">' + v + '</option>';

                });

                $('#delivery_schedule_time').html(htmlac);

            });
        } else if (a == '') {
            htmlc = '';
            htmlc += '<option value="" selected>Select Time</option>';
            $('#delivery_schedule_time').html(htmlc);
        } else {
            $.getJSON('https://www.readytodropin.com/api/shop/webtime', function (da) {
                htmlb = '';
                htmlb += '<option value="" selected>Select Time</option>';
                $.each(da.time, function (index, value) {
                    htmlb += '<option value="' + value + '">' + value + '</option>';

                });
                console.log(htmlb);
                $('#delivery_schedule_time').html(htmlb);

            });
        }


    });	
	</script> 
 
  
</body>
</html>