<?php

require_once('env.php');
Class Dbc
{

  protected $table_name;

  //1.DB接続
  //引数:なし
  //返り値:接続結果を返す
  protected function dbConection(){

    $host=DB_HOST;
    $dbname=DB_NAME;
    $user = DB_USER;
    $pass = DB_PASS;
    $dns="mysql:host=$host;dbname=$dbname;charset=utf8;";

    try{
      $dbh= new PDO($dns, $user, $pass,[
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      ]);
      
      }catch(PDOException $e){
        echo '接続失敗'.$e->getMessage();
        exit();
      };
      return $dbh;
  }

  //2.データを取得する
  //引数：なし
  //返り値:取得したデータ
  public function getAll(){
    $dbh=$this->dbConection();
    // SQLの準備
    $sql = "SELECT * FROM $this->table_name";
    // SQLの実行
    $stmt = $dbh->query($sql);
    //SQLの結果を受け取る
    $result = $stmt->fetchall(PDO::FETCH_ASSOC);
    return $result;
    $dbh = null;
  }


  //引数：id
  //返り値:$result
  public function getById($id){
    if(empty($id)){
      exit('IDが不正です');
    }
    
    $dbh = $this->dbConection();
    
    //SQLを準備 プレースホルダー
    $stmt = $dbh->prepare("SELECT * FROM $this->table_name WHERE id = :id");
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
    
    //SQLの実行
    $stmt->execute();
    
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if(!$result){
      exit('ブログがありません');
    }

    return $result;
  }
}
?>