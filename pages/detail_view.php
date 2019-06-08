<?php
	// 추후 외부 접근방지 구현하기
?>

<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>Details - Can I Graduate?</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="rgb(33, 85, 164)" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <style media="screen">
    .greeting{
      margin-left: auto;
    }
    </style>
    <script type="text/javascript">
      function searchWithName()
      {
        var searchBox = document.getElementById('searchBox');
        var lectures = document.getElementsByClassName('lectures');
        reg = new RegExp(searchBox.value);
        for( var i = 0; i<lectures.length;i++)
        {

          if(searchBox.value !="")
          {
            console.log("안");
            var remarks = lectures[i].getElementsByClassName('title')[0].innerHTML;
            if(reg.test(remarks)==false)
            {
              console.log(searchBox.value);
              lectures[i].style.display='none';
            }

          }
          else
          {
            lectures[i].style.display='table-row';
          }
        }

      }
      function search()
      {

        var majorCheckbox = document.getElementById('majorCheckbox');
        var generalCheckbox = document.getElementById('generalCheckbox');
        var lectures = document.getElementsByClassName('lectures');
        console.log(majorCheckbox);
        console.log(generalCheckbox);
        if(majorCheckbox.checked ==false && generalCheckbox.checked ==false)
        {
          console.log('ff');
          for( var i = 0; i<lectures.length;i++)
          {

            lectures[i].style.display='table-row';

          }
        }
        else if(majorCheckbox.checked ==true && generalCheckbox.checked ==false)
        {
          console.log('tf');
          for( var i = 0; i<lectures.length;i++)
          {
            var remarks = lectures[i].getElementsByClassName('abeek_type')[0].innerHTML;

            if(/교양/.test(remarks)==true || /MACH/.test(remarks)==true)
            {
              console.log(remarks);
              lectures[i].style.display='none';
            }
            else
            {
              lectures[i].style.display='table-row';
            }
          }
        }
        else if(majorCheckbox.checked ==false && generalCheckbox.checked == true)
        {
          console.log('ft');
          for( var i = 0; i<lectures.length;i++)
          {
            var remarks = lectures[i].getElementsByClassName('abeek_type')[0].innerHTML;

            if(/교양/.test(remarks)==true || /MACH/.test(remarks)==true)
            {
              console.log(remarks);
              lectures[i].style.display='table-row';
            }
            else
            {
              lectures[i].style.display='none';
            }
          }
        }
        else
        {
          console.log('tt');
          for( var i = 0; i<lectures.length;i++)
          {
              lectures[i].style.display='table-row';
          }
        }


      }
      function writeCredit(textInput,lecture_srl)
      {
        console.log(textInput.value);
        document.getElementById(lecture_srl).value = textInput.value;
      }

    </script>
  </head>
  <body>
    <div class="navbar bg-light navbar-expand-sm">
      <!--로고-->
      <a href="#" class="navbar-brand">Can I graduate</a>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/?act=dashboard">대시보드</a>
        </li>

        <li class="nav-item">
          <a class="nav-link" href="/?act=logout">로그아웃</a>
        </li>
      </ul>
      <!--~님 안녕하세요-->
      <div class="greeting">
        <?php   echo $memberinfo['nickname']; ?>님 안녕하세요
      </div>
    </div>
    <div class="container">
      <!--체크박스를 선택하거나 검색하면 해당 과목만 보여주는 것 구현 필요-->
      <div class="indicator-container">
        <div class="row">
          <div class="col-3">
            <div class="form-check-inline">
              <label class="form-check-label">
                <input id='majorCheckbox' type="checkbox" class="form-check-input" value="major" onclick='search()'>전공
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input id='generalCheckbox' type="checkbox" class="form-check-input" value="general" onclick='search()'>교양
              </label>
            </div>
          </div>
          <div class="col-4">
          </div>
          <div class="col-5 d-flex justify-content-end">
            <input id='searchBox' type="text">
            <button class="btn btn-primary" onclick="searchWithName()">검색</button>
          </div>

        </div>
      </div>
      <!--전체 과목들 중에서 내가 들은 과목 골라서 저장하기-->
      <!--input type checkbox에 체크된 것들이 save_classes.php로 넘어간다-->
      <div class="table-responsive">
        <form  action="?act=save_lectures" method="post">
          <table class="table" overflow="auto" >
            <thead class="thead-light">

              <tr>
                <th>번호</th>
                <th>학점</th>
                <th>과목 이름</th>
                <th>과목 번호</th>
                <th>대학</th>
                <th>학부</th>
                <th>분류</th>
                <th>비고</th>
              </tr>
            </thead>
            <?php
            $sql = "SELECT * FROM lectures";
            $lectures = DB::getConn()->query($sql)->fetch_all(MYSQLI_ASSOC);


            for($i=0; $i<count($lectures);$i++)
            {
              echo "<tr class='lectures'>";
              echo "<td><input id='{$lectures[$i]['course_no']}' name='{$lectures[$i]['course_no']}' type='checkbox' value=''></td>";
              echo "<td><input type='text' onchange='writeCredit(this, {$lectures[$i]['course_no']})'></td>";
              echo "<td class='title'>{$lectures[$i]['title']}</td>";
              echo "<td class='course_no'>{$lectures[$i]['course_no']}</td>";
              echo "<td class='college'>{$lectures[$i]['college']}</td>";
              echo "<td class='dept'>{$lectures[$i]['dept']}</td>";
              echo "<td class='course_type'>{$lectures[$i]['course_type']}</td>";
              echo "<td class='abeek_type'>{$lectures[$i]['abeek_type']}</td>";

              echo "</tr>";
            }

             ?>

          </table>
          <div class="d-flex justify-content-center">
            <input type="submit" class="btn btn-light" value="저장">
          </div>
        </form>
      </div>
      <h3>저장된 수업들</h3>
      <div class="table-responsive">
        <table class="table">
          <thead class="thead-light">
            <tr>
              <th>체크박스</th>
              <th>학점</th>
              <th>과목 이름</th>
              <th>과목 번호</th>
              <th>대학</th>
              <th>학부</th>
              <th>분류</th>
              <th>비고</th>
            </tr>
          </thead>
          <?php
          User::getattendedLectures();
          echo User::$admission_year."<br>";
          /*
          echo '<pre>';
          var_dump(User::$attended_lectures);
          echo '</pre>';
          */
          for($j = 0; $j<count(User::$attended_lectures);$j++){
            echo "<tr class='lectures'>";
            echo "<td>$j</td>";
            echo "<td><input type='text' value='".User::$attended_lectures[$j]['grade']."' disabled></td>";
            echo "<td class='title'>".User::$attended_lectures[$j]['title']."</td>";
            echo "<td class='course_no'>".User::$attended_lectures[$j]['course_no']."</td>";
            echo "<td class='college'>".User::$attended_lectures[$j]['college']."</td>";
            echo "<td class='dept'>".User::$attended_lectures[$j]['dept']."</td>";
            echo "<td class='course_type'>".User::$attended_lectures[$j]['course_type']."</td>";
            echo "<td class='abeek_type'>".User::$attended_lectures[$j]['abeek_type']."</td>";

            echo "</tr>";
          }

           ?>
        </table>
      </div>
      <!--파일 업로드 부분-->
      <!--save_file.php로 보낸다.-->
      <div class="file_upload container">
        <h3>파일 업로드</h3>
        <form  action="save_file.php" method="post">
          <div class="form-group row">
            <div class="col-3">
              <input type="file" class="form-control-file border" name="file">
            </div>
            <div class="col-1">
              <input type="submit" name="submit" class="btn btn-dark" value="저장">
            </div>
          </div>
        </form>
      </div>
      <script language="JavaScript">

        document.onload = function() {

        };

      function setting(obj){
        if(obj.value == "X"){
          obj.className = "btn-danger btn-block";
        }else{
          obj.className = "btn-primary btn-block";
        }
      }

      function change(obj){
        if(obj.value == "O"){
          obj.value = "X";
          obj.className = "btn-danger btn-block";
        }else{
          obj.value = "O";
          obj.className = "btn-primary btn-block";
        }
      }
