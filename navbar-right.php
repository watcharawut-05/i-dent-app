
<div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
        <li>
            <a href="#">
                <i class="glyphicon glyphicon-user"></i>
                <span> <?= $sess_fullname ;?> | 
				<?php
				$sql="select dep_name from dep where dep_id='$sess_depcode' ";
				$query = $conn->prepare($sql);
				$query->execute();
				while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $dep_name=$row['dep_name'];
    			echo $dep_name;
				}
				?></span>
            </a>
        </li>            
    </ul>
</div>
