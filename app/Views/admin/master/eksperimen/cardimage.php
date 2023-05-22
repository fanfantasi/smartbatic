<style type="text/css">
  .carousel-item img {
    width: 100%;
    height: 350px;
  }
  .carousel-item:hover img{
    opacity:0.5;
  }
  .carousel-item:hover .btn{
    display: block;
  }
  .carousel-item .btn {
    position: absolute;
    top: 50%;
    display:none;
    left: 50%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    background-color: transparent;
    color: white;
    
    border: none;
    cursor: pointer;
    border-radius: 5px;
    text-align: center;
  }
  .card-body {
    position: relative;
    overflow: hidden;
  }

  .child {
    background-color: #dc3545;
    position: absolute;
    right: -65px;
    width: 220px;
    height: 40px;
    -webkit-transform: rotate(45deg);
    transform: rotate(45deg);
    padding-left: 10px;
    padding-top: 10px;
    display: table;
    z-index: 10;
    color: white;
    text-align: center;
    line-height: 1.2;
  }
  .pricenormal {
      font-size: 12px;
      line-height: 1.4;
      padding: 5px 6px;
      padding-right: 18px;
      background-color: #dc3545;
      position: absolute;
      top: 14%;
      left: 0px;
      font-weight: bold;
      color: #fff;
      border-bottom-right-radius: 18px;
      min-width: 50%;
      text-align: center;
      text-decoration:line-through;
  }
  h5 {
    font-size: 12px;
    line-height: 1.4;
    font-weight: bold;
  }
</style>
<div class="row">
  <?php 
    foreach ($peserta as $row) : ?>
    <div class="col-md-4" style="padding-right: 0px; padding-left: 0px;">
        <div class="col-md-12">
            <div class="card">
            <div class="card-header text-muted border-bottom-1">
                <div style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                <p class="mb-0" style="font-size: 12px; line-height: 1.4;"><b><?= $row['materi'];?></b></p>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                <?php 
                    $price= "<h5 class='mb-0'>$row[sekolah]</h5>";

                    $no=0; 
                    $indicator=array();
                    $imgs=array();
                    if ($row['image'] != null){
                    foreach ($row['image'] as $im): 
                        if ($no == 0){
                        $active='active';
                        }else{
                        $active='';
                        }
                        $indicator[]  = array(
                            'indica' => "<li data-target=\"#carouselExampleIndicators$row[id]\" data-slide-to=\"$no\" class=\"$active\"></li>",
                        );
                        $indi = $indicator;
                        $imgs [] = array(
                            'img' => "<div class=\"carousel-item $active\">
                                        <img class=\"d-block \" src=\"http://192.168.1.10:8082/uploads/gallery/$row[uid]/$im[img]\" alt=\"$row[displayname]\" >
                                        <div class=\"carousel-caption d-none d-md-block\">
                                            <p>$im[desc]</p>
                                        </div>

                                    </div>",
                        );
                        $no++;
                    endforeach;
                    }else{
                    $indi = [];
                    $imgs [] = array(
                            'img' => "<div class=\"carousel-item active\">
                                        <img class=\"d-block\" src=".base_url('uploads/no-images.png')." alt=\"$row[displayname]\">
                                    </div>",
                        );
                    }
                    
                ?>
                <div id="carouselExampleIndicators<?= $row['id'];?>" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                    <?php
                        foreach ($indi as $key => $value) {
                        echo $value['indica'];
                        }
                    ?>
                    </ol>
                    <div class="carousel-inner">
                    <?php
                        foreach ($imgs as $key => $value) {
                        echo $value['img'];
                        }
                    ?>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators<?= $row['id'];?>" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators<?= $row['id'];?>" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                    </a>
                </div>  
                </div>
            </div>
            <div class="card-footer">
                <div class="text-right">
                <?= $row['displayname'];?>
                <?= $price;?>
                </div>
            </div>
            </div>
        </div>
    </div>
      
    <?php endforeach; ?>
</div>