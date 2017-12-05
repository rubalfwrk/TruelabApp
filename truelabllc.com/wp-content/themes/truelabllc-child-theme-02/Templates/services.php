<?php 

/*

* Template Name: services

*/

get_header();

?>

<section id="blogArchive">
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="blog-breadcrumbs-area">
                    <div class="container">
                        <div class="blog-breadcrumbs-left">
                            <h2>Services</h2>
                        </div>
                        <div class="blog-breadcrumbs-right">
                            <ol class="breadcrumb">
                                <li>You are here</li>
                                <li><a href="#">Home</a>
                                </li>
                                <li class="active">Services</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
 <!--=========== BEGAIN Doctors SECTION ================-->
    <section id="meetDoctors">
        <div class="container">
            
            	<?php
            	$counter = 1;

            	 $recent = new WP_Query("cat=9"); while($recent->have_posts()) : $recent->the_post();

               if($counter%2 !=0){
                 ?>
                  <div class="row">
                      <div class="col-lg-5 col-md-5">
                <div class="serv_img">
                  <?php the_post_thumbnail( 'large','style=max-width:100%;height:auto;'); ?>
                </div>
                      </div>
                      <div class="col-lg-7 col-md-7">
                        <div class="sec-cont">
                          <div class="section-heading align-left">
                            <h2><?php the_title() ?></h2>
                            <div class="line cont-line"></div>
                          </div>
                          <p>
                            <?php echo get_the_content(); ?>
                          </p>
                        </div>
                      </div>
                  </div>
                <?php
               
               }
               else{
                ?>

                  <div class="row">
                <div class="col-lg-7 col-md-7">
                  <div class="sec-cont">
                    <div class="section-heading align-left">
                      <h2><?php the_title() ?></h2>
                      <div class="line cont-line"></div>
                    </div>
                    <p>
                    <?php echo get_the_content(); ?>
                    </p>
                  </div>
                </div>
        <div class="col-lg-5 col-md-5">
          <div class="serv_img">
                  <?php the_post_thumbnail( 'large','style=max-width:100%;height:auto;'); ?>
                </div>
                </div>
            </div>

                <?php
               }
                  $counter++;

               ?>
               <div class="speacer"></div> 
              


                <!-- <div class="col-lg-5 col-md-5">
      					<div class="serv_img">
      						<?php the_post_thumbnail( 'large','style=max-width:100%;height:auto;'); ?>
      					</div>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="sec-cont">
                    <div class="section-heading align-left">
                      <h2><?php the_title() ?></h2>
                      <div class="line cont-line"></div>
                    </div>
                    <p>
                     <?php echo get_the_content(); ?>
                    </p>
                  </div>
                </div>


            </div>
			<div class="speacer"></div>
			 <div class="row">
                <div class="col-lg-7 col-md-7">
                  <div class="sec-cont">
                    <div class="section-heading align-left">
                      <h2>Service Name</h2>
                      <div class="line cont-line"></div>
                    </div>
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                  </div>
                </div>
				<div class="col-lg-5 col-md-5">
					<div class="serv_img">
						<img src="images/product-one.jpg" alt="Image">
					</div>
                </div>
            </div>
			<div class="speacer"></div>
			<div class="row">
                <div class="col-lg-5 col-md-5">
					<div class="serv_img">
						<img src="images/product-one.jpg" alt="Image">
					</div>
                </div>
                <div class="col-lg-7 col-md-7">
                  <div class="sec-cont">
                    <div class="section-heading align-left">
                      <h2>Service Name</h2>
                      <div class="line cont-line"></div>
                    </div>
                    <p>
                      Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.
                    </p>
                  </div>
                </div>  -->
                <?php endwhile; ?>
        
        </div>
    </section>
    <!--=========== End Doctors SECTION ================-->


<?php get_footer(); ?>