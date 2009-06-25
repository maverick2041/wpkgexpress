<?php
if (!function_exists('ordinal')) {
	function ordinal($num) {
		$ret = $num . 'th';
		if (($num / 10) % 10 != 1) {
			switch( $num % 10 ) {
				case 1: $ret = $num . 'st'; break;
				case 2: $ret = $num . 'nd'; break;
				case 3: $ret = $num . 'rd'; break;
			}
		}
		return $ret;
	}
}

if ($data === true) {
	echo "Uploaded " . ucwords($type) . " were imported successfully!<br />";
} else {
	echo "Uploaded " . ucwords($type) . (isset($data['Warnings']) && count($data) == 1 ? " were imported successfully, but with the following warnings:" : " were not imported");
	echo "<div class=\"messagesList\">";
	// Here come the nasty-looking nested loops (needed for now, since certain depths need to be handled specially
	foreach ($data as $k => $v) {
		// i.e. $k == 'Errors' || $k == 'Warnings'
		echo Inflector::singularize(ucwords($type)) . " " . $k . "<ul class=\"import-" . strtolower($k) . "\">";
		foreach ($v as $name => $messages) {
			// i.e. $name == 'Package_name/Profile_name/Host_name'
			echo "<li>";
			if (is_array($messages)) {
				echo "$name<ul>";
				foreach ($messages as $k => $message) {
					// i.e. (Currently only applies to packages) $k == 'Check' || $k == 'Action'
					echo "<li>";
					if (is_array($message)) {
						echo "$k<ul>";
						foreach ($message as $position => $arraymessages) {
							// here $position represents the (1-based, top-down) index of the problem package check or package action
							echo "<li>" . ordinal($position) . "<ul>";
							foreach ($arraymessages as $k => $msgs) {
								echo "<li>";
								if (is_array($msgs)) {
									// Currently, $k == 'Exit Codes'
									echo "$k<ul>";
									foreach ($msgs as $position => $array) {
										echo "<li>" . ordinal($position) . "<ul>";
										for ($i = 0; $i < count($array); $i++)
											echo "<li>" . $array[$i] . "</li>";
										echo "</ul></li>";
									}
									echo "</ul>";
								} else
									echo $msgs;
								echo "</li>";
							}
							echo "</ul></li>";
						}
						echo "</ul>";
					} else
						echo $message;
					echo "</li>";
				}
				echo "</ul>";
			} else
				echo $messages;
			echo "</li>";
		}
		echo "</ul>";
	}
	echo "</div>";
}
?>