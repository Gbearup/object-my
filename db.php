<?php

 class DB{
   protected $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
   protected $pdo;
   protected $table;
   
   function __construct($table){
    $this->table=$table;
    $this->pdo=new PDO($this->dsn,'root','');
   }  
   
 /**
  * 撈出全部的資料
  * 1.整張資料表
  * 2.有條件
  * 3.其他SQL功能
  */
    function all(...$arg){
        $sql="SELECT * FROM $this->table ";
            if(!empty($arg[0])){
                if(is_array($arg[0])){
                    $where=$this->a2s($arg[0]);
                    $sql=$sql . " WHERE ". join(" && ",$where);
                }else{
                //$sql=$sql.$arg[0];
                    $sql .= $arg[0];
                }
            }
            if(!empty($arg[1])){
                $sql=$sql . $arg[1];
            }
        return $this->fetchAll($sql);
    }
        // return $this->q("SELECT * FROM $this->table");


/**
 * 找到唯一資料 用id 
 */
    function find($id){
        $sql="SELECT * FROM $this->table ";
    
        if(is_array($id)){
            $where=$this->a2s($id);
            $sql=$sql . " WHERE ". join(" && ",$where);
        }else{
             $sql .= " WHERE `id`='$id' ";
        }
        return $this->fetchOne($sql);
    }

/**
 * 刪除功能
 */
function del($id){
    $sql="DELETE FROM $this->table ";

    if(is_array($id)){
        $where=$this->a2s($id);
        $sql=$sql . " WHERE ". join(" && ",$where);
    }else{
        $sql .= " WHERE `id`='$id' ";
    }

    echo $sql;  
    return $this->pdo->exec($sql);
} 

/**
 * 新增跟編輯的功能 在資料量不多時可以用，因為一次只能做一筆
 */

 function save($array){

    if(isset($array['id'])){
        //update
        //update table set `欄位1`='值1',`欄位2`='值2' where `id`='值' 
        $id=$array['id'];
        unset($array['id']);
        $set=$this->a2s($array);
        $sql ="UPDATE $this->table SET ".join(',',$set)." where `id`='$id'";
            
    }else{
        //insert
        $cols=array_keys($array);
        $sql="INSERT INTO $this->table (`".join("`,`",$cols)."`) VALUES('".join("','",$array)."')";
    }
    
    echo $sql;
    return $this->pdo->exec($sql);
}

 


/**把陣列轉成條件字串陣列 array to string :a2s
 */

function a2s($array){
    $tem=[];
    foreach($array as $key => $value){
        $tmp[]="`$key`='$value'";
     }
    return $tmp;
}

function fetchOne($sql){
    // echo $sql;
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
}

function fetchAll($sql){
    // echo $sql;
    return $this->pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
}

}
 
// function q($sql){
//     return $this->pdo->query($sql)->fetchAll();
// }

function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}


$DEPT=new DB('dept');

// $dept=$DEPT->q("SELECT * FROM dept");
// $dept=$DEPT->all(['id'=>3]);
// $dept=$DEPT->all("where id>3");

$dept=$DEPT->find(['code'=>'404']);
// $DEPT->del(['code'=>'504']);
// 有id的時候就是編輯，要新增的話不可以有id~~oh my god~~~~
$DEPT->save(['code'=>'504','id'=>'7','name'=>'資訊部']);
dd($dept);

?>

