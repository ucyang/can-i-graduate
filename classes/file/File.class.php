<?php
/**
 * Manages files
 */
class File
{

    protected static $file;

    public static function connectFile($uploadFile)
    {
      echo 'connectFile<br>';
      setlocale(LC_CTYPE, 'ko_KR.utf8');
      if(file_exists($uploadFile))
      {
        if((self::$file = fopen($uploadFile, "r"))===false){
          echo '파일 읽기 실패<br>';
          echo "파일 경로 : $uploadFile<br>";
        }
      }else{
        echo '파일 읽기 성공.<br>';
      }


    }
    public static function closeFile()
    {
      fclose(self::$file);
    }

    public static function parseUploadFile()
    {
      echo 'parseFile()<br>';
      $row =1;

      while (($data = fgetcsv(self::$file, ",")) !== FALSE)
      {

        if($row>1)
        {
          $class_srl=preg_replace('/[^0-9]+/', '', $data[3]);
          $grade = preg_replace('/([^0-9\.])/', '', $data[8]);
          var_dump($class_srl);
          var_dump($grade);

          $sql = "SELECT lecture_srl FROM lectures WHERE course_no = '$class_srl'";
          echo "<br>$sql<br>";
          if($result=DB::getConn()->query($sql))
          {
              $lectureInfo = $result->fetch_assoc();
          }
          else
          {
            echo "ERROR : ", DB::getConn()->error;
          }
          //var_dump($result);

          $sql = "INSERT INTO attended_lectures(member_srl, lecture_srl, grade) VALUES('{$_SESSION['user_srl']}', '{$lectureInfo['lecture_srl']}', '$grade')";
          echo "<br>$sql<br>";
          if(DB::getConn()->query($sql)==false)
          {
            echo "<br>ERROR : ", DB::getConn()->error;
          }

        }


        $row++;
      }

    }


    public static function parseLecturesFile()
    {

      if(self::$file===false)
      {
        echo "파일이 존재하지 않습니다.<br>";
        return;
      }
      else
      {
        $row =1;
        while (($data = fgetcsv(self::$file,0,",")) !== FALSE)
        {
          foreach($data as $key=>$value)
          {
            $data[$key]=preg_replace('/[^가-힣a-zA-Z0-9()\/]/', '', $value);
          }

          if($row>1)
          {
            var_dump($data);
            $sql = "INSERT INTO lectures(course_no,class_no,year,semester,campus,college,dept,title,inst_name,credit,course_class,course_type,abeek_type)VALUES({$data[0]},{$data[1]},{$data[2]},{$data[3]},'{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}',{$data[9]},'{$data[10]}','{$data[11]}','{$data[12]}')";

            if(DB::getConn()->query($sql))
            {
              echo "데이터 입력 성공";
            }
            else
            {
              echo "error: " . DB::getConn()->error;

            }

          }


          $row++;
        }

      }

    }
}
