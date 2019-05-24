<!DOCTYPE html>
<html lang="kor" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!--부트스트랩-->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="navbar bg-light">
      <!--로고-->
      <a href="#" class="navbar-brand">Can I graduate</a>
      <!--~님 안녕하세요-->
      <div class="greeting">
        (php변수)님 안녕하세요
      </div>
    </div>

    <div class="container">
      <!--체크박스를 선택하거나 검색하면 해당 과목만 보여주는 것 구현 필요-->
      <div class="indicator-container">
        <div class="row">
          <div class="col-3">
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="major">전공
              </label>
            </div>
            <div class="form-check-inline">
              <label class="form-check-label">
                <input type="checkbox" class="form-check-input" value="general">교양
              </label>
            </div>
          </div>
          <div class="col-4">

          </div>
          <div class="col-5 d-flex justify-content-end">
            <input type="text">
            <button class="btn btn-primary" onclick="search()">검색</button>
          </div>
          <div class="row">
            <h3>체크박스를 선택하거나 검색하면 해당 과목만 보여주는 것 구현 필요</h3>
          </div>
        </div>


      </div>
      <!--전체 과목들 중에서 내가 들은 과목 골라서 저장하기-->
      <!--input type checkbox에 체크된 것들이 save_classes.php로 넘어간다-->
      <div class="table-responsive">
        <form  action="save_classes" method="post">
          <table class="table">
            <thead class="thead-light">
              <tr>
                <th>체크박스</th>
                <th>과목 이름</th>
                <th>과목 번호</th>
                <th>학년</th>
                <th>조건1</th>
                <th>조건2</th>
                <th>조건3</th>
                <th>조건4</th>
              </tr>
            </thead>

            <tr>
              <td><input name="class_id1" type="checkbox"></td>
              <td>과목1</td>
              <td>00000</td>
              <td>1</td>
              <td>값1</td>
              <td>값2</td>
              <td>값3</td>
              <td>값4</td>
            </tr>
            <tr>
              <td><input name="class_id1" type="checkbox"></td>
              <td>과목1</td>
              <td>00000</td>
              <td>1</td>
              <td>값1</td>
              <td>값2</td>
              <td>값3</td>
              <td>값4</td>
            </tr>
            <tr>
              <td><input name="class_id1" type="checkbox"></td>
              <td>과목1</td>
              <td>00000</td>
              <td>1</td>
              <td>값1</td>
              <td>값2</td>
              <td>값3</td>
              <td>값4</td>
            </tr>
            <tr>
              <td><input name="class_id1" type="checkbox"></td>
              <td>과목1</td>
              <td>00000</td>
              <td>1</td>
              <td>값1</td>
              <td>값2</td>
              <td>값3</td>
              <td>값4</td>
            </tr>

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
              <th>과목 이름</th>
              <th>과목 번호</th>
              <th>학년</th>
              <th>조건1</th>
              <th>조건2</th>
              <th>조건3</th>
              <th>조건4</th>
            </tr>
          </thead>

          <tr>
            <td>과목1</td>
            <td>00000</td>
            <td>1</td>
            <td>값1</td>
            <td>값2</td>
            <td>값3</td>
            <td>값4</td>
          </tr>
          <tr>
            <td>과목1</td>
            <td>00000</td>
            <td>1</td>
            <td>값1</td>
            <td>값2</td>
            <td>값3</td>
            <td>값4</td>
          </tr>
          <tr>
            <td>과목1</td>
            <td>00000</td>
            <td>1</td>
            <td>값1</td>
            <td>값2</td>
            <td>값3</td>
            <td>값4</td>
          </tr>
          <tr>
            <td>과목1</td>
            <td>00000</td>
            <td>1</td>
            <td>값1</td>
            <td>값2</td>
            <td>값3</td>
            <td>값4</td>
          </tr>

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

      <div class="container">
        <h3>세부 졸업 요건</h3>
        <form  action="save_detail.php" method="post">
          <div class="row" id="table-row">
            <!--졸업관련 정보를 보여주는 표들-->
            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">졸업요건 분류 이름</th>
                </tr>
                <tr>
                  <td class="col-7">졸업요건1</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건2</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건3</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
              </table>
            </div>

            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">졸업요건 분류 이름</th>
                </tr>
                <tr>
                  <td class="col-7">졸업요건1</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건2</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건3</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
              </table>
            </div>

            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">졸업요건 분류 이름</th>
                </tr>
                <tr>
                  <td class="col-7">졸업요건1</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건2</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건3</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
              </table>
            </div>

            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">졸업요건 분류 이름</th>
                </tr>
                <tr>
                  <td class="col-7">졸업요건1</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건2</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건3</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
              </table>
            </div>

            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">졸업요건 분류 이름</th>
                </tr>
                <tr>
                  <td class="col-7">졸업요건1</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건2</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건3</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
              </table>
            </div>

            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">졸업요건 분류 이름</th>
                </tr>
                <tr>
                  <td class="col-7">졸업요건1</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건2</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건3</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
              </table>
            </div>

            <!--표의 숫자를 나타내는 php 변수가 있으면 for문으로 후에 수정할 것-->
            <div class="col-12 col-md-6 col-lg-4" >
              <!--현재는 3행만 넣어놨으나 나중에는 이것도 for문을 이용해 각 table의 필요한 행만큼 만들도록 수정할 것-->
              <table class="table table-bordered">
                <tr>
                  <th colspan="2" class="col-12">졸업요건 분류 이름</th>
                </tr>
                <tr>
                  <td class="col-7">졸업요건1</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건2</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
                </tr>
                <tr>
                  <td class="col-7">졸업요건3</td>
                  <td class="col-5"><input type="text" name="해당값" value="해당값"></td>
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
