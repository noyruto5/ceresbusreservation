<?php
class SiteBasics {

	//rewrite the properties visibility to protected and make
	// getters and setters function for $conn, $input_warning, and $input_success
	protected $servername = "localhost";
	protected $username = "root";
	protected $password = "";
	protected $database = "webr_db";
	protected $conn;
	public $input_warning;
	public $input_success;

	function connect() {
		// Create connection
		$this->conn = new mysqli($this->servername, 
								$this->username, 
								$this->password, 
								$this->database);

		// Check connection
		if ( $this->conn->connect_error )
		{
		    die("Connection failed: " . $this->conn->connect_error);
		}
	}


	function get_servername() {
		return $this->servername;
	}


	function get_conn() {
		return $this->conn;
	}
	

	function site_title($title) {
		echo "Ceres Bus Reservation | $title";
	}


	function login() {
		//If the login form is submitted
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{
			$username = $_POST['username'];
			$password = $_POST['password'];

			$this->connect();
					
			//Makes sure it filled up completely
			if ( !empty($username) && !empty($password) )
			{
				$result = $this->conn->query("SELECT password, role FROM users WHERE username = '$username' AND status = 'verified' ");
						
				//If the user name existed
				if ( $result->num_rows > 0 ) 
				{
					$row = $result->fetch_assoc();
					$db_password = $row['password'];
					$role = $row['role'];
					
					//If password is correct
					if ( password_verify($password, $db_password) ) 
					{
						//Store user info is this variable. This var will be accessible in all pages
						setcookie('USERNAME', $username); 
						setcookie('PASSWORD', $password);
						setcookie('ROLE', $role);
						
						if ($role == "admin") {
							header("Location: reserved_passengers.php");
						} else {
							header("Location: reservation_form.php");
						}
						
					
						$this->conn->close();
					}
					else
					{
						$this->input_warning = "*Login failed! Invalid password.";	
					}
				}
				else
				{
					$this->input_warning = "*Login failed! Invalid username.";
				}
			}			
		}
	}


	function register() {

		//If the form submitted
		if ( $_SERVER['REQUEST_METHOD'] == 'POST' )
		{

			$this->connect();

			//check if filled up completely
			if ( isset($_POST['username']) 
				&& isset($_POST['email']) 
				&& isset($_POST['password']) 
				&& isset($_POST['confirm_password']) ) 
			{

				//check if password and confirm password are equal
				if ( $_POST['password'] == $_POST['confirm_password'] ) 
				{
					//check if user already in database
					$result = $this->conn->query("SELECT * FROM users 
											WHERE username = '".$_POST['username']."' 
											OR email = '".$_POST['email']."' ");

					if ( $result->num_rows == 0 ) 
					{
						$username = trim($_POST['username']);
						$email = trim($_POST['email']);
						$password = $_POST['password'];
						$role = 'guest';
						$status = 'not-verified';
						$fname = trim($_POST['fname']);
						$lname = trim($_POST['lname']);
						$prk = trim($_POST['prk']);
						$brgy = trim($_POST['brgy']);
						$city = trim($_POST['city']);
						$province = trim($_POST['province']);

						$hashed_password = password_hash($password, PASSWORD_DEFAULT);
						
						$stmt = $this->conn->prepare("INSERT INTO users (username, password, email, role, status, fname, lname, prk, brgy, city, province) 
						VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
						$stmt->bind_param("sssssssssss", $username, $hashed_password, $email, $role, $status, $fname, $lname, $prk, $brgy, $city, $province);
						$stmt->execute();
						$stmt->close();
						$this->conn->close();

						$to = $email;
						$subject = "Activate your account";

						$message = "
						<html><head></head>
						<body>
						<h3>Hello $username,</h3><br />
						<p>Thank you for registering. Verify your email address to complete your account in our website. Click the link below.</p><a href='localhost/ceresbusreservation/verify_account.php?username=$username&password=$hashed_password'>localhost/ceresbusreservation/verify_account.php?username=$username&password=$hashed_password</a>
						</body>
						</html>";

						// Always set content-type when sending HTML email
						$headers = "MIME-Version: 1.0" . "\r\n";
						$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

						// More headers
						$headers .= 'From: <cerbusreservation@company.com>' . "\r\n";

						mail($to,$subject,$message,$headers);

						header("Location: verify_account.php");
					} 
					else
					{
						$this->input_warning = "*Username or Email has already been registered.";
					}
				}
				else
				{
					$this->input_warning = "*Password didn't match.";
				}
			}
			else
			{
				$this->input_warning = "*Please fill up completely.";
			}
		}
	}


	function logout() {
		//session_start();		
		$past = time() - 3600; 

		//this makes the time in the past to destroy the cookie 
		setcookie('USERNAME', 'gone', $past); 
		setcookie('PASSWORD', 'gone', $past);
		setcookie('ROLE', 'gone', $past);
		setcookie('BASENAME', 'gone', $past);


		header("Location: /ceresbusreservation/index.php"); 
		exit();
	}


	function authenticate() {
		session_start();
		$this->connect();
		
		if ( isset($_COOKIE['USERNAME']) ) 
		{ 
			$username = $_COOKIE['USERNAME']; 
			$password = $_COOKIE['PASSWORD']; 
			
			$result = $this->conn->query("SELECT password FROM users WHERE username = '$username'");

			while ( $row = $result->fetch_assoc() ) 	 
			{ 
				//if the password is wrong, redirect to home page
				$db_password = $row['password'];
				if (password_verify($password, $db_password))  
				{ 	
					//do nothing
				}
				else{
					$this->conn->close();
					header("Location: /ceresbusreservation/index.php"); 
					exit();
				}
			}
		}
		else 
		//if the session does not exist, they are taken to the home page
		{			
			$this->conn->close(); 
			header("Location: /ceresbusreservation/index.php"); 
			exit();
		} 
	}


	function verify_account() {
		if (isset($_GET['username']) && isset($_GET['password'])) {
			$username = $_GET['username'];
			$password = $_GET['password'];
			$this->connect();
			$this->conn->query("UPDATE users SET status = 'verified' WHERE username = '".$username."' 
								AND password = '".$password."' ") or die("Error: ".$this->conn->error);
			$this->conn->close();
			return TRUE;
		} else {
			return FALSE;
		}
	}


	function page_refresh_check() {
		$pageWasRefreshed = isset($_SERVER['HTTP_CACHE_CONTROL']) && $_SERVER['HTTP_CACHE_CONTROL'] === 'max-age=0';

		if($pageWasRefreshed ) {
			return TRUE;
		} else {
		   //do nothing;
		}
	}


	function get_role() {
		$role = $_COOKIE['ROLE'];

		return $role;
	}


	function input_validation($data) {
	  	$data = trim($data);
	  	$data = strip_tags($data);
	  	$data = htmlspecialchars($data);
	  	return $data;
	}


	function user_email() {
		//get the user email to be used in sending ref_no to emails
		$result = $this->conn->query("SELECT email FROM users WHERE username = '".$_COOKIE['USERNAME']."' ") or die("Error: ".$this->conn->error);	
		$row = $result->fetch_assoc();
		$email = $row['email'];

		return $email;
	}
}
?>