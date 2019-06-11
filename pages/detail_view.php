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
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <!--로고-->
        <div class="navbar-header">
          <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-education"></span> Can I Graduate?</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="/?act=dashboard">대시보드</a></li>
          <li class="active"><a href="/?act=detail">세부정보</a></li>
        </ul>
        <ul class='nav navbar-nav navbar-right'>
          <li><a href="/?act=modify" disabled><span class="glyphicon glyphicon-user"></span> <?php echo $memberinfo['nickname'];?></a></li>
          <li><a href="/?act=logout"><span class="glyphicon glyphicon-log-out"></span> 로그아웃</a></li>
        </ul>
      </div>
    </nav>

    <div class="container" style="margin-top:50px">
      <!--체크박스를 선택하거나 검색하면 해당 과목만 보여주는 것 구현 필요-->
      <h3>강의 목록</h3>
      <br />
      <div class="indicator-container">
        <div class="row">
          <div class="col-md-7">
            <label class="checkbox-inline form-check-label">
              <input id='majorCheckbox' type="checkbox" class="form-check-input" value="major" onclick='search()' checked="checked"> 전공
            </label>
            <label class="checkbox-inline form-check-label">
              <input id='generalCheckbox' type="checkbox" class="form-check-input" value="general" onclick='search()' checked="checked"> 교양
            </label>
          </div>
          <div class="col-md-2">
          </div>
          <div class="col-md-3 d-flex justify-content-end input-group">
            <input id="searchBox" type="text" class="form-control" placeholder="Search">
            <div class="input-group-btn">
              <button class="btn btn-default" type="" onclick="searchWithName()">
                <i class="glyphicon glyphicon-search"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <br />
      <!--전체 과목들 중에서 내가 들은 과목 골라서 저장하기-->
      <!--input type checkbox에 체크된 것들이 save_classes.php로 넘어간다-->
      <form  action="?act=save_lectures" method="post">
        <div class="table-responsive" style="height: 20vw; overflow: auto">
          <table class="table table-striped" overflow="auto" >
            <thead class="thead-light">

              <tr>
                <th>선택</th>
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
        </div>
        <br />
        <div class="d-flex justify-content-center">
          <input type="submit" class="btn btn-light" value="저장">
        </div>
      </form>
      <hr />
      <h3>저장된 강의</h3>
      <br />
      <div class="table-responsive" style="height: 20vw; overflow: auto">
        <table class="table table-striped">
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

          for($j = 0; $j<count(User::$attended_lectures);$j++){
            $k = $j+(int)1;
            echo "<tr class='lectures'>";
            echo "<td>". $k ."</td>";
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
      <hr />
      <h3>성적 파일 업로드</h3>
      <br />
        <form enctype='multipart/form-data' action="?act=save_file" method="post">
          <div class="form-group row">
            <div class="col-md-3">
              <input type="file" class="form-control-file border" name="file">
            </div>
            <div class="col-md-1">
              <input type="submit" name="submit" class="btn btn-dark" value="저장">
            </div>
          </div>
        </form>
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
        <hr />
        <h3>세부 졸업 요건</h3>
        <br />
        <form  action="/?act=save_detail" method="post">
          <div class="row" id="table-row">
            <!--졸업관련 정보를 보여주는 표들-->
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4"style="width:100%; margin-bottom:20px" >
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">공통교양</th> <!-- 필수 교양과목 7과목입니다. 각 과목을 수강했는지 받아와야 합니다. -->
                </tr>
                <tr>
                  <td class="col-md-10">ACT</td>
                  <td class="col-md-2 text-center"><?php if(User::$commonLecture['ACT']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">한국사</td>
                  <td class="col-md-2 text-center"><?php if(User::$commonLecture['korean_history']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">글쓰기</td>
                  <td class="col-md-2 text-center"><?php if(User::$commonLecture['writing']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">창의와소통</td>
                  <td class="col-md-2 text-center"><?php if(User::$commonLecture['creative']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">디자인적사고와 문제해결</td>
                  <td class="col-md-2 text-center"><?php if(User::$commonLecture['design']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">앙트레프레너십시대의회계</td>
                  <td class="col-md-2 text-center"><?php if(User::$commonLecture['Accounting']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">COMMUNICATION IN ENGLISH</td>
                  <td class="col-md-2 text-center"><?php if(User::$commonLecture['English']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
              </table>
            </div>
            <div class="col-12 col-md-6 col-lg-4" style="width:100%; margin-bottom:20px">
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">핵심교양</th> <!-- 이 5개 영역 각각을 1과목씩 들었는지 체크해야 합니다-->
                </tr>
                <tr>
                  <td class="col-md-10">핵심-도전</td>
                  <td class="col-md-2 text-center"><?php if(User::$credit['core_challenge']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">핵심-창의</td>
                  <td class="col-md-2 text-center"><?php if(User::$credit['core_creative']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">핵심-융합</td>
                  <td class="col-md-2 text-center"><?php if(User::$credit['core_convergence']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">핵심-신뢰</td>
                  <td class="col-md-2 text-center"><?php if(User::$credit['core_trust']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">핵심-소통</td>
                  <td class="col-md-2 text-center"><?php if(User::$credit['core_communication']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
              </table>
            </div>
            <div class="col-12 col-md-6 col-lg-4" style="width:100%; margin-bottom: 20px">
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">전공필수</th> <!-- 이 11과목을 각각 수강했는지 체크해야합니다.-->
                </tr>
                <tr>
                  <td class="col-md-10">창의적설계</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['creativeDesign']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">이산수학</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['discreteMath']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">자료구조</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['dataStructure']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">프로그래밍언어론</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['programingLanguage']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">컴퓨터구조</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['cumputerArchitecture']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">알고리즘</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['Algorithm']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">운영체제</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['os']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">휴먼ICT소프트웨어공학</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['SE']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">캡스톤디자인(1)</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['c1']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">캡스톤디자인(2)</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['c2']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
                <tr>
                  <td class="col-md-10">산업체인턴쉽</td>
                  <td class="col-md-2 text-center"><?php if(User::$majorEssential['internship']=='Y') echo 'O'; else echo 'X';?></td>
                </tr>
              </table>
            </div>
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4"style="width:100%; margin-bottom:20px" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">공통졸업요건</th>
                </tr>
                <tr>
                  <td class="col-md-10">영어능력</td>
                  <td class="col-md-2 text-center"><input type="submit" id='english' name='english' class = "<?php if(User::$graduationStatus['english']=='X') {echo 'btn-danger';}else{ echo 'btn-primary';}?> btn-block" onclick = "change(this)"  value= "<?php echo User::$graduationStatus['english'];?>"/></td>
                </tr>
                <tr>
                  <td class="col-md-10">한자능력</td>
                  <td class="col-md-2 text-center"><input type="submit" id='chinese_char' name='chinese_char' class = "<?php if(User::$graduationStatus['chinese_char']=='X') {echo 'btn-danger';}else {echo 'btn-primary';}?> btn-block" onclick = "change(this)"  value= "<?php echo User::$graduationStatus['chinese_char'];?>"/></td>
                </tr>
              </table>
            </div>
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" style="width:100%; margin-bottom:20px">
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">전공졸업요건</th>
                </tr>
                <tr>
                  <td class="col-md-10">지도교수와 상담4회</td>
                  <td class="col-md-2 text-center"><input type="submit" id='counseling' name='counseling' class = "<?php if(User::$graduationStatus['counseling']=='X') echo 'btn-danger';else echo 'btn-primary';?> btn-block" onclick = "change(this)"  value= "<?php echo User::$graduationStatus['counseling'];?>"/></td>
                </tr>
                <tr>
                  <td class="col-md-10">졸업논문</td>
                  <td class="col-md-2 text-center"><input type="submit" id='paper' name='paper' class = "<?php if(User::$graduationStatus['paper']=='X') echo 'btn-danger';else echo 'btn-primary';?> btn-block" onclick = "change(this)"  value= "<?php echo User::$graduationStatus['paper'];?>"/></td>
                </tr>
                <tr>
                  <td class="col-md-10">TOPCIT점수</td>
                  <td class="col-md-2 text-center"><input type="submit" id='topcit' name='topcit' class = "<?php if(User::$graduationStatus['topcit']=='X') echo 'btn-danger';else echo 'btn-primary';?> btn-block" onclick = "change(this)"  value= "<?php echo User::$graduationStatus['topcit'];?>"/></td>
                </tr>
              </table>
            </div>
          </div>

        </form>
    </div>
  </body>
</html>
