<?php
//関数一つに一つの機能のみ持たせる

//1.DB接続
//引数:なし
//返り値:接続結果を返す
function dbConection(){
    
  $dns='mysql:host=localhost;dbname=blog_app;charset=utf8;';
  $user = 'root';
  $pass = '';
  
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
function getAllBlog(){
  $dbh=dbConection();
  // SQLの準備
  $sql = 'SELECT * FROM blog';
  // SQLの実行
  $stmt = $dbh->query($sql);
  //SQLの結果を受け取る
  $result = $stmt->fetchall(PDO::FETCH_ASSOC);
  return $result;
  $dbh = null;
}

//3.カテゴリー名を表示
//引数：数字
//返り値：カテゴリーの文字列
function setCategoryName($category){
  if($category === '1'){
    return '日常';
  }elseif($category === '2'){
    return 'プログラミング';
  }else{
    return 'その他';
  }
}

//引数：id
//返り値:$result
function getBlog($id){
  if(empty($id)){
    exit('IDが不正です');
  }
  
  $dbh = dbConection();
  
  //SQLを準備 プレースホルダー
  $stmt = $dbh->prepare('SELECT * FROM blog WHERE id = :id');
  $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);
  
  //SQLの実行
  $stmt->execute();
  
  $result = $stmt->fetch(PDO::FETCH_ASSOC);
  
  if(!$result){
    exit('ブログがありません');
  }

  return $result;
}
?>