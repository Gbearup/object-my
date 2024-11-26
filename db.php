<?php
// class DB：這是定義了一個名為 DB 的類別，通常這個類別用來處理資料庫操作。
// $dsn：這是一個 PHP Data Object（PDO）所需要的資料庫連線字串，用來描述如何連接到 MySQL 資料庫。
// $pdo：這個屬性將儲存 PDO 物件，它是 PHP 內建的資料庫存取類別，用來進行資料庫的查詢與操作。
// $table：這個屬性用來儲存資料表名稱，這樣可以讓我們在執行查詢時，靈活地使用不同的資料表。

// 這是建構子（__construct），當創建 DB 類別的物件時會被自動呼叫。
// $table 是傳遞給建構子的參數，這個參數用來設定 DB 類別要操作的資料表名稱。
// $this->pdo = new PDO($this->dsn, 'root', '');：這行程式碼建立一個 PDO 物件，並用來連接到 MySQL 資料庫。這裡使用預設的 MySQL 使用者 root 和空密碼。

// q($sql) 是用來執行 SQL 查詢的方法。
// $sql 是傳入的 SQL 查詢語句。
// $this->pdo->query($sql)：這部分執行傳入的 SQL 查詢。
// fetchAll()：該方法會返回查詢結果的所有行（結果集），並以數組的形式返回。
// 這個方法的返回值是查詢結果的多維陣列，其中每個元素代表查詢的其中一筆資料。


// dd($array) 是一個簡單的輔助函式，會以格式化的方式輸出陣列。
// print_r($array)：這是 PHP 的內建函式，會打印出變數的詳細結構，特別適合用來查看陣列或物件。
// echo "<pre>" 和 echo "</pre>"：用來包裹 print_r 輸出的內容，使其在瀏覽器上以更清晰、易讀的方式顯示（這是一種格式化輸出的技巧）。

// $DEPT = new DB('dept');：這行代碼創建了一個 DB 類別的實例，並傳遞 'dept' 作為資料表名稱。這樣，$DEPT 就會是一個針對 dept 資料表的資料庫操作物件。
// $dept = $DEPT->q("SELECT * FROM dept");：這行代碼呼叫 DB 類別的 q 方法，執行 SELECT * FROM dept 查詢，將查詢結果（即 dept 資料表的所有資料）儲存在 $dept 變數中。
// dd($dept);：這行代碼將查詢結果 $dept 輸出到頁面上，顯示 dept 資料表的內容。


// 總結，這段程式碼的作用是：
// 定義了一個 DB 類別，用來建立資料庫連線，並執行 SQL 查詢。
// 創建了一個 DB 類別的實例，並指定要操作的資料表（dept）。
// 執行 SELECT * FROM dept 查詢，取得 dept 資料表的所有資料。
// 使用 dd 函式將查詢結果格式化並顯示在瀏覽器中。



 class DB{
   protected $dsn="mysql:host=localhost;charset=utf8;dbname=db01";
   protected $pdo;
   protected $table;
   
   function __construct($table){
    $this->table=$table;
    $this->pdo=new PDO($this->dsn,'root','');
   }  
 
function all(){
    return $this->q("SELECT * FROM $this->table");
}

function q($sql){
    return $this->pdo->query($sql)->fetchAll();
}

}


function dd($array){
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

$DEPT=new DB('dept');

// $dept=$DEPT->q("SELECT * FROM dept");
$dept=$DEPT->all();

dd($dept);

