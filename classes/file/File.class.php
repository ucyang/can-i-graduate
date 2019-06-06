<?php
/**
 * Manages files
 */
class File
{
    public static $file = NULL;
    protected static $file;

    public static function connectFile($uploadFile)
    {
        self::$file = fopen("test.csv", "r");

    }

    public static function parseFile()
    {
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
}
