
<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon"/>
 
  <title>Araç Takip v1.0</title>
 
 
		<link rel="stylesheet" href="https://d3rh8btizouuof.cloudfront.net/css/cssPmk?v=205">
	<!-- Google Tag Manager -->
	
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script src="https://d3rh8btizouuof.cloudfront.net/js/bootstrap.min.js"></script>
 
	<script src="https://d3rh8btizouuof.cloudfront.net/js/select.min.js"></script>
 
 
	
</head>
<body>
	 
		<div class="page-loader"  >
		<div class="loader-pages"></div>
		<div class="loader-text"><img src="https://d3rh8btizouuof.cloudfront.net/images/loading.svg" alt=""></div>
	</div>
 
 
<div class="bilet-left-box">
  
  <div class="bilet-left-box-footer"></div>
</div><style>
.navbarafter{
		height:auto;
	}
@media(max-width: 991px){
	.navbarafter{
		height:50px;
	}
}
</style>
 
<div id="navbarafter" class="navbarafter">

<!-- Modal -->
  <div class="modal zindex10000 fade" id="myModal" role="dialog">
 
</div>
  <!-- Modal -->
  
   <!-- Modal -->
   <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
<div class="container mt10 pagebord mb20" style="overflow:hidden;">
    <div class="row">
      <div class="col-md-12 col-sm-12">
			<h1 class="h1pmk">Yolcum Nerede?</h1>
			<p>
						"Yolcum Nerede" uygulamamız sayesinde yolcunuzun seyahat halindeyken nerede olduğunu öğrenebilirsiniz. 
		
						</p>
						<div class="row">
			 
				 
				<div class="col-md-4">
					<div class="form-group">
						<label class="control-label">Araç Plakası</label>
						<select class="select-box2 widthyuz" id="plaka-list" name="plaka">
						<option value="-1">SEÇİNİZ</option>
					 
						 <!-- plakalar burada yer alıyor -->

						</select>
					</div>
				</div>
			</div>
						<div class="row">
				<div class="col-md-12">
					<div id="mapid" class="mb10" style="width: 100%; height: 550px;"></div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					Bu sayfa demo sayfasıdır. Bilgiler doğrudur.
				</div>
			</div>
			
      </div>
	  <div class="col-md-4">
            
      </div>
      
    </div>
  </div>
  
   
				<footer class="pmk-footer hidden-xs hidden-sm hidden-md hidden-lg hidden-xl">
			<div class="container">
		<div class="row">
		 
 
		 
		 
			 
		</div>
	</div>
	<section class="copyright">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
								<p style="font-size:12px; text-align:center;"><i class="fa fa-copyright" aria-hidden="true"></i> 2021 CK</p>
				</div>
			</div>
		</div>
	</section>
</footer>

<!--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDphTPHJ6cy1MEsHe2Dz_-c8vOEMgdukrM"></script>-->
<!--<script src="https://api-maps.yandex.ru/2.1/?lang=en_US"></script>-->
 
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->
 

 
 </body>
</html><script src="https://d3rh8btizouuof.cloudfront.net/js/leaflet.js"></script>
<script type="text/javascript">
	var greenIcon = L.icon({
		iconUrl: 'img/car-icon.png',	
		iconSize:     [50, 50], // size of the icon
		shadowSize:   [50, 64], // size of the shadow
		iconAnchor:   [17, 40], // point of the icon which will correspond to marker's location
		shadowAnchor: [4, 62],  // the same for the shadow
		popupAnchor:  [-3, -40] // point from which the popup should open relative to the iconAnchor
	});
	
	var mymap = L.map('mapid',{ attributionControl:false }).setView([39.159349, 35.430908], 6);
	L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
	maxZoom: 18,
	attribution: '&copy; <a href=""></a> tarafından sunulmaktadır',
	id: 'mapbox/streets-v11'
	}).addTo(mymap);
	
	var theMarker = {};
	function harita2(jsonValues){
		var obj = jQuery.parseJSON(jsonValues);
		 
		mymap.removeLayer(theMarker);
		theMarker = L.marker([obj.enlem,obj.boylam],{icon: greenIcon}).bindPopup("<b>Plaka :</b> "+obj.plaka+"<br><b>Hız :</b> "+obj.hiz+"<br><b>Konum :</b>"+obj.adres+"<br><b>Son Güncelleme Zamanı :</b>"+obj.tarih, {Width: "200px"}).addTo(mymap);
		theMarker.openPopup();
		mymap.setView(new L.LatLng(obj.enlem, obj.boylam), 13);
		//theMarker.setLatLng([obj.Latitude,obj.Longtitude]).update();
	}
	function haritaGuncelle(jsonValues){
		var obj = jQuery.parseJSON(jsonValues.toString());
		 
		mymap.removeLayer(theMarker);
		theMarker = L.marker([obj.enlem,obj.boylam],{icon: greenIcon}).bindPopup("<b>Plaka :</b> "+obj.plaka+"<br><b>Hız :</b> "+obj.hiz+"<br><b>Konum :</b>"+obj.adres+"<br><b>Son Güncelleme Zamanı :</b>"+obj.tarih, {Width: "200px"}).addTo(mymap);
		theMarker.openPopup();
		mymap.setView(new L.LatLng(obj.enlem, obj.boylam), 13);
	}

	function tumAraclariGoster(jsonValues){
		 
	}
</script>
<script type="text/javascript">
 
      $('.select-box2').select2();
      
	//   $.get("ajax.php?type=carList", function(data) {
	//     $("#plaka-list").html("<option value='-1'>Seçiniz</option>"+data);
	 
	//   });

$(document).ready(function(){
	$("#plaka-list").on("change",function(){
		$.get("ajax.php?type=getCarLocation&plaka="+$(this).val(), function(data){
			harita2(data);
			 
	    });
	});
	 
		setInterval(function(){ 
		if($("#plaka-list").val() != '-1' && $("#plaka-list").val() !== null){
			$.get("ajax.php?type=getCarLocation&plaka="+$("#plaka-list").val(), function(data){
				haritaGuncelle(data);
			});
		}
	}, 60000);
	});
</script>