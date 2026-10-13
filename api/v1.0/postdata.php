<?php

/*----------------Calculating the starting and endign values for the loop------------------------------------*/

	if($count)
	{
		if ($cur_page >= 7) 
		{
			$start_loop = $cur_page - 3;
			if ($no_of_paginations > $cur_page + 3)
				$end_loop = $cur_page + 3;
			else if ($cur_page <= $no_of_paginations && $cur_page > $no_of_paginations - 6) 
			{
				$start_loop = $no_of_paginations - 6;
				$end_loop = $no_of_paginations;
			} 
			else 
			{
				$end_loop = $no_of_paginations;
			}
		} 
		else 
		{
			$start_loop = 1;
			if ($no_of_paginations > 7)
				$end_loop = 7;
			else
				$end_loop = $no_of_paginations;
		}
		/* ----------------------------------------------------------------------------------------------------------- */

		//Start Pagination Logic
        echo "<div><ul class='pagination' style='float:right;'>";
		// FOR ENABLING THE FIRST BUTTON
		if ($first_btn && $cur_page > 1) 
		{
			echo '<li p="1" class="paginate_button page-item active first" id="tableNature_previous">
					<a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
	                <i class="far fa-angle-double-left"></i>
	                </a>
	        	</li>';
					
			//echo "<li p='1' class='active'>First</li>";
		} 
		else if ($first_btn) 
		{
			echo '<li p="1" class="paginate_button page-item first disabled" id="tableNature_previous">
					<a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
	                	<i class="far fa-angle-double-left"></i>
	                </a>
	        	</li>'; 
		//	echo "<li p='1' class='inactive'>First</li>";
		}

		// FOR ENABLING THE PREVIOUS BUTTON
		if ($previous_btn && $cur_page > 1) 
		{
			$pre = $cur_page - 1;
			echo '<li p="'.$pre.'" class="paginate_button page-item active previous" id="tableNature_previous">
			   		<a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
		                <i class="far fa-angle-left"></i>
		            </a>
				</li>';
			//echo "<li p='$pre' class='active'>Previous</li>";
		} 
		else if ($previous_btn) 
		{
			echo '<li p="'.$pre.'" class="paginate_button page-item previous disabled" id="tableNature_previous">
		    	<a href="javascript:void(0);" data-dt-idx="0" tabindex="0" class="page-link">
	                <i class="far fa-angle-left"></i>
	            </a>
			</li>';
			//echo "<li class='inactive'>Previous</li>";
		}
		for ($i = $start_loop; $i <= $end_loop; $i++) 
		{

			if ($cur_page == $i)
				echo '<li p="'.$i.'" class="paginate_button page-item active iscurrent"><a href="javascript:void(0);" tabindex="0" class="page-link">'.$i.'</a></li>';
				
				//echo "<li p='$i' style='color:#fff;background-color:#ff6b89;pointer-events:none' class='active iscurrent'>{$i}</li>";
				
			else
				echo '<li p="'.$i.'" class="paginate_button page-item active "><a href="javascript:void(0);" tabindex="0" class="page-link">'.$i.'</a></li>';
				
				//echo '<li p="'.$i.'" class="active">'.$i.'</li>';
		}

		// TO ENABLE THE NEXT BUTTON
		if ($next_btn && $cur_page < $no_of_paginations) 
		{
			$nex = $cur_page + 1;
			echo "<li p='$nex' class='active paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-right'></i></a></li>";
		} 
		else if ($next_btn) 
		{
			echo "<li class='inactive disabled paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-right'></i></a></li>";
		}

		// TO ENABLE THE END BUTTON
		if ($last_btn && $cur_page < $no_of_paginations) 
		{
			echo "<li p='$no_of_paginations' class='active paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-double-right'></i></a></li>";
		} 
		else if ($last_btn) 
		{
			echo "<li p='$no_of_paginations' class='inactive disabled paginate_button page-item'><a href='javascript:void(0);' data-dt-idx='0' tabindex='0' class='page-link'><i class='far fa-angle-double-right'></i></a></li>";
		}
		if($dataaction=='dailywork')	
		{
			$time = '<span class="pull-right">Total Time : <b style="color: #28AB5E">'.$tottime.'</b></span>';
		}
		$goto = "<input type='text' class='goto hidden' weight='1' style='margin-top:-1px;margin-left:60px;'/><input type='button' id='go_btn' class='go_button hidden' value='Go'/>";
		$total_string = "<span class='total' a='$no_of_paginations'>Page <b>" . $cur_page . "</b> of <b>$no_of_paginations</b></span>";
		echo "</ul>" . $goto . $time . $total_string . "</div>";  // Content for pagination
		//End Pagination Logic
	}

?>