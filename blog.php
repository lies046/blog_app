<?php
require_once('dbc.php');

Class Blog extends Dbc
{
  protected $table_name = 'blog';
  //3.カテゴリー名を表示
  //引数：数字
  //返り値：カテゴリーの文字列
  public function setCategoryName($category){
    if($category === '1'){
      return '日常';
    }elseif($category === '2'){
      return 'プログラミング';
    }else{
      return 'その他';
    }
  }

  public function blogCreate($blogs){
    $sql = 'INSERT INTO 
          blog(title, content, category, publish_status)
        VALUES
          (:title, :content, :category, :publish_status)';
    $dbh=$this->dbConection();
    $dbh->beginTransaction();
    try{
      $stmt=$dbh->prepare($sql);
      $stmt->bindValue(':title',$blogs['title'], PDO::PARAM_STR);
      $stmt->bindValue(':content',$blogs['content'], PDO::PARAM_STR);
      $stmt->bindValue(':category',$blogs['category'], PDO::PARAM_INT);
      $stmt->bindValue(':publish_status',$blogs['publish_status'], PDO::PARAM_INT);
      $stmt->execute();
      $dbh->commit();
      echo 'ブログを投稿しました。';
    }catch(PDOException $e){
      exit($e);
      $dbh->rollBack();
      exit($e);
    }
  }
}