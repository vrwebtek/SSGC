<?php defined('BASEPATH') OR exit('No direct script access allowed'); $this->session->set_userdata('previous_page', current_url());
	foreach($single_result as $row)
	{
		$id=$row->id;
		$photo=$row->photo;
		$name=$row->name;
		$testimonial=$row->testimonial;
	}
?>
<!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Home/Testimonials </strong></small></h3>
              </div>
            </div>
            
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Add a new testimonial for homepage here</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br />
                    
                    <?php echo form_open_multipart('admin/testimonial_action/update','class="form-horizontal form-label-left"','data-parsley-validate');?>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="first-name">Name of Client/Company<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" id="name" name="name" value="<?php echo $name; ?>" required class="form-control col-md-7 col-xs-12">
                          
                          <input type="hidden" name="id" value="<?php echo $id; ?>">
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Change Photo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <img src="<?php echo base_url('assets/public/images/testimonials/'.$photo); ?>">
                          <input type="file" id="photo" name="photo" class="form-control col-md-7 col-xs-12">
                          <?php echo $error;?>
                        </div>
                      </div>
                      
                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="last-name">Testimonial <span class="required">*</span>
                        </label>
                        <div class="col-md-12 col-sm-6 col-xs-12">
                          <textarea name="testimonial" placeholder="Write the testimonial here"><?php echo $testimonial;?></textarea>
                          <?php echo $error;?>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">
                        	<button type="submit" class="btn btn-success">Submit</button>
                          	<button type="submit" class="btn btn-primary">Cancel</button>
                        </div>
                      </div>

                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          
          <div class="row">
          	<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List of testimonials used in home page</h2>

                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-wrench"></i></a>
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sr.</th>
                          <th>Name</th>
                          <th>Image</th>
                          <th>Testimonial</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
								$counter=0;
								foreach($all_testimonials as $row)
								{
									$counter++;
							?>
                            <tr>
                            	<td>
                                	<?php echo $counter; ?>
                                </td>
                                <td>
                                	<?php echo $row->name; ?>
                                </td>
                                
                                <td>
                                	<img src="<?php echo base_url('assets/public/images/testimonials/'.$row->photo); ?>">
                                </td>
                                <td>
                                	<?php echo $row->testimonial; ?>
                                </td>
                                <td>
                                	<a class="btn btn-app" href="<?php echo site_url('admin/testimonialEdit/'.$row->id); ?>">
                      					<i class="fa fa-edit"></i> Edit
                    				</a>
                                    <a class="btn btn-app" href="<?php echo site_url('admin/testimonialDelete/'.$row->id); ?>">
                      					<i class="fa fa-trash"></i> Delete
                    				</a>
                                </td>
                           </tr>
                            <?php
								}
							?>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>
          </div>
        </div>
        
        
        
        <!-- /page content -->