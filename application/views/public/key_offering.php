<?php defined('BASEPATH') OR exit('No direct script access allowed');
	//echo "Hello ! Successfull !";
	
	
?>
<script src="<?php echo base_url('assets/public/js/flipMainJS.js');?>"></script>

<script src="<?php echo base_url('assets/public/js/jquery.flip.min.js');?>"></script>
<script>
	var jq = jQuery.noConflict(true);
</script>
<script>
jq(function(){
    jq(".flip").flip({
        trigger: 'hover'
    });
});
</script>

<?php

		$name=$menu[0]['name'];
		$body=$menu[0]['body'];
		$id=$menu[0]['id'];
		


?>
<div class="bg_1 wrap_2 wrap_4" style="width: 77%;float: left;">
    <div class="container" style="width:100%; float:left;">
        <div class="row">
            <div class="preffix_2 grid_8" style="margin-left:0px; padding-left:30px; width:100%;">
                <h2 class="header_1 wrap_3 color_3" style="padding-left: 6%; text-align: left;">
                    <?php echo $name; ?>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="grid_12" style="width:94%; float:left;">
                <div class="box_1" style="padding-left:6%;">
                    <p class="text_3" style="text-align: justify;padding-left: 16px;padding-right: 33px;">
                        <section class="bodySection"><?php echo $body; ?></section>
                    </p>
                </div>
                 
            </div>
        </div>
    </div>
</div>

<!--right sidebar-->
<div class="bg_1 wrap_2 wrap_4" style="width: 23%;float: left;">
    <div class="container" style="width:100%; float:left; padding-right: 12%; padding-bottom: 24px;border-left: 1px solid #00abe3;">
        <div class="row" style="margin-left:0;">
            <div class="preffix_2 grid_8" style="margin-left:0px; padding-left:0px; width:100%;">
                <h2 class="header_1 color_1" style="background-color: #00abe3;font-size: 22px; line-height: 36px; ">
                    Key Offerings
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="grid_12" style="width:100%; float:left;">
                <div class="box_1">
                    <p class="text_3" style="text-align: justify;padding-left: 16px;padding-right: 33px;">
                     <ul>
                        <?php
						
                        	foreach($other_offering as $oo)
							{
								if($oo['name']==$name)
								{
									?>
                                    <li style="text-align: left;padding-left: 24px;float:left;width:75%;"><a href="<?php echo site_url("page/load_key_offerings/".$oo['slug']); ?>" style="display: block;font-size: 10px; font-weight: bold;" ><?php echo $oo['name']; ?></a><div class="bottom_highlight"></div></li>
                                    <?php
								}
								else{
								?>
                               
                                	<li style="text-align: left;padding-left: 24px;float:left;width:75%;"><a href="<?php echo site_url("page/load_key_offerings/".$oo['slug']); ?>" style="display: block;font-size: 11px;"><?php echo $oo['name']; ?></a><div class="bottom_highlight"></div></li>
                                    
                                
                                <?php
								}
								
							}
						
						?>
                        </ul>
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <div class="container" style="width:88%; float:left; padding-bottom: 24px;border-left: 1px solid #00abe3; border-bottom: 1px solid #00abe3;">
        <div class="row" style="margin-left:0;">
            <div class="preffix_2 grid_8" style="margin-left:0px; padding-left:0px; width:100%;">
                <h2 class="header_1 color_1" style="background-color: #00abe3;font-size: 22px; line-height: 36px; ">
                    Contact us
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="grid_12" style="width:100%; float:left;">
                <div class="box_1">
                    <p class="text_3" style="text-align: justify;padding-left: 16px;padding-right: 33px;">
                    <h4>Rebeca Pereira Alves</h4>
                    97 Peachfield Road<br />
                    CERNEY WICK
                    GL7 7ZY
                    </p>
                </div>
            </div>
        </div>
    </div>
    
    
    
</div>


<style>
	.bodySection p{
		text-align:justify;
		line-height: 26px;
	}
	.bottom_highlight{
		width:100%;
		float:left;
		border-bottom:1px dashed #00abe3;
	}
	#ourServices_container{
		width:100%;
		display:block;
		float:left;
		height:300px;
		padding-left:6px;
		font-family: 'Marvel', sans-serif;
	}
	
	
	.flip {
   height: 35%;
    width: 22%;
   
    float: left;
    margin-left: 2%;
    margin-top: 4%;
	color:#FFF;
	border:1px solid #FFF;
	
	}
	.flip img {
		width: 300px;
		height: auto;
	}
	.flip .back {
		background: #2184cd;
		color: #fff;
		text-align: center;
	}
	.bodySection{
		text-align:left;
	}
	.bodySection ol{
		list-style: initial;
    margin: initial;
    padding: 0 0 0 40px;
	}
	
	.bodySection ul{
		list-style: initial;
    margin: initial;
    padding: 0 0 0 40px;
	}
</style>

