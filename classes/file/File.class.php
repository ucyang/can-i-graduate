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

    public static function parseFile()
    {
      echo 'parseFile()<br>';
      $row =1;
      while (($data = fgetcsv(self::$file, 1000, ",")) !== FALSE)
      {

        if($row>2)
        {

          $sql = "INSERT INTO attended_lectures(member_srl,lecture_srl, grade) VALUES ({$_SESSION['member_srl']}, $data[3], $data[5])";
          if(DB::getConn()->query($sql) == false)
          {
            echo "error: " . DB::getConn()->error;
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

          if($row>1)
          {

            $sql = "INSERT INTO lectures(course_no,class_no,year,semester,campus,college,dept,title,inst_name,credit,course_class,course_type,abeek_type)VALUES({$data[0]},{$data[1]},{$data[2]},{$data[3]},'{$data[4]}','{$data[5]}','{$data[6]}','{$data[7]}','{$data[8]}',{$data[9]},'{$data[10]}','{$data[11]}','{$data[12]}')";

            if(DB::getConn()->query($sql))
            {
              echo "데이터 입력 성공";
            }
            else
            {
              echo "error: " . DB::getConn()->error;
            }
            echo 'if문 끝<br>';
          }


          $row++;
        }

      }

    }
}
