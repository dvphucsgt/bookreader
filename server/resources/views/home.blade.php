@extends('master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <img class="col-8 col-sm-8 col-lg-7 col-md-8 mt-5 rounded-circle" height="100%" src="source_page/images/sg-tech-teamates.JPG">
        <div class="col-4 col-sm-4 col-lg-5 col-md-4 mt-5">
            <div id="album" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                      <img src="source_page/images/trinh.jpg" width="100%" height="100%" alt=""/>
                  </div>
                  <div class="carousel-item">
                    <img src="source_page/images/trung.jpg" width="100%" height="100%" alt=""/>
                  </div>
                  <div class="carousel-item">
                      <img src="source_page/images/quang.jpg" width="100%" height="100%" alt=""/>
                  </div>
                </div>
                <a class="carousel-control-prev" href="#album" data-slide="prev">
                  <span class="carousel-control-prev-icon"></span>
                </a>
                <a class="carousel-control-next" href="#album" data-slide="next">
                  <span class="carousel-control-next-icon"></span>
                </a>
            </div>
        </div>
    </div>
</div>


<div class="mt-5" id="map">
    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3918.4412080564134!2d106.62417331480145!3d10.8540081922689!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752a20d8555e69%3A0x743b1e9558fb89e0!2sQTSC+9+Buiding!5e0!3m2!1sen!2sjp!4v1547012642551" width="100%" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
</div>
@endsection()

