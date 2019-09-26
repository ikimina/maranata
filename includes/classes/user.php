
<?php

/**
 * @eric
 */
class User
{
	
	function __construct($con,$tel)
	{
		$this->con=$con;
		$this->tel=$tel;
	}
    public function getFname()
    {
    	return $this->tel;
    }
	
}


 ?>