</section><!--section for main content ends here-->
</div><!--page div ends here-->
<?php
$is_menu_page = $this->router->fetch_class() === 'page' ? true : false;
				if($is_menu_page)
				{
					?>
                    
                    <div class="camera-wrapper" id="menuPage_bgi">
                        <div id="camera" class="camera-wrap">
                        <?php 
						$bgi=$menu[0]['bgi'];
						$bgit=$menu[0]['bgit'];
						
						if(!empty($bgi))
                        {
                            $imgURL='assets/public/images/menu_background/'.$bgi;
						}
						else{
							$default=$default_mn_bg[0]['image'];
							$imgURL='assets/public/images/'.$default;
						}
                            ?>
                            <div data-src="<?php echo base_url($imgURL)?>">
                                <div class="fadeIn camera_caption">
                                	<h2 class="text_1 color_1"><?php echo $bgit ?></h2>
                                    <a class="btn_1" href="#">Ask For Service</a>
                                </div>
                            </div>
                            
                            
                        </div>
                    </div>
                    
                    
                    <?php
				}
				?>
                

<!--========================================================
                          FOOTER
=========================================================-->
<?php
	$is_home = $this->router->fetch_class() === 'home' ? true : false; /*be carefull in the spelling as Home and home are diffrent here though both are the same controller*/
?>
<footer  class="color_9" id="testyFooter">
    <div class="container">
        <div class="row">
        <?php 
		if($is_home)
		{
			
		?>
        	<div class="grid_12">
           
              <!--testimonials starts here-->
              	<section class="intro" id="intro">
                 <?php
					  foreach($testimonials as $row)
					  {
				  ?>
                  <article class="banner">
                      <div class="testimonyContainer">
                      		<div class="testyPhoto">
                            	<img src="<?php echo base_url('assets/public/images/testimonials/').$row->photo;?>" alt="<?php echo $row->name;?>"/>
                            </div>
                            <div class="testyName">
                            	<?php echo $row->name; ?>
                            </div>
                            <div class="testyText">
                            	<?php echo $row->testimonial;?>
                            </div>
                      </div>
                      
                  </article>

                   <?php
			}
			?>
              </section>
              <!--testimonials end here-->
             
            </div>
            
            
            <script src="<?php echo base_url('assets/public/js/mustang.js');?>"></script>
            <script>
			  $(function() {
				  $(".intro").mustang({
					  item: '.banner',
					  time: 3000,
					  buttonActive: true,
					  next: "#next",
					  prev: "#prev"
				  });
			  });
		  </script>
        <?php
			}
			else{
				//no testimony
			}
		?>
        </div>
        </div>
        </footer>
<footer id="footer" class="color_9">
    <div class="container">
        <div class="row">
        
        	
        
        
        
        
        
        	<div class="grid_12" style="padding-top: 30px;">
              <section class="custom_section">
                  <div class="dblocks">
                      <div class="dhead">PDF Downloads</div>
                      <ul>
                          <?php 
                              foreach($all_pdf as $row)
                              {
                                  $name=$row->name;
                                  $pdf_file=$row->pdf_file;
                                  $slug=$row->slug;
                              
                          ?>
                          <li class="footer_li"><a class="footer_link" href="<?php echo base_url('assets/admin/pdfs/').$pdf_file; ?>"><?php echo $name; ?></a></li>
                          <?php
                              }
                          ?>
                      </ul>
                  </div>
                  <div class="dblocks">
                      <div class="dhead">Subscribe us !</div>
                      <?php echo form_open_multipart('home/subscribe'); ?>
                      	<input type="email" name="subs" placeholder="Email"  /><input type="submit" value="Subscribe" />
                      </form>
                  </div>
                  <div class="dblocks_last">
                  	<div class="dhead">News and Events !</div>
                    <h4>Under development</h4>
                  </div>
              </section>
            </div>
            
            <div class="grid_12">
                <p class="info text_4 color_4">
                    © <span id="copyright-year"></span> | <a href="#">Privacy Policy</a> <br/>
                    Website designed by <a href="http://www.vrwebtek.com/" >VR Webtek Solutions</a>
                </p>
            </div>
        </div>
    </div>
</footer>
<script>var base_url = '<?php echo base_url() ?>';</script>
<script src="<?php echo base_url('assets/public/js/script.js');?>"></script>
</body>
<style>
	.intro {
  width: 100%;
  height: 500px;
  display: flex;
  flex-flow: nowrap row;
  overflow: hidden
}

.intro article {
  flex: 0 0 100%;
  height: 100%;
  transform: translateX(0);
  transition: transform .7s ease-in .2s;
  /*background-color: #FBB600*/
}

/*.intro article:nth-child(2) { background-color: #f1af00 }

.intro article:nth-child(3) { background-color: #e7a700 }

.intro article:nth-child(4) { background-color: #dca000 }

.intro article:nth-child(4) { background-color: #cd9500 }*/

.intro .banner {
  z-index: 10;
  display: flex;
  flex-flow: wrap row;
  justify-content: center;
  align-items: center;
  align-content: center;
  text-align: center
}

.intro .banner h1 {
  flex: 0 0 auto;
  font-weight: 300;
  color: #fff;
  padding: 0 30px;
  font-size: 50px
}

.intro .banner a, .intro .banner h1 { flex: 0 0 100% }

.intro .banner a { color: #fff }

#next, #prev {
  position: relative;
  top: 0;
  width: auto;
  line-height: 100vh;
  z-index: 999;
  font-size: 90px;
  color: #fff;
  padding: 0 20px
}

#next { right: 0 }
.testimonyContainer{
	width:390px;
	max-height:90%;
	padding-top:5px;
	border:2px solid #FFF;
}
.testyPhoto, .testyName, .testyText{
	width:100%;
	float:left;
}
.testyPhoto img{
	border-radius:50%;
	border:3px solid #FFF;
	-webkit-box-shadow: -2px 1px 77px -7px rgba(0,0,0,0.51);
-moz-box-shadow: -2px 1px 77px -7px rgba(0,0,0,0.51);
box-shadow: -2px 1px 77px -7px rgba(0,0,0,0.51);
}
.testyName{
	font-style:italic;
	font-weight:bold;
	color:#FFF;
}
.testyText p{
	text-align:justify;
	line-height:1;
	padding:5px;
	color:#FFF;
}
#testyFooter{
	background: #dadada;
    padding-bottom: 40px;
}
</style>
<script>
					$(document).ready(function(e) {
                        $( "#menuPage_bgi .camera_prev" ).remove();
						  $( "#menuPage_bgi .camera_next" ).remove();
                    });

				  </script>
</html>