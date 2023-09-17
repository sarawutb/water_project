<script>
  $(document).ready(function(){
  var dataget;
        $.ajax({
 // url: 'getxml.php',
 url: 'getxml.php',
 data: {
    format: 'json'
 },
 error: function() {
    alert("ไม่สามารถดึงข้อมูลได้");
 },
 dataType: 'json',
 success: function(data) {


  // console.log(data.Stations[0]);

 dataget = data.Stations;

// 	 var obj = [
//   {"name": "Afghanistan", "code": "AF"},
//   {"name": "Åland Islands", "code": "AX"},
//   {"name": "Albania", "code": "AL"},
//   {"name": "Algeria", "code": "DZ"}
// ];

var WmoNumber = '48408';
var indexselect;
for (var i = 0; i < dataget.length; i++){
if (dataget[i].WmoNumber == WmoNumber){
  indexselect = i;
}
}
              var newhtml = '';
              newhtml += '<p>สถานนีรายงานอากาศ : '+dataget[indexselect]['StationNameTh']+'</p>';
              newhtml += '<p>จังหวัด : '+dataget[indexselect]['Province']+'</p>';
              newhtml += '<p>ละติจดู (N)  : '+dataget[indexselect]['Latitude'].Value+'</p>';
              newhtml += '<p>ลองติจูด(E)  : '+dataget[indexselect]['Longitude'].Value+'</p>';
              newhtml += '<p>วันที่ตรวจวัด  : '+dataget[indexselect]['Observe'].Time+'</p>';
              newhtml += '<p>อุณหภูมอากาศปัจจุบัน(องศาเซลซียส)  : '+dataget[indexselect]['Observe']['Temperature'].Value+'</p>';
              newhtml += '<p>ความชื้อในอากาศ   : '+dataget[indexselect]['Observe']['RelativeHumidity'].Value+'</p>';
              newhtml += '<p>แรงลม   : '+dataget[indexselect]['Observe']['WindSpeed'].Value+'</p>';
              newhtml += '<p> ค่าเฉลี่ยความชื้นสัมพทธั ์(เปอร์เซ็นต์)    : '+dataget[indexselect]['Observe']['RelativeHumidity'].Value+'</p>';
              newhtml += '<p> ปริมาณน้ำฝน(มิลลิเมตร)    : '+dataget[indexselect]['Observe']['Rainfall'].Value+'</p>';
              newhtml += '<p> ทัศนวิสัย(กิโลเมตร)    : '+dataget[indexselect]['Observe']['LandVisibility'].Value+'</p>';

              $("#show").html(newhtml);

              $(document).ready(function () {
                var Rainfall = dataget[indexselect]['Observe']['Rainfall'].Value;
                var Temperature = dataget[indexselect]['Observe']['Temperature'].Value;
                var RelativeHumidity = dataget[indexselect]['Observe']['RelativeHumidity'].Value;
                var WindSpeed = dataget[indexselect]['Observe']['WindSpeed'].Value;
                var MeanSeaLevelPressure = dataget[indexselect]['Observe']['MeanSeaLevelPressure'].Value;
                var LandVisibility = dataget[indexselect]['Observe']['LandVisibility'].Value;
                var level_water = <?=$val1;?>;
                var amount_water = <?=$val2;?>;
                                      ajax_call = function() {
                                          $.ajax({ //create an ajax request to load_page.php
                                              type: "GET",
                                              url: "insert_data.php?level_water="+level_water+"&amount_water="+amount_water+"&land_visibility_tmd="+LandVisibility+"&rainfall_tmd="+Rainfall+"&temp_tmd="+Temperature+"&humidity_tmd="+RelativeHumidity+"&wind_tmd="+WindSpeed+"&MeanSeaLevelPressure_tmd="+MeanSeaLevelPressure,  //ส่งตัวแปร,
                                              dataType: "html", //expect html to be returned
                                              success: function (response) {
                                                  $("#show1").html(response);
                                              }
                                          });
                                      };
                                      var interval = 1000;
                                      setInterval(ajax_call, interval);
                                  });


  // $.ajax({
  //     url: "insert_data.php?", //เรียกใช้งานไฟล์นี้
  //     data: "level_water="+level_water+"&amount_water="+amount_water+"&rainfall_tmd="+Rainfall+"&temp_tmd="+Temperature+"&humidity_tmd="+RelativeHumidity+"&wind_tmd="+WindSpeed+"&MeanSeaLevelPressure_tmd="+MeanSeaLevelPressure,  //ส่งตัวแปร
  //     type: "GET",
  //     async:false,
  //     success: function(data, status) {
  //     $("#show_subject_std").html(data);
  //     },
  //  });
   $.each(data.Stations,function(i){

});

 },
 type: 'GET'
  });
 });


 // $(document).ready(function () {
 //                         ajax_call = function() {
                             $.ajax({ //create an ajax request to load_page.php
                                 type: "GET",
                                 url: "save_data_water_ubon.php?",
                                 dataType: "html", //expect html to be returned
                                 success: function (response) {
                                     $("#show2").html(response);
                                 }
                             });
                     //     };
                     //     var interval = 1000;
                     //     setInterval(ajax_call, interval);
                     // });
</script>
