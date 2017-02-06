<?php

namespace azbn7;

class Tester
{
	public function test($str)
	{
		echo 'Hello, ' . $str . '!<br />' . $this->Azbn7->version['update_at'];
	}
}