<?php
	
	class MoSPT_Constants
	{
		
		const DB_VERSION				= '146';
		const HOST_NAME					= "https://login.xecurify.com";
        const PTOKEN = 'c2l0ZVBlblRlc3RBZ2VudDpTaXRlUGVuVGVzdEA4ODRnZW50';
        const PURL = 'https://sitestats.xecurify.com/sitepentest/';
        const DEFAULT_CUSTOMER_KEY		= "16555";
        const DEFAULT_API_KEY 			= "fFd2XcvTGDemZvbw1bcUesNJWEqKbbUq";

		function __construct()
		{
			$this->moSPT_defGlobal();
		}

		function moSPT_defGlobal()
		{
			global $PenTestDbQueries , $MoSPTDirName;
			$PenTestDbQueries	 	    = new MoSPT_PenTestQuery();
			$MoSPTDirName 				= dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR;
		}
		
	}
	new MoSPT_Constants();

?>