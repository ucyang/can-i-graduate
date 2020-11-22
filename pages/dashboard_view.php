<?php
	// 추후 외부 접근방지 구현하기
?>

<!DOCTYPE html>
<html lang="ko">
  <head>
    <title>Dashboard - Can I Graduate?</title>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="rgb(33, 85, 164)" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

  <!--구글 차트-->
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  <script type="text/javascript">
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawCreditChart);
    google.charts.setOnLoadCallback(drawMajorCreditChart);
    google.charts.setOnLoadCallback(drawBarChart);
    function drawBarChart() {
      var data = google.visualization.arrayToDataTable([ //php로 구현해야 할 것들: (1) 수강한 교양과목 학점합 (2) 수강한 BSM과목들 학점 합 (3) 수강한 전공과목들 학점 합 (4) 수강한 모든 과목들의 학점 합 (5) 전체과목 평균학점
          ['졸업요건', '퍼센트',],
          ['전문교양', <?php  echo User::$credit['professional']/6* 100;?>],
          ['BSM(18)', <?php  echo User::$credit['BSM']/18* 100;?>],
          ['전공학점(84)', <?php  echo User::$credit['major']/84* 100;?>],
          ['총 졸업학점(140)', <?php  echo User::$credit['total']/140* 100;?>],
          ['최저졸업평점(2.2/4.5)', <?php  echo (float)User::$gpa/4.5 * 100;?>]
        ]);
      // Set chart options
      var options = {
                     'title':'졸업요건',
                     'width': '100%',
                     'height': 630,
                     'chartArea': {'width': '75%', 'height': '80%'},
                     'legend':{position:'none'}
                    };
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.BarChart(document.getElementById('integrate-chart'));
      chart.draw(data, options);
      window.addEventListener('resize', function() { chart.draw(data, options); }, false);
    }
    function drawMajorCreditChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'credits');
      data.addColumn('number', 'number');
      data.addRows([
        ['수강한 학점', <?php  echo User::$credit['major'];?>],
        ['남은 학점', <?php  echo 84-User::$credit['major'];?>],
        [null,84]
      ]);
      // Set chart options
      var options = {
                     'title':'내 전공 학점이 얼마나 남았나',
                     'width': 450,
                     'height': 450,
                     'chartArea': {'width': '100%', 'height': '80%'},
                     'pieHole':0.4,
                     'pieStartAngle': 270,
                     'pieSliceText': 'value',
                     'slices':{
                       '2':{
                       'color': 'transparent'
                       }
                     }
                       };
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('major-credit-chart'));
      chart.draw(data, options);
    }
    function drawCreditChart() {
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'credits');
      data.addColumn('number', 'number');
      data.addRows([
        ['수강한 학점', <?php  echo User::$credit['total'];?>],
        ['남은 학점', <?php  echo 140-User::$credit['total'];?>],
        [null,140]
      ]);
      // Set chart options
      var options = {
                     'title':'내 학점이 얼마나 남았나',
                     'width': 450,
                     'height': 450,
                     'chartArea': {'width': '100%', 'height': '80%'},
                     'pieHole':0.4,
                     'pieStartAngle': 270,
                     'pieSliceText': 'value',
                     'slices':{
                       '2':{
                         'color': 'transparent'
                       }
                     }
                       };
      // Instantiate and draw our chart, passing in some options.
      var chart = new google.visualization.PieChart(document.getElementById('credit-chart'));
      chart.draw(data, options);
    }
  </script>
  <!--css-->
  <style>
    #major-credit-chart{
      top: -150px;
    }
    #table-row{
      top:-500px;
    }
    /*
    #graph-row{
      height:700px;
      width:120%;
    }
    */
    .greeting{
      margin-left: auto;
    }
    @media screen and (max-width:760px) {
      #table-row{
        top: auto;
      }
      #integrate-chart{
        top:-360px;
        width:100%;
      }
      #graph-row{
        height:1150px;
      }
    }
  </style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
      <!--로고-->
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><span class="glyphicon glyphicon-education"></span> Can I Graduate?</a>
      </div>
      <ul class="nav navbar-nav">
        <li class="active"><a href="/?act=dashboard">대시보드</a></li>
        <li><a href="/?act=detail">세부정보</a></li>
      </ul>
      <ul class='nav navbar-nav navbar-right'>
        <li><a href="/?act=modify" disabled><span class="glyphicon glyphicon-user"></span> <?php echo $memberinfo['nickname'];?></a></li>
        <li><a href="/?act=logout"><span class="glyphicon glyphicon-log-out"></span> 로그아웃</a></li>
      </ul>
    </div>
  </nav>

  <div class="container" style="margin-top:50px">
    <div class="row" id="graph-row">
      <!--학점 반원 그래프-->
      <div class="col-12 col-md-5" id="pie-chart">
        <div class="col-md-12" id="credit-chart"></div>
        <div class="col-md-12" id="major-credit-chart"></div>
      </div>
      <!--밑에 표 내용을 한 번에 보여주는 막대 그래프-->
      <div class="col-12 col-md-7" id="integrate-chart">
      </div>
    </div>
    <div class="row" id="table-row">
      <!--졸업관련 정보를 보여주는 표들-->
      <!--각 과목들은 필수로 들어야 하는 과목들로 데이터베이스에서 해당 과목을 이수했는지 확인해서 O X로 나타냅니다.-->
      <div class="col-12 col-md-6 col-lg-4"style="width:100% ;margin-bottom:20px" >
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
      <div class="col-12 col-md-6 col-lg-4" style="width:100%; margin-bottom:20px">
        <table class="table table-bordered">
          <tr>
            <th colspan="2" class="col-12">공통졸업요건</th> <!-- 이것은 사용자에게 조건을 만족했는지 체크하게만 하면 될것같습니다.-->
          </tr>
          <tr>
            <td class="col-md-10">영어능력</td>
            <td class="col-md-2 text-center"><?php echo User::$graduationStatus['english'];?></td>
          </tr>
          <tr>
            <td class="col-md-10">한자능력</td>
            <td class="col-md-2 text-center"><?php echo User::$graduationStatus['chinese_char'];?></td>
          </tr>
        </table>
      </div>
      <div class="col-12 col-md-6 col-lg-4" style="width:100%; margin-bottom: 20px">
        <table class="table table-bordered">
          <tr>
            <th colspan="2" class="col-12">전공졸업요건</th> <!-- 위와 마찬가지로 조건을 만족했는지만 사용자가 체크할 수 있게 -->
          </tr>
          <tr>
            <td class="col-md-10">지도교수와 상담4회</td>
            <td class="col-md-2 text-center"><?php echo User::$graduationStatus['counseling'];?></td>
          </tr>
          <tr>
            <td class="col-md-10">졸업논문</td>
            <td class="col-md-2 text-center"><?php echo User::$graduationStatus['paper'];?></td>
          </tr>
          <tr>
            <td class="col-md-10">TOPCIT(180점)</td>
            <td class="col-md-2 text-center"><?php echo User::$graduationStatus['topcit'];?></td>
          </tr>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
