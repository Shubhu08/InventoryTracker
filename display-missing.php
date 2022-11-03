<?php 
  require("invent-details.php");
  $count = countnum("MIS"); 
  $id = getmissingid();
  $i=0;
  foreach ($id as $res)          
  {    
   echo 
    " <div class='row'>
        <div class='col-md-2' id='logo1'>
        </div>
      
        <div class='col-md-8 inventory-disp'>
          <div class='row'>
            <div class='col-md-4'>
              <h4>ID : ".$res['tid']."</h4>
            </div>
            <div class='col-md-4'>
              <h4 id='in".$i."'>IN : ".$res['instate']."</h4>
            </div>
            <div class='col-md-4'>
              <button onclick='myMap(".$res['tid'].")' class='btn btn-block'>
                Show on map
              </button>
            </div>
          </div>
          <div class='row'>
            <div class='col-md-12'>
              <div id='googleMap".$res['tid']."' ></div>
            </div>
          </div>
        </div>
        <div class='col-md-2'>
        </div>
      </div>";
      $i++;
  }     
  
  echo "";
?>