<input type="hidden" id="ordby" value="desc">
<input type="hidden" id="sortingactivepage" value="1">
<input type="hidden" id="ordbycolumnname" value="primary_date">

<div class="sidebar-wrapper sidebar-theme">            
    <nav id="sidebar">
        <div class="profile-info d-lg-none">
            <figure class="user-cover-image"></figure>
            <div class="user-info">
                <img src="assets/img/user-profile.jpg" alt="avatar">
                <h6 class=""></h6>
                <p class="">Admin</p>
            </div>
        </div>

        <div class="shadow-bottom d-lg-none"></div>
        <ul class="list-unstyled menu-categories" id="accordionMenu">
            
            <?php
            $qry="SELECT * from tblmenuassign where menutypeid=1 order by displayorder asc";
            $parms = array(
                ':id'=>$menuid[$i],
            );
            // echo $qry;
            $result_ary=$DB->getmenual($qry);
            // print_r($result_ary);
            
            if(sizeof($result_ary)>0)
			{
				for($i=0;$i<sizeof($result_ary);$i++)
				{
                    $rowqry=$result_ary[$i];
                    $caretshow='';
                    if($rowqry['isparent']==1) //only parent list 
        		  	{
                        $caretshow='';
                        $alias=$rowqry['alias'];
                        $alias1=$rowqry['alias'];
                        $formname=$rowqry['formname'];
                        $datatoggle='tooltip';
                        $lihide="";
                        // print_r($LoginInfo->getUserrights());
                        if($rowqry['isindividual']==1) //only individual right
                        {
                            $lihide="d-none";
                            $hPagerights =$IISMethods->getpageaccess($LoginInfo->getUserrights(), trim($rowqry['alias']));
                            try
                            {
                                if($rowqry['containright']==0) //contain right check
                                {
                                    $lihide="";
                                }
                                else if((($hPagerights)>0 ?  $hPagerights->getViewright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1)
                                {
                                    $lihide="";
                                }
                            }
                            catch (Error  $e) 
                            {
                                if($IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1)
                                {
                                    $lihide="";
                                }
                            }
                        }
                        else if($rowqry['isindividual']==0) //caret show & href manage
                        {
                            $datatoggle='collapse';
                            $alias='';
                            $caretshow='<div class="sub-icon"><i class="bi bi-chevron-right"></i></div>';
                            // $lihide="";
                        }
                        ?>
                        <li class="menu <?php echo $lihide; ?>" id="li<?php echo $alias; ?>">
                            <a pagename="<?php echo $alias; ?>" formname="<?php echo $formname; ?>" data-menuid=<?php echo $rowqry['id']; ?> aria-expanded="true" class="dropdown-toggle collapsed layout-menu-toggleopen" data-toggle="collapse" data-target="#subMenu<?php echo $alias1; ?>">
                                <div class=""><i class="<?php echo $rowqry['iconstyle'].' '.$rowqry['iconclass'] ?>"></i><span><?php echo $rowqry['textname'] ?></span></div>
                                <?php echo $caretshow ?>
                            </a>
                            <?php
                            // echo $parentid;
                            $parentid=$rowqry['id'];
                            $qry="SELECT * from tblmenuassign where menutypeid=1 AND parentid=:parentid order by displayorder asc";
                            $parms = array(
                                ':parentid'=>$parentid,
                            );
                            // echo $qry;
                            // print_r($parms);
                            $resassignqry=$DB->getmenual($qry,$parms);
                            if(sizeof($resassignqry)>0)
                            {   
                                echo '<ul class="collapse submenu list-unstyled" id="subMenu'.$alias1.'" data-parent="#accordionMenu">';
                                echo '<li id="li'.$alias.'" class="d-none"><a class="layout-menu-toggleclose" pagename="'.$alias1.'" formname="'.$formname.'">'.$rowqry['textname'].'</a></li>';
                                for($j=0;$j<sizeof($resassignqry);$j++)
                                {
                                    $rowassignqry=$resassignqry[$j];
                                    $hPagerights = $IISMethods->getpageaccess($LoginInfo->getUserrights(), trim($rowassignqry['alias']));
                                    
                                    
                                    try
                                    {
                                        if($rowassignqry['containright']==0) //contain right check
                                        {
                                            echo '<li id="li'.$rowassignqry['alias'].'"><a class="layout-menu-toggleclose" pagename="'.$rowassignqry['alias'].'" formname="'.$rowassignqry['formname'].'">'.$rowassignqry['textname'].'</a></li>';
                                        }
                                        else if((($hPagerights) ?  $hPagerights->getViewright():0)==1 || $IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1)
                                        {
                                            echo '<li id="li'.$rowassignqry['alias'].'"><a class="layout-menu-toggleclose" pagename="'.$rowassignqry['alias'].'" formname="'.$rowassignqry['formname'].'">'.$rowassignqry['textname'].'</a></li>';
                                        }
                                    }
                                    catch (Error  $e) 
                                    {
                                        if($IISMethods->checkutypeexist($config->getAdminutype(),$LoginInfo->getUtypeid())==1)
                                        {
                                            echo '<li id="li'.$rowassignqry['alias'].'"><a class="layout-menu-toggleclose" pagename="'.$rowassignqry['alias'].'" formname="'.$rowassignqry['formname'].'">'.$rowassignqry['textname'].'</a></li>';
                                        }
                                    }
                                }
                                echo '</ul>';
                            }
                            ?>
                        </li>
                        <?php
                    }
                }
            }
            ?>
        </ul>
    </nav>
</div>