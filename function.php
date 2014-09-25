<?php

function crea_geojson_tree_progetto ($progetto){


//crea JSON
$myFile = "../experiment_host/supply/geojson/poi_tree_".$progetto.".geojson";
$fh = fopen($myFile, 'w') or die("can't open file");

$stringData = '{
"type": "FeatureCollection",
"crs": { "type": "name", "properties": { "name": "urn:ogc:def:crs:OGC:1.3:CRS84" } },
                                                                                
"features": [
';

//$stringData = '{ "features" : [ ';
fwrite($fh, $stringData);

// The Query to show a specific Custom Field
$the_query = new WP_Query( array( 'meta_key' => 'progetto', 'meta_value' => $progetto,'posts_per_page' => -1,'post_status' => 'publish' ) );

// The Loop
while ( $the_query->have_posts() ) : $the_query->the_post();


// TITOLO
$title=get_the_title();
$plink=get_permalink();


$autore_nome = get_field('autore_nome');
$url_image=get_field('picture1');
$url_image='http://www.cityplanner.it/experiment_host/supply/photo/parco_castello_resize/'.$url_image;
$url_image2=get_field('picture2');
$url_image2='http://www.cityplanner.it/experiment_host/supply/photo/parco_castello_resize/'.$url_image2;
$url_image3=get_field('picture3');
$url_image3='http://www.cityplanner.it/experiment_host/supply/photo/parco_castello_resize/'.$url_image3;
$url_image4=get_field('picture4');
$url_image4='http://www.cityplanner.it/experiment_host/supply/photo/parco_castello_resize/'.$url_image4;
$location = get_field('map'); // MANCA l'ID !!!
if( !empty($location) ):
$lat= $location['lat'];
$lng=$location['lng']; 
endif; // lat lng


$url="<a href='".$plink."'>".$title."</a><br><img src='".$url_image."' style='width:150px;height:auto;'>";

$iconurl='http://www.cityplanner.it/supply/icon_web/set6_mapicon/arbol.png';

/*
$stringData = ' { "geometry" : { "coordinates" : ['.$lng.',
            '.$lat.' 
              ],
            "type" : "Point"
          },
        "properties" : { "Colour" : "#ffffff", "picture":"'.$url_image.'","ADRESS1":"","ADRESS2":"none","TEL":"'.$autore_nome.'","URL":"'.$plink.'","NAME":"'.$title.'","titolo":"'.$title.'","url_post":"'.$plink.'",
            "ImageURL" : "'.$iconurl.'"
          },
        "type" : "Feature"
      },
';
*/
$stringData = '{ "type": "Feature", "properties": { "Colour": "#ffffff", "picture": "'.$url_image.'",  "picture2": "'.$url_image2.'", "picture3": "'.$url_image3.'", "picture4": "'.$url_image4.'","ADRESS1": null, "ADRESS2": null, "TEL": null, "URL": null, "NAME": "'.$title.'", "titolo": "'.$title.'", "url_post": "'.$plink.'", "ImageURL": "http:\/\/www.cityplanner.it\/supply\/icon_web\/set6_mapicon\/arbol.png" }, "geometry": { "type": "Point", "coordinates": [ '.$lng.', '.$lat.' ] } },
';
fwrite($fh, $stringData);



endwhile;
// Reset Post Data
wp_reset_postdata();

/*
$stringData = '
  { "geometry" : { "coordinates" : [ -1.4948717600000001,
                53.68926664
              ],
            "type" : "Point"
          },
        "properties" : { "Colour" : "#ffffff",
            "ImageURL" : "/360Scheduling/Content/Images/ByBox.png"
          },
        "type" : "Feature"
      }
    ],
  "type" : "FeatureCollection"
}';
*/
$stringData = '
{ "type": "Feature", "properties": 
  { "Colour": "#ffffff", "picture": "http:\/\/www.cityplanner.it\/experiment_host\/supply\/photo\/legnano_bw\/vista_00015_jpg.jpeg", 
  "ADRESS1": null, "ADRESS2": null, "TEL": null, "URL": null, "NAME": "vista_00015_jpg.jpeg", 
  "titolo": "vista_00015_jpg.jpeg", "url_post": null, "ImageURL": "http:\/\/www.cityplanner.it\/supply\/icon_web\/set6_mapicon\/arbol.png" }, 
  "geometry": { "type": "Point", "coordinates": [ 8.920115, 45.583588 ] } }
]
}
';
fwrite($fh, $stringData);

 

}
