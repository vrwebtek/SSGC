<!--========================================================
                          HEADER
=========================================================-->
<header id="header">
    <div id="stuck_container">
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    <div class="brand put-left">
                        <h1>
                            <a href="<?php echo site_url('home'); ?>">
                                <img src="<?php echo base_url('assets/public/images/ssgc_logo.png');?>" alt="Logo" width="300" height="66"/>
                            </a>
                        </h1>
                    </div>
                    <!--<nav class="nav put-right">
                        <ul class="sf-menu">
                            <li class="current" style="margin-left: 11px !important;"><a href="index.html" style="font-size: 14px;">Home</a></li>
                            <li style="margin-left: 11px !important;">
                                <a href="about.html" style="font-size: 14px;">About</a>
                                <ul>
                                    <li><a href="#" >Lorem ipsum</a></li>
                                    <li><a href="#">Dolor sit amet</a>
                                    <li><a href="#">Ctetur adipisicing</a>
                                    <li><a href="#">Elit sed do</a>
                                        <ul>
                                            <li><a href="#">Iusmod tempor</a></li>
                                            <li><a href="#">Incididunt ut labore</a></li>
                                            <li><a href="#">Et dolore magna</a></li>
                                            <li><a href="#">Aliqua Ut enim</a></li>
                                            <li><a href="#">Minim veniam</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            
                            <li style="margin-left: 11px !important;"><a href="contacts.html" style="font-size: 14px;">Contacts</a></li>
                        </ul>
                    </nav>-->
                </div>
            </div>
        </div>
        
        
        <div class="container">
            <div class="row">
                <div class="grid_12">
                    
                    <nav class="nav put-right">
                        <ul class="sf-menu">
                           
                            <!--<li>
                                <a href="#">Tax</a>
                                <ul>
                                    <li><a href="#">Indirect Tax</a></li>
                                    <li><a href="#">Direct Tax</a>
                                    <li><a href="#">International tax</a>
                                </ul>
                            </li>
                            <li><a href="#">Accounting / Auditing</a></li>
                            <li><a href="#">Company Laws</a></li>-->
                            <li><a href="<?php echo site_url('home'); ?>"><span class="glyphicon glyphicon-home"></span></a>
                            <?php
                            	foreach($menus as $mn)
								{
							?>
                            <li><a href="<?php echo site_url($mn->slug); ?>"><?php echo $mn->menu?></a>
                            	<ul>
                                	<?php 
						
						
										foreach($submenus as $sm)
										{
											
											if(($mn->id)==($sm->mid))
											{
												
											
									?>
                                    <li><a href="<?php echo site_url($mn->slug."/".$sm->slug); ?>"><?php echo $sm->menu?></a>
                                    <?php
											}
										}
									?>
                                </ul>
                            </li>
                            <?php
								}
							?>
                            <li><a href="#">Resources</a></li>
                            <li><a href="#">Our Team</a></li>
                            <li><a href="#">Our Office</a></li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        
    </div>
</header>
<section id="content"><!--section for actual contents starts here-->