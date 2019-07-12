<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
/*
Написать функцию, которая на входе принимает массив из открывающихся
или закрывающихся тегов  (например “<a>”, “</td>” ),
а возвращает результат проверки корректности:  т.е. является ли
принятая функцией последовательность тегов структурой корректного HTML
документа. Например, последовательность “<a>”, “<div>”,
“</div>”, “</a>”, “<span>”, “</span>” - корректная структура,
а последовательность “<a>”, “<div>”, ”</a>” - некорректная структура.
*/

$correctHtml = array('<html>','<head>','</head>','<body>',
  '<div>','<p>','<a>','</a>','</p>','<p>','</p>','</div>','</body>','</html>');

$incorrectHtml = array('<html>','<head>','</head>','<body>',
  '<div>','</a>','<p>','<a>','</p>','</div>','</body>','</html>');


function checkHtml($html){
  $stack = array();
  $chars = ['/','<','>',' '];

  foreach ($html as $val) {
    if (strpos($val, "/") == false){

      $val = str_replace($chars, '', $val);
      array_push($stack, $val);

    } else {

      $val = str_replace($chars, '', $val);
      if ($val != array_pop($stack)) return false;
    }
  }

  if (count($stack) != 0) return false;

  return true;
}

var_dump(checkHtml($correctHtml));

?>
