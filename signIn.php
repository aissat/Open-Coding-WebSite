<div id="formAdd">
<form method="POST" action="trySignIn.php">
	<h1>SIGN IN</h1>
	<ul style="list-style-type:none">
		<li>
			<div id="F_input"><input type="text" id="textfield" name="F_fullname" placeholder="fullname" maxlength="25" \></div>
		</li>
		<li>
			<div id="F_input"><input type="text" id="textfield" name="F_pseudo" placeholder="Pseudo name" \></div>
		</li>
		<!-- let's try to generate the lists BIRTHDAY !-->
		<?php
			$days  = '<option value="" >DAY</option>';
			$months= '<option value="" >MONTH</option>';
			$years = '<option value="" >YEAR</option>';
		echo '<li><div id="F_input">';
		for($i=1; $i<=31; $i++)
		{
			$days = $days.'<option value="'.$i.'" >'.$i.'</option>';
		}

		for($i=1; $i<=12; $i++)
		{
			$months = $months.'<option value="'.$i.'" >'.$i.'</option>';
		}

		for($i=1970; $i<=2015; $i++)
		{
			$years = $years.'<option value="'.$i.'" >'.$i.'</option>';
		}

		echo '<select name="day" id="comboBox">'.$days.'</select>';
		echo '<select name="month" id="comboBox">'.$months.'</select>';
		echo '<select name="year" id="comboBox">'.$years.'</select>';
		echo '</div id="F_input"></li>';
		?>
		<!-- end generating !-->
		
		<li>
			<div id="F_input"><input type="text" id="textfield" name="F_address" placeholder="Address" maxlength="100" \></div>
		</li>
		<li>
			<div id="F_input"><input type="email" id="textfield" name="F_email" placeholder="user@site.com" \></div>
		</li>
		<li>
			<div id="F_input"><input type="password" id="textfield" name="F_password"  placeholder="Password" maxlength="50" \></div>
		</li>
		<li>
			<div id="F_input">
				<input type="radio" name="F_gender" value="male" id="male"/><label for="male">Male</label> 
				<input type="radio" name="F_gender" value="female" id="female"/><label for="female">Female</label>
			</div>
		</li>
		<li>
			<div id="F_input"><input type="submit" id="button" name="F_submit" value="SUBMIT" \></div>
		</li>
	</ul>
</form>		
</div>