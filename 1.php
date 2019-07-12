<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

/*
1. Дан массив "категории". Каждая категория имеет следующие параметры:
"id" — уникальный числовой идентификатор категорий
"title" — название категории
"children" - дочерние категории (массив из категорий)

Вложенность категории неограниченна
(дочерние категории могу иметь свои вложенные категории и т.д.)
*/

function searchCategory($categories, $id){

  foreach ($categories as $value) {

    if (isset($value['id']) and $value['id'] == $id){
        return $value;
    }

    if (isset($value['children'])) {

        $searchRes = searchCategory($value['children'],$id);

        if ($searchRes != false) {
            return $searchRes;
        }
    }
  }
  return false;
}





$categories = array(
	array(
   	"id" => 1,
   	"title" =>  "Обувь",
   	'children' => array(
       	array(
           	'id' => 2,
           	'title' => 'Ботинки',
           	'children' => array(
               	array('id' => 3, 'title' => 'Кожа'),
               	array('id' => 4, 'title' => 'Текстиль'),
           	),
       	),
       	array('id' => 5, 'title' => 'Кроссовки',),
   	)
	),
	array(
   	"id" => 6,
   	"title" =>  "Спорт",
   	'children' => array(
       	array(
           	'id' => 7,
           	'title' => 'Мячи'
       	)
   	)
	),
);



$searchResult = searchCategory($categories, 3);


if ($searchResult != false){
  echo $searchResult['id'].' : '.$searchResult['title'];
} else {
  echo "Категория отсутствует";
}


?>
