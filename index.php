<?php
include "./func/config.php";
include "./includes/header.php";
?>


<?php  ?>

<div class="w3l-homeblock2 py-5">
    <div class="container py-lg-5 py-md-4">
        <!-- block -->
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title-left mb-4"> Lated Pick </h3>
                <div class="d-flex flex-wrap" id="lastedpost">
                   

                    <!-- <div class="col-lg-6 col-md-6 item">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="#blog-single.html">
                                    <img class="card-img-bottom d-block radius-image-full" src="assets/images/image1.jpg" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body blog-details">
                                <a href="#blog-single.html" class="blog-desc">The 3 Eyeshadow palettes I own & How
                                    to
                                    downsize your stash
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur ipsum adipisicing elit. Quis
                                    vitae sit.</p>
                                <div class="author align-items-center mt-3 mb-1">
                                    <img src="assets/images/a1.jpg" alt="" class="img-fluid rounded-circle" />
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="author.html">Isabella ava</a> </a>
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> July 13, 2020 </span>. <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1
                                                min</span>
                                        </li>
                                    </ul>
                                </div>
                                <div style="display: flex;  justify-content: space-evenly;">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-thumbs-up" aria-hidden="true"></i> Like</button>
                                    <button type="button" class="btn btn-secondary"><i class="fa fa-comment" aria-hidden="true"></i> Comment</button>
                                    <button type="button" class="btn btn-danger" style="display: none;"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-lg-6 col-md-6 mt-md-0 mt-sm-5 mt-4 item">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="#blog-single.html">
                                    <img class="card-img-bottom d-block radius-image-full" src="assets/images/image2.jpg" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body blog-details">
                                <span class="label-blue">Fashion</span>
                                <a href="#blog-single.html" class="blog-desc">2 New outfit formulas to add to your
                                    Capsule Wardrobe
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur ipsum adipisicing elit. Quis
                                    vitae sit.</p>
                                <div class="author align-items-center mt-3 mb-1">
                                    <img src="assets/images/a2.jpg" alt="" class="img-fluid rounded-circle" />
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="author.html">Charlotte mia</a> </a>
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> July 13, 2020 </span>. <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1
                                                min</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 mt-md-0 mt-sm-5 mt-4">
                        <div class="card">
                            <div class="card-header p-0 position-relative">
                                <a href="#blog-single.html">
                                    <img class="card-img-bottom d-block radius-image-full" src="assets/images/image2.jpg" alt="Card image cap">
                                </a>
                            </div>
                            <div class="card-body blog-details">
                                <span class="label-blue">Fashion</span>
                                <a href="#blog-single.html" class="blog-desc">2 New outfit formulas to add to your
                                    Capsule Wardrobe
                                </a>
                                <p>Lorem ipsum dolor sit amet consectetur ipsum adipisicing elit. Quis
                                    vitae sit.</p>
                                <div class="author align-items-center mt-3 mb-1">
                                    <img src="assets/images/a2.jpg" alt="" class="img-fluid rounded-circle" />
                                    <ul class="blog-meta">
                                        <li>
                                            <a href="author.html">Charlotte mia</a> </a>
                                        </li>
                                        <li class="meta-item blog-lesson">
                                            <span class="meta-value"> July 13, 2020 </span>. <span class="meta-value ml-2"><span class="fa fa-clock-o"></span> 1
                                                min</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div> -->
                </div>
            </div>
            <div class="d-flex justify-content-center w-100 my-2 align-content-center">
                <button type="button" name="" id="loadmore" class="btn btn-outline-primary btn-lg w-50 ">Load more <i class="fas fa-caret-down    "></i></button>
            </div>

        </div>
    </div>
</div>
<script src="./assets/js/btnevent.js"></script>
<script src="./assets/js/main.js"></script>

<div class="w3l-subscribe py-5">
    <div class="container py-lg-5 py-md-4">
        <div class="w3l-subscribe-content text-center bg-clr-white py-md-5 py-2">
            <div class="py-5">
                <h3 class="section-title-left mb-2">Subscribe to our newsletter!</h3>
                <p class="mb-md-5 mb-4">We'll send you the best of our blog just once a month. We promise. </p>
                <form action="#" method="GET" class="subscribe">
                    <input type="email" class="subscribe_input" name="search" placeholder="Email address" required="">
                    <button class="btn btn-style btn-primary">Subscribe</button>
                </form>
            </div>
        </div>
    </div>
</div>




<?php
include "./includes/footer.php";
?>