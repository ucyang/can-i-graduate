<!DOCTYPE HTML>
<html>
  <HEAD>
    <!--부트스트랩-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script type="text/javascript">

    </script>
  </HEAD>

  <body>
    <!--
      아이디 id
      비밀번호 password
      이름 name
      이메일 email
      대학교 university
      전공 major
      입학년도 entrance_year가
      join_process.php로 넘어감
    -->
    <div class="container">
      <p><h3>회원가입 페이지</h3></p>
      <form action="join_process.php" method="post">
        <div class="form-group">
          <label for="id">아이디</label>
          <input class="form-control" type="text" name="id" placeholder="아이디를 입력해주세요" required>
        </div>
        <div class="form-group">
          <label for="password">비밀번호</label>
          <input class="form-control" type="password" name="password" placeholder="비밀번호를 입력해주세요" required>
        </div>
        <div class="form-group">
          <label for="name">이름</label>
          <input class="form-control" type="text" name="name" placeholder="이름을 입력해주세요" required>
        </div>
        <div class="form-group">
          <label for="email">이메일</label>
          <input class="form-control" type="email" name="email" placeholder="이메일을 입력해주세요" required>
        </div>
        <div class="form-group">
          <label for="university">대학교</label>
          <select class="form-control" id="university">
            <option>중앙대학교</option>
          </select>
        </div>
        <div class="form-group">
          <label for="major">전공</label>
          <select class="form-control" id="major">
            <option>컴퓨터공학부</option>
            <option>소프트웨어전공</option>
            <option>소프트웨어학부</option>
          </select>
        </div>
        <div class="form-group">
          <label for="entrance_year">입학년도</label>
          <select class="form-control" id="entrance_year">
            <option>2013</option>
            <option>2014</option>
            <option>2015</option>
            <option>2016</option>
            <option>2017</option>
            <option>2018</option>
            <option>2019</option>
          </select>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">확인</button>
      </form>

    </div>


 </body>
</html>
