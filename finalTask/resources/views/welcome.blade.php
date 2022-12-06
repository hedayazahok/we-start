<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
        <style>
             @font-face {
        src: url('/../fonts/OpenSans-VariableFont_wdth,wght.ttf');
        font-family: "Open Sans";
    }

    @font-face {
        src: url('/../fonts/PinyonScript-Regular.ttf');
        font-family: "Pinyon Script";
    }
           body {
            background: #222;
  color: #fff;
  position: relative;
  text-align: center;
  font-size: 1rem;
  font-family: sans-serif;
  padding-bottom: 3em;
}

.cwrapper {
  display: inline-block;
  margin: 2em auto;
}

.cwrapper .cleftbox,.cwrapper .crightbox {
  display: table-cell;
  vertical-align: top;
}

.cwrapper .crightbox ul.controls{
  list-style-type: none;
  text-align: left;
 margin-top: 50%;
}

.cwrapper .crightbox ul li{
  padding: 10px 0;
}

.cwrapper .crightbox ul li label,
.cwrapper .crightbox ul li select {
  display: block;
  width: 100%;
}

.cursive {
  font-family: 'Pinyon Script', cursive;
}

.sans {
  font-family: 'Open Sans', sans-serif;
}

.bold {
  font-weight: bold;
}

.block {
  display: block;
}

.underline {
  border-bottom: 1px solid #777;
  padding: 5px;
  margin-bottom: 15px;
}

.margin-0 {
  margin: 0;
}

.padding-0 {
  padding: 0;
}

.pm-empty-space {
  height: 40px;
  width: 100%;
}

body {
  padding: 20px 0;
 background: #222;

}

.pm-certificate-container {
  position: relative;
  width: 800px;
  height: 600px;
  background-color: #618597;
  padding: 30px;
  color: #333;
  font-family: 'Open Sans', sans-serif;
  box-shadow: 0 0 5px rgba(0, 0, 0, .5);
  /*background: -webkit-repeating-linear-gradient(
    45deg,
    #618597,
    #618597 1px,
    #b2cad6 1px,
    #b2cad6 2px
  );
  background: repeating-linear-gradient(
    90deg,
    #618597,
    #618597 1px,
    #b2cad6 1px,
    #b2cad6 2px
  );*/

}

  .outer-border {
    width: 794px;
    height: 594px;
    position: absolute;
    left: 50%;
    margin-left: -397px;
    top: 50%;
    margin-top:-297px;
    border: 2px solid #fff;
  }

  .inner-border {
    width: 730px;
    height: 530px;
    position: absolute;
    left: 50%;
    margin-left: -365px;
    top: 50%;
    margin-top:-265px;
    border: 2px solid #fff;
  }

  .pm-certificate-border {
    position: relative;
    width: 720px;
    height: 520px;
    padding: 0;
    border: 1px solid #E1E5F0;
    background-color: rgba(255, 255, 255, 1);
    background-image: none;
    left: 50%;
    margin-left: -360px;
    top: 50%;
    margin-top: -260px;
  }

    .pm-certificate-block {
      width: 650px;
      height: 200px;
      position: relative;
      left: 50%;
      margin-left: -325px;
      top: 70px;
      margin-top: 0;
    }

    .pm-certificate-header {
      margin-bottom: 10px;
    }

    .pm-certificate-title {
      position: relative;
      top: 40px;


    }
 h2 {
        font-size: 34px !important;
      }
    .pm-certificate-body {
      padding: 20px;


    }
 .pm-name-text {
        font-size: 20px;
      }
    .pm-earned {
      margin: 15px 0 20px;


    }
   .pm-credits-text {
        font-size: 15px;
      }
 .pm-earned-text {
        font-size: 20px;
      }
    .pm-course-title {


    }
 .pm-earned-text {
        font-size: 20px;
      }
   .pm-credits-text {
        font-size: 15px;
      }
    .pm-certified {
      font-size: 12px;


    }
.underline {
        margin-bottom: 5px;
      }
    .pm-certificate-footer {
      width: 650px;
      height: 100px;
      position: relative;
      left: 50%;
      margin-left: -325px;
    }

        </style>
    </head>
    <body>
        <div class="cwrapper">
          <div class="cleftbox">

                <div class="container pm-certificate-container">
                    <div class="outer-border"></div>
                    <div class="inner-border"></div>

                    <div class="pm-certificate-border col-xs-12">
                      <div class="row pm-certificate-header">
                        <div class="pm-certificate-title cursive col-xs-12 text-center">
                          <h2>Buffalo Public Schools Certificate of Completion</h2>
                        </div>
                      </div>

                      <div class="row pm-certificate-body">

                        <div class="pm-certificate-block">
                            <div class="col-xs-12">
                              <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-certificate-name underline margin-0 col-xs-8 text-center">
                                  <span id="stdName" class="pm-name-text bold"  >dssdf</span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                              </div>
                            </div>

                            <div class="col-xs-12">
                              <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-earned col-xs-8 text-center">
                                  <span class="pm-earned-text padding-0 block cursive">has earned</span>
                                  <span class="pm-credits-text block bold sans" > <span id="hour">1.0</span> Credit Hours</span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="col-xs-12"></div>
                              </div>
                            </div>

                            <div class="col-xs-12">
                              <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-course-title col-xs-8 text-center">
                                  <span class="pm-earned-text block cursive">while completing the training course entitled</span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                              </div>
                            </div>

                            <div class="col-xs-12">
                              <div class="row">
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                                <div class="pm-course-title underline col-xs-8 text-center">
                                  <span class="pm-credits-text block bold sans" id="course">BPS PGS Initial PLO for Principals at Cluster Meetings</span>
                                </div>
                                <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                              </div>
                            </div>
                        </div>


                      </div>

                    </div>
                  </div>



          </div>
          <div class="crightbox">
            <ul class="controls">

                <form action="{{route('certificate')}}" method="POST">
                    @csrf
                    <li>
                        <label>student Name:</label>
                        <input type="text" id="stdnameInput" name="stdname" onkeyup="changeStdName(this.value)" placeholder="Enter student name" class="form-control">
                    </li>
                    <li>
                        <label>Name of course:</label>
                        <input type="text" id="courseInput" name="course" onkeyup="changeCourse(this.value)" placeholder="Enter course name" class="form-control">
                    </li>
                    <li>
                        <label>number of hours of the course:</label>
                        <input type="number" id="hourInput" name="hour"  onkeyup="changeHour(this.value)" placeholder="Enter no. of hours" class="form-control">
                    </li>

                    <li >
                        <button type="submit"  name="submit" class="btn btn-primary btn-block">Send Certificate</button>
                    </li>


        </ul>
            <!--text parameters-->
          </div>
        </div>

    </body>
    <script>
var stdName = document.getElementById('stdName');
var hour = document.getElementById('hour');
var course = document.getElementById('course');

function changeStdName(val){
    stdName.innerHTML =val;
}
function changeHour(val){

    hour.innerHTML =val;

}
function changeCourse(val){
    course.innerHTML =val;

}


    </script>

<script>
    import html2canvas from 'html2canvas';

function download(canvas, filename) {
    event.preventDefault()
  const data = canvas.toDataURL("image/png;base64");
  const donwloadLink = document.querySelector("#generatePNG");
  donwloadLink.download = filename;
  donwloadLink.href = data;
}

html2canvas(document.querySelector(".cleftbox")).then((canvas) => {
  // document.body.appendChild(canvas);
  download(canvas, "asd");
});

    </script>
</html>
