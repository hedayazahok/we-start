<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <script src="https://www.dukelearntoprogram.com/course1/common/js/image/SimpleImage.js"></script>

        <link href="{{ public_path('css/style.css') }}" rel="stylesheet" type="text/css" />

    </head>

<body>
        <div class="cleftbox" style="">
    <div class="container pm-certificate-container" >
      <div class="outer-border" ></div>
      <div class="inner-border" ></div>

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
                    <span class="pm-name-text bold">{{$certficate['name']}}</span>
                  </div>
                  <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                </div>
              </div>

              <div class="col-xs-12">
                <div class="row">
                  <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                  <div class="pm-earned col-xs-8 text-center">
                    <span class="pm-earned-text padding-0 block cursive">has earned</span>
                    <span class="pm-credits-text block bold sans">PD175: {{$certficate['hour']}} Credit Hours</span>
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
                    <span class="pm-credits-text block bold sans">{{ $certficate['course']}}</span>
                  </div>
                  <div class="col-xs-2"><!-- LEAVE EMPTY --></div>
                </div>
              </div>
          </div>



        </div>



</div>
    </div>
  </body>
</html>
