<?php
class A
{
    function foo()
    {
        if (isset($this)) {
            echo '$this is defined (';
            echo get_class($this);
            echo ")\n";
        } else {
            echo "\$this is not defined.\n";
        }
    }
}

class B
{
    function bar()
    {
        A::foo();
    }
}

$a = new A();
$a->foo();

A::foo();

$b = new B();
$b->bar();

B::bar();
/*session_start();
//include_once 'connect.php';
class UserSel{
	function get(Field){
		global $con;
		$rsUSel = mysqli_query($con, "SELECT UVal FROM UserSel WHERE UField = '{$Field}' AND UId = '{$_SESSION['LoginUserID']}'");
	}
	function set(Field, Value){
		 mysqli_query($con, "INSERT INTO UserSel (UId, UField, UVal) VALUES ('{$_SESSION['LoginUserID']}, '{$Field}', '{$Value}')");
	}
}
$objUSel = new UserSel();
$objUSel->UserSel();
*/
?>
