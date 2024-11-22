<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>物件導向</title>
</head>
<body>
<h1>物件的宣告</h1>
<?php

class Animal{
protected $type='animal';
protected $name='John';
protected $hair_color='black';
protected $feet=['front-left','front-right','back-left','back-right'];

function _construct($type,$name,$hair_color){
$this->type=$type;
$this->name=$name;
$this->hair_color=$hair_color;
}


function run(){
echo $this->name.' is running';
}

function speed(){
    echo $this->name.' is running at 20km/h';
}

// 如果我要執行這個getname的話請把這個name丟出來  function本身就是一個變數
public function getName(){
    return $this->name;
}

public function setName($name){
    return $this->name=$name;
}



}

// 實例化(instance) 遊戲裡面的副本也叫instance，本身有複製的意思
$cat=new Animal('cat','kitty','white');

// 這邊的type不需要用$ 物件的宣告跟使用
// echo $cat->type;
// echo $cat->name;
echo $cat->getName();
// echo $cat->hair_color;
echo $cat->run();
echo $cat->speed();
// print_r($cat->feet);

// $cat->name='Joson';
// echo $cat->getName();


// 為了怕被人隨便亂改，所以上面都會用protect，用了protect,就要用setname的方式才可以呼喚出來
$cat->setName('Mary');
echo $cat->getName();





























?>
</body>
</html>