</script>
      <div class="container">
        <h3>세부 졸업 요건</h3>
        <form  action="save_detail.php" method="post">
          <div class="row" id="table-row">
            <!--졸업관련 정보를 보여주는 표들-->
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" style="width:100%; height:300px;overflow: auto ;margin-bottom:20px">
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">공통교양</th>
                </tr>
                <tr>
                  <td class="col-7">ACT</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"   value="O" ></td>
                </tr>
                <tr>
                  <td class="col-7">한국사</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O" ></td>
                </tr>
                <tr>
                  <td class="col-7">글쓰기</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="X" ></td>
                </tr>
                <tr>
                  <td class="col-7">창의와소통</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O" ></td>
                </tr>
                <tr>
                  <td class="col-7">디자인적사고와 문제해결</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O" ></td>
                </tr>
                <tr>
                  <td class="col-7">앙트레프레너십시대의회계</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O" ></td>
                </tr>
                <tr>
                  <td class="col-7">COMMUNICATION IN ENGLISH</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O" ></td>
                </tr>
              </table>
            </div>
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" style="width:100%; height:300px;overflow: auto ;margin-bottom:20px">
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">전공필수</th>
                </tr>
                <tr>
                  <td class="col-7">창의적설계</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">이산수학</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">자료구조</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">프로그래밍언어론</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">컴퓨터구조</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">알고리즘</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">운영체제</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">휴먼ICT소프트웨어공학</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">캡스톤디자인(1)</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">캡스톤디자인(2)</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">산업체인턴쉽</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
              </table>
            </div>
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4"style="width:100%; height:300px;overflow: auto ;margin-bottom:20px" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">공통졸업요건</th>
                </tr>
                <tr>
                  <td class="col-7">영어능력</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">한자능력</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
              </table>
            </div>
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" style="width:100%; height:300px;overflow: auto ;margin-bottom:20px">
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">전공졸업요건</th>
                </tr>
                <tr>
                  <td class="col-7">지도교수와 상담4회</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업논문</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
                <tr>
                  <td class="col-7">TOPCIT점수</td>
                  <td class="col-5"><input type="button" class = "btn-primary btn-block" onclick = "change(this)"  value="O"></td>
                </tr>
              </table>
            </div>
          </div>
          <div class="submit">
            <input type="submit" name="submit" value="세부 정보 저장" class="btn btn-dark" >
          </div>
        </form>
      </div>
    </div>
  </body>
</html>
