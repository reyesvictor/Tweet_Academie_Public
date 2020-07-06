<?php
spl_autoload_register('autoLoad');

// function autoLoad($class) { 
//   $newArray = scandir('../../classes/');
//   // var_dump($newArray);
//   foreach($newArray as $value)
//   {
//     $array[] = scandir("../../classes/$value");
//   }
//   for ($i=0; $i < count($array); $i++) { 
//       $j = 0;
//       while ($j !== count($array[$i]))
//       {
//         $classPath = "../../classes/".$array[$i][$j]."/$class.class.php";
//         if (file_exists($classPath)) {
//           include $classPath;
//       }
//        $j++;
//       }
//   }
// }
// function getDirContents($dir, &$results = array()) {
//   $files = scandir($dir);

//   foreach ($files as $key => $value) {
//       $path = $dir . DIRECTORY_SEPARATOR . $value; //realpath
//       if (!is_dir($path)) {
//           $results[] = $path;
//       } else if ($value != "." && $value != "..") {
//           getDirContents($path, $results);
//           $results[] = $path;
//       }
//   }
//   return $results;
// }

function autoLoad($class) { 
  $array = [
    '../../classes/controller/',
    '../../classes/model/', 
    '../../classes/database/', 
    '../../classes/validator/', 
    '../../classes/validator/settings/', 
    '../../classes/validator/tweet/',
    '../../classes/chat/',
    'php/classes/controller/',
    'php/classes/model/', 
    'php/classes/database/', 
    'php/classes/validator/', 
    'php/classes/validator/settings/', 
    'php/classes/validator/tweet/', 
    'php/classes/validator/chat/'
  ];

  for ($i=0; $i < count($array); $i++) { 
    $classPath = "{$array[$i]}{$class}.class.php";
    if ( file_exists($classPath) ) {
      include $classPath;
    }
  }
}
?>