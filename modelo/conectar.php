<?php 
    class mybsd {
        protected $server;
        protected $bd;
        protected $userbd;
        protected $passbd;
        protected $conexion;
        protected function connection()
        {
            $this->server="localhost";
            $this->bd="unearte";
            $this->userbd="root";
            $this->passbd="";
		    $this->connection = mysqli_connect( $this->server, $this->userbd, $this->passbd, $this->bd );
		    if ( $this->connection )
			    return true;
		    else
			    die( "No se conecta: " . mysqli_connect_error() );
        }
        protected function execute($sql)
	    {
		$this->connection();
		if (!mysqli_query( $this->connection, $sql )) {
			return 2;
			//echo "Error: " . $sql . "<br>" . $this->conexion->error;
		}
		else {
			 return mysqli_query( $this->connection, $sql );

		}
		
        }
        protected function list($sql)
	    {
		return mysqli_fetch_array($sql);
	    }

        function CheckResult($sql)
        {
            if(mysqli_num_rows($sql)==0) {
                return False;
            }
            else {
                return mysqli_num_rows($sql);
            }
        }
    }
    
?>