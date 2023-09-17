<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
<script type="text/javascript">
                                          $.ajax({ //create an ajax request to load_page.php
                                              type: "GET",
                                              url: "http://assmartfarm.cs.ubru.ac.th/water_project/insert_data.php?level_water=99&amount_water=88&land_visibility_tmd=1&rainfall_tmd=1&temp_tmd=1&humidity_tmd=1&wind_tmd=1&MeanSeaLevelPressure_tmd=1",  //ส่งตัวแปร,
                                              dataType: "html", //expect html to be returned
                                              success: function (response) {
                                                  $("#show1").html(response);
                                              }
                                          });

</script> -->
<?php
    // header("Location: insert_data.php?level_water=99&amount_water=88&land_visibility_tmd=1&rainfall_tmd=1&temp_tmd=1&humidity_tmd=1&wind_tmd=1&MeanSeaLevelPressure_tmd=1");
?>
<iframe src="http://assmartfarm.cs.ubru.ac.th/water_project/insert_data.php?level_water=99&amount_water=88&land_visibility_tmd=1&rainfall_tmd=1&temp_tmd=1&humidity_tmd=1&wind_tmd=1&MeanSeaLevelPressure_tmd=1" height="200" width="300" title="Iframe Example"></iframe>
