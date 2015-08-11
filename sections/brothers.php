<!-- OUR BROTHERS SECTION -->
	<section id="brothers" class="content-section text-center">
		<div class="header">
			<div class="title">THE BROTHERS</div>
			<div class="subtitle">
				Get to know the Brothers. 
			</div>
		</div> <!-- End Brothers-Header" -->

		<div id="core" class="container">
			<div class="row center-align img-wrapper">
				<div class="col-md-2 title">
					Core Executive Board
				</div> <!-- Core Text Over -->
				
				<!-- OUTPUT CORE E-BOARD MEMBERS -->
				<div class="col-md-10 ">
					<div class="row">
					<?php
						if( ( $h = fopen( $site_path."/core.csv", "r" ) ) !== FALSE )
						{
							$row = fgetcsv( $h, 0, "\n" );
							$core_eboard = [];
							
							while( ($row = fgetcsv( $h, 0, "\n" ) ) !== FALSE )
							{
								$row = explode( ",", $row[0] );
								$FN = str_replace( " ", "", $row[0] );
								$LN = str_replace( " ", "", $row[1] );
								$Position = $row[2];
								$core_eboard[ $Position ] = $FN." ".$LN;
							}
						}
						
						foreach( $core_eboard as $position => $full_name )
						{
							$full_name = str_replace( " ", "_", $full_name );
					?>
						<div class="col-md-3 img-wrapper center-align" data-toggle="modal">
							<div class="img-setter">
								<img src="<?php echo $site_path."/img/brothers/".$full_name[0].explode( "_", $full_name )[1].".jpg"; ?>" alt="<?php echo $full_name; ?>">
							</div>
							<div class="img-title">
								<?php echo $position; ?>
							</div>
							<div class="img-name">
								<?php 
									$full_name = str_replace( "_", " ", $full_name );
									echo $full_name; 
								?>
							</div>
						</div>
					<?php
						}
					?>
					</div> <!-- END OUTPUT CORE E-BOARD MEMBERS -->
				</div> <!-- Core Image Over -->
			</div>
		</div>

		<!-- SEMESTER CHAIRS, E Board -->
		<div id="semester" class="container">
			<div class="row center-align img-wrapper">
				<div class="col-md-2 title">
					Semester Executive Board
				</div> <!-- Core Text Over -->

				<div class="col-md-10 brothers-img-set">
					<div class="row">
					<?php
						if( ( $h = fopen( $site_path."/semester.csv", "r" ) ) !== FALSE )
						{
							$row = fgetcsv( $h, 0, "\n" );
							$semester_eboard = [];
							
							while( ($row = fgetcsv( $h, 0, "\n" ) ) !== FALSE )
							{
								$row = explode( ",", $row[0] );
								$FN = str_replace( " ", "", $row[0] );
								$LN = str_replace( " ", "", $row[1] );
								$Position = $row[2];
								$semester_eboard[ $Position ] = $FN." ".$LN;
							}
						}
						
						$counter = 1;
						foreach( $semester_eboard as $position => $full_name )
						{
							$full_name = str_replace( " ", "_", $full_name );
					?>
						<div class="col-md-2 core-img-wrapper center-align" data-toggle="modal">
							<div class="img-setter">
								<img src="<?php echo $site_path."/img/brothers/".$full_name[0].explode( "_", $full_name )[1].".jpg"; ?>" alt="<?php echo $full_name; ?>">
							</div>
							<div class="img-title">
								<?php echo $position; ?>
							</div>
							<div class="img-name">
								<?php 
									$full_name = str_replace( "_", " ", $full_name );
									echo $full_name; 
								?>
							</div>
						</div>
					<?php
							if( ($counter % 6) == 0 )
							{
								echo '<div class="clearfix"></div>';
							}
							$counter++;
						}
					?>
					</div> <!-- End Row -->
				</div> <!-- Core Image Over -->
			</div>
		</div> <!-- End Semester Chairs -->
		
		<?php
			if( ( $h = fopen( $site_path."/brothers.csv", "r" ) ) !== FALSE )
			{
				$row = fgetcsv( $h, 0, "\n" );
				$brother_info = [];
				
				while( ($row = fgetcsv( $h, 0, "\n" ) ) !== FALSE )
				{
					$row = explode( ",", $row[0] );
					$FN = $row[0];
					$LN = $row[1];
					$Class = $row[2];
					$brother_info[ $Class ][] = [ "FN" => $FN, "LN" => $LN];
				}
			}
			
			// Show each pledge class in their own section.
			Foreach( $brother_info as $class_name => $pledge_class )
			{
		?>
		<div id="brothers" class="brothers-semester container">
			<div class="row">
				<div class="brothers-pc">
					<div class="row center-align img-wrapper">
						<div class="col-md-2 title">
							<div class="core-eboard-wrapper">
								<div class="core-eboard-text">
									<?php echo $class_name; ?>
								</div>	
							</div>
						</div>
						<div class="col-md-10">
							<div class="row">
			<?php					
				$counter = 1;
				Foreach( $pledge_class as $brother_info )
				{
			?>
								<div class="col-md-2" data-toggle="modal">
									<div class="pc-img-only">
										<img src="<?php echo $site_path."/img/brothers/".$brother_info["FN"][0].str_replace( " ", "", $brother_info["LN"] ).".jpg"?>" alt="<?php echo $brother_info["FN"]." ".$brother_info["LN"]?>">
									</div>
									<div class="core-img-name">
										<?php echo $brother_info["FN"]." ".$brother_info["LN"]?>
									</div>
								</div><!-- End Brother -->
		<?php
					if( ($counter % 6) == 0 )
					{
						echo '<div class="clearfix"></div>';
					}
					$counter++;
				}
				// Completed a pledge class!!!
		?>
							</div> <!-- End Inner Row -->
						</div> <!-- Core Image Over -->
					</div>
				</div>
			</div>
		</div>
		<?php
			}
			// Completed showing all brothers!!!
		?>
      <!-- End Brothers Section -->
    </section>