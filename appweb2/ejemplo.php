<html>
   <body>
      
      <?php
         $notas= array( 
            "ana" => array (
               "fisica" => 5,
               "matematicas" => 6,	
               "quimica" => 9
            ),
            
            "gadir" => array (
               "fisica" => 7,
               "matematicas" => 6,
               "quimica" => 4
            ),
            
            "zapata" => array (
               "fisica" => 6,
               "matematicas" => 8,
               "quimica" => 8
            )
         );
         
         /* Acceso a los valores de un array multidimensión */
         echo "La nota de Ana en física es: " ;
         echo $notas['ana']['fisica'] . "<br />"; 
         
         echo "La nota de Gadir en matematicas es : ";
         echo $notas['gadir']['matematicas'] . "<br />"; 
         
         echo "La nota de Zapata en quimica es : " ;
         echo $notas['zapata']['quimica'] . "<br />"; 
      ?>
   
   </body>
</html>