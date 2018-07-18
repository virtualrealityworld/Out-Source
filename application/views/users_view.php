<html>
    <head>
        <title>Load Friends</title>
        <script src="<?=base_url();?>javascript/jquery-3.3.1.min.js"></script>
    </head>
    <body>
		<?php
			if(isset($countries)){
				?>
				<select id="country" name="country">
				<?php
				foreach($countries as $country){
				?>
				<option <?php if($country->language_id==$this->uri->segment(3) ){ echo 'selected '; } ?>value="<?=$country->language_id;?>"><?=$country->country_name;?></option>
				<?php
				}
				?>
				</select>
				<?php
			}
		?>
		<script type="text/javascript">
			var url = "<?=base_url();?>welcome/get_international_friends/";
			$(document).ready(function(){
				$("#country").on('change', function() {
					url += $(this).find(":selected").val()+"/0";
					window.location = url;
				});
			});
		</script>
		<table border="1">
		<?php
			foreach($friends[0] as $friend){
				echo "<tr>";
				echo "<td>".$friend->user_id."</td>";
				echo "<td>".$friend->email."</td>";
				echo "<td>".$friend->pass."</td>";
				echo "<td>".$friend->real_name."</td>";
				echo "<td>".$friend->country."</td>";
				echo "</tr>";
			}
			
		?>
		</table>
		<?=$this->pagination->create_links();?>
	</body>
</html>