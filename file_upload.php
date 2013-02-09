<?php              

class FileManager
{
    // プロパティの宣言
    public $var = 'a default value';

    // メソッドの宣言
    public function displayVar() {
        echo $this->var;
    }
    public static $ERROR = 0;
    public static $SUCCESS = 1;
    
    //扱うファイルの拡張子
    public $extension;
    
    //ファイルが存在しない場合は，作成する。
    function makefile($file_name){
		
  		// ファイルの存在確認
  		if( !file_exists($file_name) ){
   			// ファイル作成
    		touch( $file_name );
    		return $SUCCESS;
  		}else
  			return $ERROR;
    }
    	
  // ファイルのパーティションの変更
  // chmod( $file_name, 0666 );
  // echo('Info - ファイル作成完了。 file name:['.$file_name.']');


  // return number_format($totalNum)."円<br>";
    
    
    
    //ディレクトリー内のファイルの一覧を取得
    function getList($res_dir){
    
		$count = 0;
		//ディレクトリ・ハンドルをオープン
		$res_dir = opendir( './files/' );
    	while ( $file_name = readdir( $res_dir) ) {
    		$pos = strripos($file_name, '.dat');
			//取得したファイル名を表示
			if($pos){
				if(!count($_FILES))print "\n{$file_name}";
				$count++;
			}
		}
		//ディレクトリ・ハンドルをクローズ
		closedir( $res_dir );
	}
	
	private function makelist($file_name){
		
		$list_file_name = 'userlist.txt';
		//ファイル作成
		
		 $this->makefile($list_file_name);
		 //ファイルへ追記
		 $fp = fopen($list_file_name, "a");
		 fwrite($fp, $file_name.'
'); 
		fclose($fp);
	}
	
	public function savefile($file_name){

		if(count($_FILES)<1)
			return;
		$target_path = "files/";

		//$file_name =  'Points.' . $count . '-' . $_POST['username'] . '-' . $_POST['uploaddate'] . '.dat';

		$target_path = $target_path . $file_name;//basename( $_FILES['uploadedfile']['name']);

		$pos = false;
		
		$this->makelist($file_name);
		
		//ディレクトリ内のファイル名を１つずつを取得
		//while( $file_name = readdir( $res_dir ) ){
		//	$pos = $pos||strripos($file_name === basename( $_FILES['uploadedfile']['name']));
		//}	
		
		
		if (is_uploaded_file($_FILES["upfile"]["tmp_name"])) {
			if(move_uploaded_file($_FILES['upfile']['tmp_name'], $target_path)) { 
    			chmod($target_path, 0644);
			    echo "The file ". basename($file_name). " has been uploaded to ".$file_name; 
			} 	
			else
    			echo "There was an error uploading the file, please try again!"; 
		} else
		  echo "ファイルが選択されていません。";
	}
}


?>
